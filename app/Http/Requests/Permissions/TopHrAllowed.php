<?php

namespace App\Http\Requests\Permissions;

use App\Shared\Value\Role;

trait TopHrAllowed
{
    public function hasPermission(): bool
    {
        return auth()->user()->role === Role::TOP_HR;
    }
}
