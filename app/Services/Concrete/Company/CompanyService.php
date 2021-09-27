<?php


namespace App\Services\Concrete\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\AbstractResourceService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Illuminate\Database\Eloquent\Model;

class CompanyService extends AbstractResourceService
{
    public function store(Model $model): bool
    {
        return parent::store($model);

        /*$model->employees_count = 0;
        $model->exported_employees_count = 0;
        $model->good_employees_count = 0;*/
    }

    public static function getUserCompanyIds(User $user = null)
    {
        $user = $user ?? auth()->user();
        $companies = $user->companies()->get()->toArray();

        return array_map(function ($company) {
            return $company['id'];
        }, $companies);
    }

}
