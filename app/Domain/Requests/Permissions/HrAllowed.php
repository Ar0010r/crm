<?php

namespace App\Domain\Requests\Permissions;

use App\Domain\Enums\Role;

trait HrAllowed
{
    public function hasPermission(): bool
    {
        return auth()->user()->role === Role::HR || auth()->user()->role === Role::TOP_HR;
    }
}
