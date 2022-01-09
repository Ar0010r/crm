<?php


namespace App\Services\Concrete\Test;

use App\Models\Test;
use App\Models\User;
use App\Services\AbstractScopeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QBuilder;
use Spatie\QueryBuilder\QueryBuilder;

class ScopeTestService extends AbstractScopeService
{

    protected function adminScope(): QueryBuilder|Builder|QBuilder
    {
        return Test::query();
    }

    protected function personnelScope(User $user): QueryBuilder|Builder|QBuilder
    {
        return $this->adminScope()->where('manager_id', $user->getKey());
    }

    protected function hrScope(User $user)
    {
        return $this->adminScope()->where('manager_id', $user->getKey());
    }

    public function getModel(): Model
    {
        return new Test();
    }
}
