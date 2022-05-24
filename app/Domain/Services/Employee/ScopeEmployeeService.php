<?php


namespace App\Domain\Services\Employee;

use App\Domain\Enums\CompanyType;
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
            ->with('hrCompany')
            ->with('company');
    }

    protected function hrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $companyIds = $user->companies()->where('type', CompanyType::HIRING)->pluck('id');
        return $this->adminScope()
            ->where(function($query) use ($user, $companyIds) {
                $query->orWhere('hr_id', $user->getKey())->orWhereIn('hr_company_id', $companyIds);
            })
            ->whereIn('status', Status::STATUSES);
    }

    protected function personnelScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $companyIds = $user->companies()->pluck('companies.id');

        return $this->adminScope()
            ->whereIn('company_id', $companyIds)
            ->whereIn('status', array_keys(Status::PERSONNEL_STATUSES));
    }

    protected function topHrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $hrIds = GetUserService::getTopHrTeamIds($user);

        return $this->basicQuery
            ->whereIn('hr_id', $hrIds)
            ->whereIn('status', Status::HR_STATUSES);
    }

    public function getModel(): Model
    {
        return new Employee();
    }
}
