<?php


namespace App\Services\Concrete\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\AbstractStoreService;
use Illuminate\Database\Eloquent\Model;

class StoreCompanyService extends AbstractStoreService
{
    public static function getUserCompanyIds(User $user = null)
    {
        $user = $user ?? auth()->user();
        $companies = $user->companies()->get()->toArray();

        return array_map(function ($company) {
            return $company['id'];
        }, $companies);
    }

    protected function getModel(): Model
    {
        return new Company();
    }

}
