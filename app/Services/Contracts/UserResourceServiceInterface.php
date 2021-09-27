<?php


namespace App\Services\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserResourceServiceInterface
{
    public function getUserResources(User $u): LengthAwarePaginator;

    public function getResourceModel(): Model;
}
