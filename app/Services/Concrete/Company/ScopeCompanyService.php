<?php


namespace App\Services\Concrete\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\AbstractScopeService;
use App\Services\Concrete\User\StoreUserService;
use App\Shared\Value\CompanyType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QBuilder;
use Spatie\QueryBuilder\QueryBuilder;

class ScopeCompanyService extends AbstractScopeService
{
    protected function adminScope(): QueryBuilder|Builder|QBuilder
    {
        return Company::with('manager');
    }

    protected function personnelScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return $this->adminScope()->where('manager_id', $user->getKey())->where('type', CompanyType::DELIVERY);
    }

    protected function topHrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $ids = StoreUserService::getTopHrTeamIds($user);

        return $this->adminScope()->where(function($query) use ($ids){
            $query->orWhere('type', CompanyType::DELIVERY)->orWhereIn('manager_id', $ids);
        });

    }

    protected function hrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return $this->adminScope()->where(function($query) use ($user){
            $query->orWhere('type', CompanyType::DELIVERY)->orWhere('manager_id', $user->getKey());
        });
    }

    public function getModel(): Model
    {
        return new Company();
    }
}
