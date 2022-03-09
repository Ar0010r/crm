<?php


namespace App\Domain\Services\Letter;

use App\Domain\Models\Letter;
use App\Domain\Models\User;
use App\Source\Services\AbstractScopeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QBuilder;
use Spatie\QueryBuilder\QueryBuilder;

class ScopeLetterService extends AbstractScopeService
{

    protected function adminScope(): QueryBuilder|Builder|QBuilder
    {
        return Letter::query();
    }

    protected function personnelScope(User $user): QueryBuilder|Builder|QBuilder
    {
        $ids = $user->companies()->pluck('companies.id');
        return $this->adminScope()->whereIn('company_id', $ids);
    }

    public function getModel(): Model
    {
        return new Letter();
    }
}
