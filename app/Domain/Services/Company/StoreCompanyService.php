<?php


namespace App\Domain\Services\Company;

use App\Domain\Models\Company;
use App\Domain\Models\User;
use App\Source\Services\AbstractStoreService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function destroy(Model $model): bool
    {
        DB::transaction(function () use($model){
            $model->subscriptions()->delete();
            $model->letters()->delete();
            $model->employees()->delete();
            $model->tests()->delete();
            parent::destroy($model);
        });

        return true;
    }

}
