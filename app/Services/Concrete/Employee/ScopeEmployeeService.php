<?php


namespace App\Services\Concrete\Employee;

use App\Models\Employee;
use App\Models\User;
use App\Services\AbstractScopeService;
use App\Services\Concrete\Company\StoreCompanyService;
use App\Services\Concrete\User\StoreUserService;
use App\Shared\Value\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QBuilder;
use Spatie\QueryBuilder\QueryBuilder;


class ScopeEmployeeService extends AbstractScopeService
{
    public function adminScope(): QueryBuilder|Builder|QBuilder
    {
        return Employee::query()
            ->orderByDesc('employees.created_at')
            ->with('hr')
            ->with('company');
    }

    protected function hrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return $this->adminScope()
            ->where('hr_id', $user->id)
            ->whereIn('status', Status::STATUSES);
    }

    protected function personnelScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $companyIds = StoreCompanyService::getUserCompanyIds($user);

        return $this->adminScope()
            ->whereIn('company_id', $companyIds)
            ->whereIn('status', array_keys(Status::PERSONNEL_STATUSES));
    }

    protected function topHrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $hrIds = StoreUserService::getTopHrTeamIds($user);

        return $this->basicQuery
            ->whereIn('hr_id', $hrIds)
            ->whereIn('status', Status::HR_STATUSES);
    }

    public function getModel(): Model
    {
        return new Employee();
    }
}
