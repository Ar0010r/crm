<?php


namespace App\Services\Employee;

use App\Models\Employee;
use App\Models\User;
use App\Services\Company\CompanyService;
use App\Services\User\UserService;
use App\Shared\Value\Role;
use App\Shared\Value\Status;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;

class EmployeeSearchService
{
    private CompanyService $companyService;
    private UserService $userService;
    private Search $search;

    public function __construct(CompanyService $companyService, UserService $userService, Search $search)
    {
        $this->companyService = $companyService;
        $this->userService = $userService;
        $this->search = $search;
    }

    public function search(string $keyword): array
    {
        $search = $this->search
            ->registerModel(Employee::class, $this->getSearchAspect())
            ->search($keyword)
            ->toArray();

        return array_map(function ($item) {
            return $item->searchable;
        }, $search);
    }

    private function getSearchAspect(): callable
    {
        switch (auth()->user()->role) {
            case Role::PERSONNEL:
                return $this->getPersonnelSearchAspect();
            case Role::ADMIN:
                return $this->getAdminSearchAspect();
            case Role::TOP_HR:
                return $this->getTopHrSearchAspect();
            default:
                return $this->getHrSearchAspect();
        }
    }

    private function basicSearchAspect(ModelSearchAspect $modelSearchAspect): ModelSearchAspect
    {
         return $modelSearchAspect
            ->addSearchableAttribute('name')
            ->addSearchableAttribute('email')
            ->addSearchableAttribute('paypal')
            ->addSearchableAttribute('address')
            ->addSearchableAttribute('city')
            ->addSearchableAttribute('state')
            ->with('hr')
            ->with('company');
    }

    private function getHrSearchAspect(): callable
    {
        return function (ModelSearchAspect $modelSearchAspect) {
            $this->basicSearchAspect($modelSearchAspect)
                ->where('employees.hr_id', auth()->user()->id);
        };
    }

    private function getPersonnelSearchAspect(): callable
    {
        $companyIds = $this->companyService->getUserCompanyIds();

        return function (ModelSearchAspect $modelSearchAspect) use ($companyIds) {
            $this->basicSearchAspect($modelSearchAspect)
                ->whereIn('company_id', $companyIds);
        };
    }

    private function getAdminSearchAspect(): callable
    {
        return function (ModelSearchAspect $modelSearchAspect) {
            $this->basicSearchAspect($modelSearchAspect);
        };
    }

    private function getTopHrSearchAspect(): callable
    {
        $hrIds = UserService::getTopHrTeamIds();
        return function (ModelSearchAspect $modelSearchAspect) use ($hrIds) {
            $this->basicSearchAspect($modelSearchAspect)
                ->whereIn('employees.hr_id', $hrIds);
        };
    }


}