<?php


namespace App\Domain\Services\Test;


use App\Domain\Models\Test;
use App\Source\Services\AbstractStoreService;
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
