<?php


namespace App\Domain\Services\User;

use App\Domain\Models\User;
use App\Source\Services\AbstractScopeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QBuilder;
use Spatie\QueryBuilder\QueryBuilder;

class ScopeUserService extends AbstractScopeService
{
    protected function topHrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $ids = GetUserService::getTopHrTeamIds($user);

        return $this->adminScope()->whereIn('id', $ids);
    }

    protected function adminScope(): QueryBuilder|Builder|QBuilder
    {
        return User::query()->with('companies:id,name,manager_id,status');
    }

    protected function personnelScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return $this->adminScope()->where('id', $user->getKey());
    }

    protected function hrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return $this->adminScope()->where('id', $user->getKey());
    }

    public function getModel(): Model
    {
        return new User();
    }
}
