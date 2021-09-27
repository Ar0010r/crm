<?php


namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface ResourceServiceInterface
{
    public function get(User $u = null): LengthAwarePaginator;

    public function all(): Collection;

    public function store(Model $m): bool;

    public function show(Model $m): Model;

    public function update(Model $m): bool;

    public function updateOrCreate(Model $m): bool;

    public function destroy(Model $m): bool;

    public function make(Request $r, Model $model = null): Model;
}
