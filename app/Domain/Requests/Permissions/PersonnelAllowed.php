<?php

namespace App\Domain\Requests\Permissions;

use App\Domain\Enums\Role;

trait PersonnelAllowed
{
    public function hasPermission(): bool
    {
        return auth()->user()->role === Role::PERSONNEL;
    }
}
