<?php


namespace App\Services\Concrete\Test;


use App\Models\Test;
use App\Services\AbstractStoreService;
use Illuminate\Database\Eloquent\Model;

class StoreTestService extends AbstractStoreService
{
    public function store(Model $model): bool
    {
        $model->manager_id = $model->manager_id ??  auth()->id();
        return parent::store($model);
    }

    protected function getModel(): Model
    {
        return new Test();
    }

}
