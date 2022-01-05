<?php


namespace App\Services\Contracts;

use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QBuilder;

interface ScopeResourceInterface
{
    public function getScope(User $user): QueryBuilder|Builder|QBuilder;
}
