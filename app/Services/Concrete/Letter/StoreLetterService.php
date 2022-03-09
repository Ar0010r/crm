<?php


namespace App\Services\Concrete\Letter;


use App\Models\Letter;
use App\Services\AbstractStoreService;
use Illuminate\Database\Eloquent\Model;

class StoreLetterService extends AbstractStoreService
{
    public function store(Model $model): bool
    {
        $model->hr_id = $model->hr_id ??  auth()->id();
        $model->company;
        return parent::store($model); // TODO: Change the autogenerated stub
    }

    protected function getModel(): Model
    {
        return new Letter();
    }

}
