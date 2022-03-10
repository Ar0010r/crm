<?php


namespace App\System\Search\Database\Helpers;

use App\Source\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RequestFormatter
{
    protected Request $httpRequest;
    protected Request $queryBuilderRequest;
    protected Model $model;

    protected array $relatedWhereFilters = [];
    protected array $relatedLikeFilters = [];
    protected array $requestData = [];

    public function __construct(Request $r, Model $m, array $relatedWhere, array $relatedLike)
    {
        $this->httpRequest = $r;
        $this->queryBuilderRequest = new Request();
        $this->model = $m;
        $this->relatedWhereFilters = $relatedWhere;
        $this->relatedLikeFilters = $relatedLike;
        $this->requestData = $this->httpRequest->except(AbstractGetService::BASE_REQUEST_KEYS);
    }

    public function getQueryBuilderRequest(): RequestFormatter
    {
        return $this->prepareRequestData()
            ->setQueryBuilderRequestData()
            ->setQueryBuilderRequestWrapper();
    }

    private function setQueryBuilderRequestData(): RequestFormatter
    {
        $this->queryBuilderRequest = $this->queryBuilderRequest->merge(['filter' => $this->requestData]);

        return $this;
    }

    private function setQueryBuilderRequestWrapper(): RequestFormatter
    {
        $page = $this->httpRequest->get('page', 1);
        $take = $this->httpRequest->get('take', 100);
        $this->queryBuilderRequest = $this->queryBuilderRequest->merge([
            'take' => $take,
            'page' => $page,
            'order_by' => $this->httpRequest->get('order_by', 'created_at'),
            'asc' => $this->httpRequest->get('asc', false),
            'search_term' => $this->httpRequest->get('search_term', ""),
            '_without_scope' => $this->httpRequest->input('_without_scope', false),
        ]);

        return $this;
    }

    private function prepareRequestData(): RequestFormatter
    {
        $this->transformPluralKeys()->transformIdsToString()->setCorrectKeyForRelatedValues();

        return $this;
    }

    private function transformPluralKeys(): RequestFormatter
    {
        foreach (AbstractGetService::POSSIBLE_PLURAL_REQUEST_KEYS as $singular => $plural) {
            if (in_array($plural, array_keys($this->requestData))) {
                $data = $this->requestData[$plural];
                if (is_array($data)) {
                    $data = implode(',', $data);
                }
                $this->requestData[$singular] = $data;
            }
        }
        return $this;
    }

    private function transformIdsToString(): RequestFormatter
    {
        foreach ($this->requestData as $key => $filter) {
            if (strpos($key, 'ids') !== false && $filter) {
                if (is_array($filter)) {
                    $data = implode(",", $filter);
                } else {
                    $data = $filter;
                }

                if ($key === 'ids') {
                    $dataKey = $this->model->getTable() . '.' . $this->model->getKeyName();
                } else {
                    $dataKey = substr($key, 0, -1);
                }
                unset($this->requestData[$key]);
                $this->requestData[$dataKey] = $data;
            }
        }

        return $this;
    }

    private function setCorrectKeyForRelatedValues(): RequestFormatter
    {
        $filters = [];
        foreach ($this->requestData as $key => $filter) {
            foreach ($this->relatedWhereFilters as $relation => $fields) {
                $fields = is_array($fields) ? $fields : [$fields];
                $key = in_array($key, $fields) && $key !== 'name' ? $relation . '.' . $key : $key;
            }

            foreach ($this->relatedLikeFilters as $relation => $fields) {
                $fields = is_array($fields) ? $fields : [$fields];
                $key = in_array($key, $fields) && $key !== 'name' ? $relation . '.' . $key : $key;
            }

            $filters[$key] = $filter;
        }

        $this->requestData = $filters;

        return $this;
    }

    public function getRequest(): Request
    {
        return $this->queryBuilderRequest;
    }
}
