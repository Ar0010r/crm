<?php


namespace App\System\SearchService;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class QueryBuilderFilterHelper
{
    protected array $allowedFilters = [];
    protected array $likeFilters = [];
    protected array $whereFilters = [];
    protected array $relatedWhereFilters = [];
    protected array $relatedLikeFilters = [];
    protected array $scopeFilters = [];

    protected QueryBuilder $query;

    public function __construct(QueryBuilder $q, array $like, array $where, array $relatedLike, array $relatedWhere, array $scopeFilters)
    {
        $this->query = $q;
        $this->likeFilters = $like;
        $this->whereFilters = $where;
        $this->relatedWhereFilters = $relatedWhere;
        $this->relatedLikeFilters = $relatedLike;
        $this->scopeFilters = $scopeFilters;
    }

    public function applyFilters(): QueryBuilderFilterHelper
    {
        return $this->setAllowedFilters()->applyAllowedFilters();
    }

    protected function applyAllowedFilters(): QueryBuilderFilterHelper
    {
        $this->query = $this->query->allowedFilters($this->allowedFilters);
        return $this;
    }


    protected function setAllowedFilters(): QueryBuilderFilterHelper
    {
        $allowedFilters = $this->likeFilters;

        foreach ($this->whereFilters as $item) {
            $allowedFilters[] = AllowedFilter::exact($item);
        }

        foreach ($this->relatedLikeFilters as $key => $relation) {
            $relation = is_array($relation) ? $relation : [$relation];
            $related = array_map(function ($item) use ($key) {
                return $key . '.' . $item;
            }, $relation);
            $allowedFilters = array_merge($allowedFilters, $related);
        }

        foreach ($this->relatedWhereFilters as $key => $relation) {
            $relation = is_array($relation) ? $relation : [$relation];
            $related = array_map(function ($item) use ($key) {
                return AllowedFilter::exact($key . '.' . $item);
            }, $relation);

            $allowedFilters = array_merge($allowedFilters, $related);
        }

        foreach ($this->scopeFilters as $filter) {
            $allowedFilters[] = AllowedFilter::scope($filter);
        }

        $this->allowedFilters = $allowedFilters;

        return $this;
    }

    public function getQuery(): QueryBuilder
    {
        return $this->query;
    }
}
