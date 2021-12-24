<?php


namespace App\Services\Concrete\Employee;

use App\Models\Employee;
use App\Services\AbstractUserResourceService;
use App\Services\Concrete\Company\CompanyService;
use App\Services\Concrete\User\UserService;
use App\Shared\Value\Status;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;


class UserEmployeeService extends AbstractUserResourceService
{
    public function getBaseQuery()
    {
        return QueryBuilder::for(Employee::class)
            ->orderByDesc('employees.created_at')
            ->allowedFilters(['company_id', 'status', 'page', 'hr_id'])
            ->with('hr')
            ->with('company');
    }

    protected function hrResources()
    {
        return $this->basicQuery
            ->where('hr_id', $this->user->id)
            ->whereIn('status', Status::STATUSES);
    }

    protected function personnelResources()
    {
        $companyIds = CompanyService::getUserCompanyIds($this->user);

        return $this->basicQuery
            ->whereIn('company_id', $companyIds)
            ->whereIn('status', array_keys(Status::PERSONNEL_STATUSES));
    }

    protected function topHrResources()
    {
        $hrIds = UserService::getTopHrTeamIds($this->user);

        return $this->basicQuery
            ->whereIn('hr_id', $hrIds)
            ->whereIn('status', Status::HR_STATUSES);
    }

    public function getResourceModel(): Model
    {
        return new Employee();
    }
}
