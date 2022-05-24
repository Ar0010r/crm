<?php


namespace App\Domain\Services\Subscription;

use App\Domain\Models\Company;
use App\Domain\Models\Subscription;
use App\Domain\Models\User;
use App\Domain\Services\Company\ScopeCompanyService;
use App\Domain\Services\User\StoreUserService;
use App\Source\Services\AbstractScopeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QBuilder;
use Spatie\QueryBuilder\QueryBuilder;

class ScopeSubscriptionService extends AbstractScopeService
{

    protected function adminScope(): QueryBuilder|Builder|QBuilder
    {
        return Subscription::query();
    }

    protected function personnelScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $ids = $user->companies()->pluck('id');
        return $this->adminScope()->whereIn('company_id', $ids);
    }

    protected function topHrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $userIds = GetUserService::getTopHrTeamIds($user);
        $companyIds = Company::query()->whereIn('manager_id', $userIds)->pluck('id');

        return $this->adminScope()->whereIn('company_id', $companyIds);
    }

    protected function hrScope(User $user)
    {
        $ids = $user->companies()->pluck('id');
        return $this->adminScope()->whereIn('company_id', $ids);
    }

    public function getModel(): Model
    {
        return new Subscription();
    }
}
