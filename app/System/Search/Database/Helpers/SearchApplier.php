<?php


namespace App\System\Search\Database\Helpers;

use App\System\Search\Database\Traits\JsonParametersSearch;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Matrix\Builder;
use Spatie\QueryBuilder\QueryBuilder;

class SearchApplier
{
    use JsonParametersSearch;

    protected QueryBuilder $query;
    protected Request $request;
    protected Model $model;

    protected array $likeSearchFields = [];
    protected array $whereSearchFields = [];
    protected array $jsonSearchFilters = [];

    private const ADDRESS_FIELDS = [
        'addresses.region',
        'addresses.district',
        'addresses.postal_code',
        'addresses.address_line'
    ];

    public function __construct(Request $r, QueryBuilder $q, array $likeFields, array $whereFields, array $jsonFilters)
    {
        $this->query = $q;
        $this->request = $r;
        $this->model = $q->getModel();
        $this->setSearchFields($likeFields, $whereFields, $jsonFilters);
    }

    public function applySearch(): SearchApplier
    {
        return $this->applySearchTermSearch()
            ->applyAddressSearch()
            ;
    }

    protected function setSearchFields(array $likeFilters, array $whereFields, $jsonFilters): SearchApplier
    {
        $filters = array_keys($this->request->get('filter', []));

        $this->likeSearchFields = array_diff($likeFilters, $filters);
        $this->whereSearchFields = array_diff($whereFields, $filters);
        $this->jsonSearchFilters = array_diff($jsonFilters, $filters);

        return $this;
    }

    protected function applySearchTermSearch(): SearchApplier
    {
        $term = $this->request->get('search_term', "");
        if ($term == "") {
            return $this;
        }

        $term = strtolower($term);

        $this->query = $this->query->where(function ($query) use ($term) {

            foreach ($this->likeSearchFields as $field) {
                $query->orWhereRaw("LOWER($field) LIKE LOWER(?)", ["%{$term}%"]);
            }

            foreach ($this->whereSearchFields as $field) {
                $query->orWhere($field, '=', $term);
                //$query->orWhereRaw("LOWER($field) = LOWER(?)", ["{$term}"]);
            }

            foreach ($this->jsonSearchFilters as $field) {
                $query = $this->orWhereParametersLike($query, $field, $term);
            }
        });

        return $this;
    }

    protected function applyAddressSearch(): SearchApplier
    {
        $requestData = $this->request->get('filter');

        if (!isset($requestData['address']) || $requestData['address'] === "") {
            return $this;
        }

        $term = strtolower($requestData['address']);

        $this->query = $this->query->whereExists(function ($query) use ($term, $requestData) {
            $whereQuery = $this->model->getTable() . "." . $this->model->getKeyName() . " = addresses.object_id";
            $query->select("*")
                ->from('addresses')
                ->whereRaw($whereQuery)
                ->where('addresses.object_type', '=', get_class($this->model))
                ->where(function ($query) use ($term, $requestData) {
                    foreach (self::ADDRESS_FIELDS as $field) {
                        if (!isset($requestData[$field])) {
                            $query->orWhere($field, 'LIKE', "%$term%");
                        }
                    }
                });
        });

        return $this;
    }

    public function getQuery(): QueryBuilder
    {
        return $this->query;
    }
}
