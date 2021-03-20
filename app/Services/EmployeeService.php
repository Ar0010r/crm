<?php


namespace App\Services;

use App\Models\Employee;
use App\Models\User;
use App\Shared\Value\Status;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class EmployeeService
{
    private QueryBuilder $basicQuery;
    private CompanyService $companyService;
    private Search $search;

    public function __construct(CompanyService $companyService, Search $search)
    {
        $this->companyService = $companyService;
        $this->search = $search;

        $this->basicQuery = QueryBuilder::for(Employee::class)
            ->orderByDesc('employees.created_at')
            ->allowedFilters(['company_id', 'status', 'page'])
            ->with('hr')
            ->with('company');
    }

    public function getAdminEmployees(int $recordsPerPage): LengthAwarePaginator
    {
        return $this->basicQuery->paginate($recordsPerPage);
    }

    public function getHrEmployees(int $recordsPerPage, User $user = null): LengthAwarePaginator
    {
        $user = $user ?? auth()->user();
        return $this->basicQuery
            ->where('hr_id', $user->id)
            ->paginate($recordsPerPage);
    }

    public function getPersonnelEmployees(int $recordsPerPage, User $personnel = null): LengthAwarePaginator
    {
        $companyIds = $this->companyService->getUserCompanyIds($personnel);

        return $this->basicQuery
            ->whereIn('company_id', $companyIds)
            ->whereIn('status', [Status::READY, Status::GREETED, Status::EXPORTED])
            ->paginate($recordsPerPage);
    }

    public function search(string $keyword): array
    {
        $search = $this->search
            ->registerModel(Employee::class, $this->getSearchAspect())
            ->search($keyword)->toArray();

        return array_map(function ($item) {
            return $item->searchable;
        }, $search);
    }

    private function getSearchAspect(): callable
    {
        return function (ModelSearchAspect $modelSearchAspect) {
            $modelSearchAspect
                ->addSearchableAttribute('name')
                ->addSearchableAttribute('email')
                ->addSearchableAttribute('paypal')
                ->addSearchableAttribute('address')
                ->addSearchableAttribute('city')
                ->addSearchableAttribute('state')
                ->with('hr')
                ->with('company');
        };
    }

}