<?php


namespace App\Services\Concrete\User;

use App\Models\User;
use App\Services\AbstractScopeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QBuilder;
use Spatie\QueryBuilder\QueryBuilder;

class ScopeUserService extends AbstractScopeService
{
    protected function topHrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $ids = StoreUserService::getTopHrTeamIds($user);

        return User::whereIn('id', $ids);
    }

    protected function adminScope(): QueryBuilder|Builder|QBuilder
    {
        return User::query();
    }

    protected function personnelScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return User::where('id', $user->getKey());
    }

    protected function hrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return User::where('id', $user->getKey());
    }

    public function getModel(): Model
    {
        return new User();
    }
}
