<?php


namespace App\Services;

use App\Services\Contracts\ScopeResourceInterface;
use App\Shared\Value\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QBuilder;
use Spatie\QueryBuilder\QueryBuilder;
use App\Services\Concrete\User\StoreUserService;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractScopeService implements ScopeResourceInterface
{
    public function getScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return match ($user->role) {
            Role::ADMIN => $this->adminScope(),
            Role::PERSONNEL => $this->personnelScope($user),
            Role::TOP_HR => $this->topHrScope($user),
            default => $this->hrScope($user),
        };
    }

    protected function adminScope(): QueryBuilder|Builder|QBuilder
    {
        return QueryBuilder::for(get_class($this->getModel()));
    }

    protected function personnelScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return $this->adminScope()->where('manager_id', $user->id);
    }

    protected function topHrScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $hrIds = StoreUserService::getTopHrTeamIds($user);

        return $this->adminScope()->whereIn('hr_id', $hrIds);
    }

    protected function hrScope(User $user)
    {
        return $this->adminScope()->where('hr_id', $user->id);
    }

    abstract public function getModel(): Model;
}
