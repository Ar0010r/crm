<?php


namespace App\Source\Services;

use App\Source\Requests\AbstractGetRequest;
use App\Domain\Models\User;
use App\Source\Services\Contracts\ScopeResourceInterface;
use App\Source\Services\Contracts\GetResourceInterface;
use App\System\Search\Database\SearchQueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

abstract class AbstractGetService implements GetResourceInterface
{
    protected Model $model;
    protected Request $request;
    protected QueryBuilder $query;
    protected SearchQueryBuilder $helper;
    protected ScopeResourceInterface $userScope;

    protected array $likeFilters = [];
    protected array $whereFilters = [];
    protected array $jsonFilters = [];
    protected array $relatedWhereFilters = [];
    protected array $relatedLikeFilters = [];
    protected array $scopeFilters = [];
    protected array $orderByAssociates = [];

    public const BASE_REQUEST_KEYS = [
        'page',
        'take',
        'order_by',
        'asc',
        'search_term',
        '_with',
        '_with_count',
        '_with_exists',
    ];
    public const POSSIBLE_PLURAL_REQUEST_KEYS = [
        'type' => 'types',
        'category' => 'categories',
        'subcategory' => 'subcategories',
        'status' => 'statuses'
    ];

    public function __construct(ScopeResourceInterface $userScope)
    {
        $this->userScope = $userScope;
        $this->helper = new SearchQueryBuilder();
        $this->model = $this->getModel();
    }

    public function get(AbstractGetRequest $request): LengthAwarePaginator
    {
        $user = $request->user() ?? auth()->user();
        return $this
            ->setSearchRequest($request)
            ->setBaseQuery($user)
            ->applyFilters()
            ->applySearch()
            ->paginate();
    }

    protected function setSearchRequest(Request $request): AbstractGetService
    {
        $this->request = $this->helper->getQueryBuilderRequest(
            $request,
            $this->model,
            $this->relatedWhereFilters,
            $this->relatedLikeFilters
        );

        return $this;
    }

    protected function setBaseQuery(User $user = null): AbstractGetService
    {
        $user = $user ?? auth()->user();
        $query = $this->userScope->getScope($user);
        $this->query = QueryBuilder::for($query, $this->request);

        return $this;
    }

    protected function applyFilters(): AbstractGetService
    {
        $this->whereFilters[] = $this->model->getTable() . '.' . $this->model->getKeyName();

        $this->query = $this->helper->applyFiltersToQuery(
            $this->query,
            $this->likeFilters,
            $this->whereFilters,
            $this->relatedLikeFilters,
            $this->relatedWhereFilters,
            $this->scopeFilters
        );

        return $this;
    }

    protected function applySearch(): AbstractGetService
    {
        $this->query = $this->helper->applySearchToQuery(
            $this->request,
            $this->query,
            $this->likeFilters,
            $this->whereFilters,
            $this->jsonFilters
        );

        return $this;
    }

    protected function paginate(): LengthAwarePaginator
    {
        $orderBy = $this->request->get('order_by', 'created_at');
        $sortBy = $this->model->getTable() . '.' . $orderBy;
        $take = $this->request->get('take', 100);
        $with = $this->request->get('_with', []);
        $withExists = $this->request->get('_with_exists', []);
        $withCount = $this->request->get('_with_count', []);
        $page = $this->request->get('page', 1);

        if (isset($this->orderByAssociates[$orderBy])) {
            $sortBy = $this->orderByAssociates[$orderBy];
        }

        $this->query = $with == [] ? $this->query : $this->query->with($with);
        $this->query = $withExists == [] ? $this->query : $this->query->withExists($withExists);
        $this->query = $withCount == [] ? $this->query : $this->query->withCount($withCount);

        $asc = (bool)$this->request->get('asc', false);
        $this->query = $asc ? $this->query->orderBy($sortBy) : $this->query->orderByDesc($sortBy);

        return $this->query->paginate(perPage: $take,page: $page);
        //return $this->query->paginate($this->request->get('take'), $select, 'page', $this->request['page']);
    }

    public function show(Model $model): Model
    {
        return $model;
    }

    abstract protected function getModel(): Model;
}
