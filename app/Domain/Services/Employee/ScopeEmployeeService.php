<?php


namespace App\Domain\Services\Employee;

use App\Domain\Models\Employee;
use App\Domain\Models\User;
use App\Source\Services\AbstractScopeService;
use App\Domain\Services\Company\StoreCompanyService;
use App\Domain\Services\User\StoreUserService;
use App\Domain\Enums\Status;
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
