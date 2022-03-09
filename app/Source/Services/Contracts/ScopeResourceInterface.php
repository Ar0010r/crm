<?php


namespace App\Source\Services\Contracts;

use App\Domain\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QBuilder;

interface ScopeResourceInterface
{
    public function getScope(User $user): QueryBuilder|Builder|QBuilder;
}
