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

class UserEmployeeService
{
    private QueryBuilder $basicQuery;
    private CompanyService $companyService;
    private UserService $userService;

    public function __construct(CompanyService $companyService, UserService $userService)
    {
        $this->companyService = $companyService;
        $this->userService = $userService;

        $this->basicQuery = QueryBuilder::for(Employee::class)
            ->orderByDesc('employees.created_at')
            ->allowedFilters(['company_id', 'status', 'page', 'hr_id'])
            ->with('hr')
            ->with('company');
    }

    public function getUserEmployees(int $recordsPerPage, User $user = null): LengthAwarePaginator
    {
        $user = $user ?? auth()->user();

        switch ($user->role) {
            case Role::PERSONNEL:
                return $this->getPersonnelEmployees($recordsPerPage, $user);
            case Role::ADMIN:
                return $this->getAdminEmployees($recordsPerPage);
            case Role::TOP_HR:
                return $this->getTopHrEmployees($recordsPerPage, $user);
            default:
                return $this->getHrEmployees($recordsPerPage, $user);
        }
    }

    private function getAdminEmployees(int $recordsPerPage): LengthAwarePaginator
    {
        return $this->basicQuery->paginate($recordsPerPage);
    }

    private function getHrEmployees(int $recordsPerPage, User $user = null): LengthAwarePaginator
    {
        $user = $user ?? auth()->user();

        return $this->basicQuery
            ->where('hr_id', $user->id)
            ->whereIn('status', [
                Status::NEW,
                Status::WAITING_AGREEMENT,
                Status::NEED_DATA,
                Status::INFO,
                Status::BAD,
                Status::DIED,
                Status::READY,
            ])
            ->paginate($recordsPerPage);
    }

    private function getPersonnelEmployees(int $recordsPerPage, User $personnel = null): LengthAwarePaginator
    {
        $companyIds = $this->companyService->getUserCompanyIds($personnel);

        return $this->basicQuery
            ->whereIn('company_id', $companyIds)
            ->whereIn('status', [Status::READY, Status::GREETED, Status::EXPORTED])
            ->paginate($recordsPerPage);
    }

    private function getTopHrEmployees(int $recordsPerPage, User $topHr = null): LengthAwarePaginator
    {
        $hrIds = UserService::getTopHrTeamIds($topHr);

        return $this->basicQuery
            ->whereIn('hr_id', $hrIds)
            ->whereIn('status', [
                Status::NEW,
                Status::WAITING_AGREEMENT,
                Status::NEED_DATA,
                Status::INFO,
                Status::BAD,
                Status::DIED,
                Status::READY,
            ])
            ->paginate($recordsPerPage);
    }
}