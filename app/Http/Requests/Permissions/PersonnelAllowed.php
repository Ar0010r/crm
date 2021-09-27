<?php

namespace App\Http\Requests\Permissions;

use App\Shared\Value\Role;

trait PersonnelAllowed
{
    public function hasPermission(): bool
    {
        return auth()->user()->role === Role::PERSONNEL;
    }
}
