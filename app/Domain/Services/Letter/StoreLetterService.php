<?php


namespace App\Domain\Services\Letter;

use App\Domain\Models\Letter;
use App\Source\Services\AbstractStoreService;
use Illuminate\Database\Eloquent\Model;

class StoreLetterService extends AbstractStoreService
{
    public function store(Model $model): bool
    {
        $model->hr_id = $model->hr_id ??  auth()->id();

        return parent::store($model);
    }

    public function update(Model $model): bool
    {
        $original = Letter::query()->findOrFail($model->getKey());
        $increase = $model->processed - $original->processed;
        $increase != 0 && MailLogService::process($original, $increase);

        return parent::update($model);
    }

    protected function getModel(): Model
    {
        return new Letter();
    }

}
