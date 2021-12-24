<?php


namespace App\Services;

use App\Services\Contracts\UserResourceServiceInterface;
use App\Shared\Value\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;
use App\Services\Concrete\User\UserService;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractUserResourceService implements UserResourceServiceInterface
{
    protected User $user;
    protected Model $resource;
    protected QueryBuilder | Builder $basicQuery;

    public function __construct()
    {
        $this->resource = $this->getResourceModel();
        $this->basicQuery = $this->getBaseQuery();
    }

    public function getUserResources(User $u = null, int $take = 100): LengthAwarePaginator
    {
        $this->user = $u ?? auth()->user();

        switch ($this->user->role) {
            case Role::ADMIN:
                return $this->adminResources()->paginate($take);
            case Role::PERSONNEL:
                return $this->personnelResources()->paginate($take);
            case Role::TOP_HR:
                return $this->topHrResources()->paginate($take);
            default:
                return $this->hrResources()->paginate($take);
        }
    }

    protected function adminResources()
    {
        return $this->basicQuery;
    }

    protected function personnelResources()
    {
        return $this->basicQuery->where('manager_id', $this->user->id);
    }

    protected function topHrResources()
    {
        $hrIds = UserService::getTopHrTeamIds($this->user);

        return $this->basicQuery->whereIn('hr_id', $hrIds);
    }

    protected function hrResources()
    {
        return $this->basicQuery->where('hr_id', $this->user->id);
    }

    public function getBaseQuery()
    {
        return QueryBuilder::for(get_class($this->resource));
    }

    abstract public function getResourceModel(): Model;
}
