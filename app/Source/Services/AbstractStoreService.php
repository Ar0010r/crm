<?php

namespace App\Source\Services;

use App\Source\Services\Contracts\StoreResourceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class AbstractStoreService implements StoreResourceInterface
{
    public function store(Model $model): bool
    {
        return $model->saveOrFail();
    }

    public function update(Model $model): bool
    {
        return $model->updateOrFail();
    }

    public function destroy(Model $model): bool
    {
        return $model->deleteOrFail();
    }

    public function updateOrCreate(Model $model): bool
    {
        return $model->getKey() ? $this->update($model) : $this->store($model);
    }

    public function make(Request $request, Model $resource = null): Model
    {
        $model = $this->getModel();

        return $resource ? $resource->fill($request->all()) : $model::make($request->all());
    }

    abstract protected function getModel(): Model;
}
