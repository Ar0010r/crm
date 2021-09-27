<?php


namespace App\Services\Concrete\Letter;

use App\Models\Letter;
use App\Services\AbstractResourceService;
use App\Services\AbstractUserResourceService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class UserLetterService extends AbstractUserResourceService
{
    protected function personnelResources(): QueryBuilder
    {
        $ids = $this->user->companies()->pluck('companies.id');
        return $this->basicQuery->whereIn('company_id', $ids);
    }

    public function getBaseQuery(): QueryBuilder|Builder
    {
        return parent::getBaseQuery()->select(['*', DB::raw('sum(google+yahoo+outlook+other) as total')])
            ->with('hr')->groupBy('letters.id');
    }

    public function getResourceModel(): Model
    {
        return new Letter();
    }
}
