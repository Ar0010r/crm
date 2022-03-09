<?php


namespace App\System\Search\Database\Traits;

use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QBuilder;

trait JsonParametersSearch
{
    public function whereParameterLike(QueryBuilder|Builder|QBuilder $q, string $parameter, $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $whereLikeQuery = "LOWER($key->'" . $parameter . "'->>'value') like LOWER('%" . $value . "%')";

        return $q->whereRaw($whereLikeQuery);
    }

    public function orWhereParameterLike(QueryBuilder|Builder|QBuilder $q, string $parameter, $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {

        $whereLikeQuery = "$key->'" . $parameter . "'->>'value' like '%" . $value . "%'";

        return $q->orWhereRaw($whereLikeQuery);
    }

    public function whereParameter(QueryBuilder|Builder|QBuilder $q, string $parameter, $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $whereQuery = "$key->'" . $parameter . "'->>'value' = '" . $value . "'";

        return $q->whereRaw($whereQuery);
    }

    public function whereParameterExact(QueryBuilder|Builder|QBuilder $q, string $parameter, $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        return $q->whereJsonContains("$key->" . $parameter . "->>value", $value);
        //return $q->whereJsonContains('parameters->' . $parameter . "'->>'value'", $value);
    }

    public function whereParameterIn(QueryBuilder|Builder|QBuilder $q, string $parameter, array $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $value = "('" . implode("','", $value) . "')";
        $whereLikeQuery = "$key->'" . $parameter . "'->>'value' IN " . $value;

        return $q->whereRaw($whereLikeQuery);
    }

    public function whereParametersLike(QueryBuilder|Builder|QBuilder $q, string $column, $value): QueryBuilder|Builder|QBuilder
    {
        $whereLikeQuery = "LOWER(($column)::text) like LOWER('%$value%')";

        return $q->whereRaw($whereLikeQuery);
    }

    public function orWhereParametersLike(QueryBuilder|Builder|QBuilder $q, string $column, $value): QueryBuilder|Builder|QBuilder
    {
        $whereLikeQuery = "LOWER(($column)::text) like LOWER('%$value%')";

        return $q->orWhereRaw($whereLikeQuery);
    }

    public function whereArrayContainsAny(QueryBuilder|Builder|QBuilder $q, string $column, array $value): QueryBuilder|Builder|QBuilder
    {
        // getting string ('4', '2', '0') from array [4,2,0]
        $value = "('" . implode("','", $value) . "')";

        //$value = json_encode($value);
        $query = "EXISTS (SELECT FROM jsonb_array_elements($column) WHERE value IN $value)";

        return $q->whereRaw($query);
    }

    public function whereArrayContainsText(QueryBuilder|Builder|QBuilder $q, string $column, array $value): QueryBuilder|Builder|QBuilder
    {
        $value = "('" . implode("','", $value) . "')";
        $query = "EXISTS (SELECT FROM jsonb_array_elements_text($column) WHERE value IN $value)";

        return $q->whereRaw($query);
    }

    public function whereArrayContainsArray(QueryBuilder|Builder|QBuilder $q, string $column, array $value): QueryBuilder|Builder|QBuilder
    {
        $value = json_encode($value);
        $query = "$column::jsonb @> '$value'::jsonb";

        return $q->whereRaw($query);
    }

    public function whereArrayParameterContainsArray(QueryBuilder|Builder|QBuilder $q, string $column, array $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $value = json_encode($value);
        $query = "($key #>> '{ $column, value }')::jsonb @> '$value'::jsonb";
        //$query = "(parameters #>> '{ $column, value }')::jsonb @> '$value'::jsonb";

        return $q->whereRaw($query);
    }

    public function whereArrayParameterInArray(QueryBuilder|Builder|QBuilder $q, string $column, array $value): QueryBuilder|Builder|QBuilder
    {
        //$value = "['" . implode("','", $value) . "']";
        $value = json_encode($value);

       // '{"a":1, "b":2, "c":3}'::jsonb ?| array['b', 'c']
        $a = json_encode(["a", "b"]);

        $query = "$a::jsonb ?| array[a, b]";
        //$query = "(parameters #>> '{ $column, value }')::jsonb ?| $value::jsonb";

        return $q->whereRaw(pg_escape_string($query));
    }

    public function whereBetween(QueryBuilder|Builder|QBuilder $q, string $column, int $min, int $max, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $query = "($key #>> '{ $column, value }')::int between $min and $max";

        return $q->whereRaw($query);
    }

    public function whereNumberTo(QueryBuilder|Builder|QBuilder $q, string $column, int|float $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $value = is_float($value) ? $value : floatval($value);
        $query = "($key #>> '{ $column, value }')::float <= $value";

        //$query = "($key #>> '{ $column, value }')::int <= $value";

        return $q->whereRaw($query);
    }

    public function whereNumberFrom(QueryBuilder|Builder|QBuilder $q, string $column, int|float $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $value = is_float($value) ? $value : floatval($value);
        $query = "($key #>> '{ $column, value }' )::float  >= $value";

        //$query = "($key #>> '{ $column, value }' )::int  >= $value";

        return $q->whereRaw($query);
    }

    public function whereDate(QueryBuilder|Builder|QBuilder $q, string $column, string $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $query = "($key #>> '{ $column, value }')::date = '$value'::date";

        return $q->whereRaw($query);
    }

    public function whereDateTo(QueryBuilder|Builder|QBuilder $q, string $column, string $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $query = "($key #>> '{ $column, value }')::date <= '$value'::date";

        return $q->whereRaw($query);
    }

    public function whereDateFrom(QueryBuilder|Builder|QBuilder $q, string $column, string $value, $key = "parameters"): QueryBuilder|Builder|QBuilder
    {
        $query = "($key #>> '{ $column, value }')::date >= '$value'::date";

        return $q->whereRaw($query);
    }
}
