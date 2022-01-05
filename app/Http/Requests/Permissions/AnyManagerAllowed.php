<?php

namespace App\Http\Requests\Permissions;

use App\Shared\Value\Role;

trait AnyManagerAllowed
{
    public function hasPermission(): bool
    {
        return true;
    }
}
