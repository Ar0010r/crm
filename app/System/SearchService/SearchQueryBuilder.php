<?php


namespace App\System\SearchService;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

class SearchQueryBuilder
{
    public function getQueryBuilderRequest(Request $r, Model $m, array $relatedWhere, array $relatedLike): Request
    {
        $requestHelper = new QueryBuilderRequestHelper($r, $m, $relatedWhere, $relatedLike);

        return $requestHelper->getQueryBuilderRequest()->getRequest();
    }

    public function applySearchToQuery(
        Request $r,
        QueryBuilder $q,
        array $likeFields,
        array $whereFields,
        array $jsonFields
    ): QueryBuilder {
        $searchHelper = new QueryBuilderSearchHelper($r, $q, $likeFields, $whereFields, $jsonFields);

        return $searchHelper->applySearch()->getQuery();
    }

    public function applyFiltersToQuery(
        QueryBuilder $q,
        array $like,
        array $where,
        array $relatedLike,
        array $relatedWhere,
        array $scopeFilters
    ): QueryBuilder {
        $filterHelper = new QueryBuilderFilterHelper($q, $like, $where, $relatedLike, $relatedWhere, $scopeFilters);

        return $filterHelper->applyFilters()->getQuery();
    }
}
