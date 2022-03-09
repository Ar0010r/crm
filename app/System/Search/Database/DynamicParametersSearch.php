<?php

namespace App\System\Search\Database;

use App\Source\Services\AbstractGetService;
use App\System\Search\Database\Traits\JsonParametersSearch;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QBuilder;

class DynamicParametersSearch
{
    private QueryBuilder|Builder|QBuilder $query;
    private int $searchType;
    private string $parameterKey;
    private $parameterValue;
    private int $fieldType;
    private string $key = "parameters";

    use JsonParametersSearch;

    private const SEARCH_TYPES =
        [
            "text" => 1,
            "number" => 2,
            "number range from" => 3,
            "number range to" => 4,
            "date" => 5,
            "date range from" => 6,
            "date range to" => 7,
            "id" => 8,
            "ids any" => 9,
            "bool" => 10,
            "array any" => 11,
            "array strict" => 12,
        ];

    private const FIELD_TYPES =
        [
            "text" => 1,
            "number" => 2,
            "boolean" => 3,
            "id" => 4,
            "image" => 5,
            "numbers" => 6,
            "ids" => 7,
            "date" => 8,
            "strings" => 9,
            "custom" => 10, // only for ui
            "text area" => 11 // same as 1
        ];

    private const ARRAY_FIELD_TYPES = [
        self::FIELD_TYPES['numbers'],
        self::FIELD_TYPES['ids'],
        self::FIELD_TYPES['strings']
    ];

    public function applyFilters(QueryBuilder|Builder|QBuilder $query, array $params, string $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        foreach ($params as $filter) {
            $parameterKey = $filter['parameter_key'];
            $parameterValue = $filter['value'];
            $searchType = $filter['search_type'];
            $fieldType = $filter['parameter_value_type'];

            if (!in_array($parameterKey, AbstractGetService::POSSIBLE_PLURAL_REQUEST_KEYS)) {
                $query = $this->buildQuery($query, $searchType, $parameterKey, $parameterValue, $fieldType, $key);
            }
        }

        return $query;
    }
    public function buildQuery(QueryBuilder|Builder|QBuilder $query, int $searchType, string $parameterKey, $parameterValue, int $fieldType, string $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $this->setParameterValues($query, $searchType, $parameterKey, $parameterValue, $fieldType, $key);

        return match ($searchType) {
            self::SEARCH_TYPES['text'] => $this->text(),
            self::SEARCH_TYPES['number'], self::SEARCH_TYPES['bool'] => $this->numberOrBool(),
            self::SEARCH_TYPES['number range from'] => $this->numberRangeFrom(),
            self::SEARCH_TYPES['number range to'] => $this->numberRangeTo(),
            self::SEARCH_TYPES['date'] => $this->date(),
            self::SEARCH_TYPES['date range from'] => $this->dateRangeFrom(),
            self::SEARCH_TYPES['date range to'] => $this->dateRangeTo(),
            self::SEARCH_TYPES['id'] => $this->id(),
            self::SEARCH_TYPES['ids any'], self::SEARCH_TYPES['array any'] => $this->arrayAny(),
            self::SEARCH_TYPES['array strict'] => $this->arrayStrict(),

            default => throw new \Exception('unknown search type : ' . $searchType)
        };
    }

    private function text(): QueryBuilder|Builder|QBuilder
    {
        return $this->whereParameterLike($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function numberOrBool(): QueryBuilder|Builder|QBuilder
    {
        return $this->whereParameterExact($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function numberRangeFrom(): QueryBuilder|Builder|QBuilder
    {
        return $this->whereNumberFrom($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function numberRangeTo(): QueryBuilder|Builder|QBuilder
    {
        return $this->whereNumberTo($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function date(): QueryBuilder|Builder|QBuilder
    {
        return $this->whereDate($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function dateRangeFrom(): QueryBuilder|Builder|QBuilder
    {
        return $this->whereDateFrom($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function dateRangeTo(): QueryBuilder|Builder|QBuilder
    {
        return $this->whereDateTo($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function id(): QueryBuilder|Builder|QBuilder
    {
        $this->parameterValue = is_array($this->parameterValue) ? $this->parameterValue : [$this->parameterValue];

        if (in_array($this->fieldType, self::ARRAY_FIELD_TYPES)) {
            return $this->whereArrayParameterContainsArray($this->query, $this->parameterKey, $this->parameterValue, $this->key);
        }
        return $this->whereParameterIn($this->query, $this->parameterKey, $this->parameterValue, $this->key);
        //return $this->whereParameter($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function arrayAny(): QueryBuilder|Builder|QBuilder
    {
        $this->parameterValue = is_array($this->parameterValue) ? $this->parameterValue : [$this->parameterValue];

        if (in_array($this->fieldType, self::ARRAY_FIELD_TYPES)) {
            return $this->whereArrayContainsAny($this->query, $this->key.$this->parameterKey, $this->parameterValue);
            //whereArrayContainsText ??
            //return $this->whereArrayParameterContainsArray($this->query, $this->parameterKey, $this->parameterValue, $this->key);
        }

        return $this->whereParameterIn($this->query, $this->parameterKey, $this->parameterValue, $this->key);
        //return $this->whereParameter($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function arrayStrict(): QueryBuilder|Builder|QBuilder
    {
        $this->parameterValue = is_array($this->parameterValue) ? $this->parameterValue : [$this->parameterValue];

        if (in_array($this->fieldType, self::ARRAY_FIELD_TYPES)) {
            return $this->whereArrayParameterContainsArray($this->query, $this->parameterKey, $this->parameterValue, $this->key);
        }
        return $this->whereParameterIn($this->query, $this->parameterKey, $this->parameterValue, $this->key);
    }

    private function setParameterValues(QueryBuilder|Builder|QBuilder $query, int $searchType, string $parameterKey, $parameterValue, int $fieldType, string $key = "parameters")
    {
        $this->query = $query;
        $this->searchType = $searchType;
        $this->parameterKey = $parameterKey;
        $this->parameterValue = $parameterValue;
        $this->fieldType = $fieldType;
        $this->key = $key;
    }
}
