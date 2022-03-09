<?php


namespace App\System\Search\Database;

use App\System\Search\Database\Helpers\FiltersApplier;
use App\System\Search\Database\Helpers\RequestFormatter;
use App\System\Search\Database\Helpers\SearchApplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class SearchQueryBuilder
{
    public function getQueryBuilderRequest(Request $r, Model $m, array $relatedWhere, array $relatedLike): Request
    {
        $requestHelper = new RequestFormatter($r, $m, $relatedWhere, $relatedLike);

        return $requestHelper->getQueryBuilderRequest()->getRequest();
    }

    public function applySearchToQuery(
        Request $r,
        QueryBuilder $q,
        array $likeFields,
        array $whereFields,
        array $jsonFields
    ): QueryBuilder {
        $searchHelper = new SearchApplier($r, $q, $likeFields, $whereFields, $jsonFields);

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
        $filterHelper = new FiltersApplier($q, $like, $where, $relatedLike, $relatedWhere, $scopeFilters);

        return $filterHelper->applyFilters()->getQuery();
    }
}
