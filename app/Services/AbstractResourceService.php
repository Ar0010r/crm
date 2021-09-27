<?php


namespace App\Services;

use App\Models\User;
use App\Services\Contracts\ResourceServiceInterface;
use App\Services\Contracts\UserResourceServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Illuminate\Http\Request;

abstract class AbstractResourceService implements ResourceServiceInterface
{
    private Model $model;
    private UserResourceServiceInterface $resourceService;

    public function __construct(UserResourceServiceInterface $s)
    {
        $this->resourceService = $s;
        $this->model = $s->getResourceModel();
    }

    public function all(): Collection
    {
        return $this->model::all();
    }

    public function get(User $u = null): LengthAwarePaginatorContract
    {
        $user = $u ?? auth()->user();
        $take = request()->get('recordsPerPage') ?? 100;

        return $this->resourceService->getUserResources($user, $take);
    }

    public function store(Model $model): bool
    {
        return $model->save();
    }

    public function show(Model $model): Model
    {
        return $model;
    }

    public function update(Model $model): bool
    {
        return $model->update();
    }

    public function destroy(Model $model): bool
    {
        return $model->delete();
    }

    public function updateOrCreate(Model $model): bool
    {
        return $model->getKey() ? $this->update($model) : $this->store($model);
    }

    public function make(Request $r, Model $model = null): Model
    {
        return $model ? $model->fill($r->all()) : $this->model::make($r->all());
    }
}
