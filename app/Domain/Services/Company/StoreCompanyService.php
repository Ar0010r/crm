<?php


namespace App\Domain\Services\Company;

use App\Domain\Models\Company;
use App\Domain\Models\User;
use App\Source\Services\AbstractStoreService;
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
