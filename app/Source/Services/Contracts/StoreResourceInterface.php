<?php


namespace App\Source\Services\Contracts;

use App\Domain\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface StoreResourceInterface
{
    public function make(Request $r): Model;

    public function store(Model $model): bool;

    public function update(Model $model): bool;

    public function updateOrCreate(Model $model): bool;

    public function destroy(Model $model): bool;
}
