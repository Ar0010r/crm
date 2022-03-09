<?php

namespace App\Domain\Requests\Permissions;

use App\Domain\Enums\Role;

trait TopHrAllowed
{
    public function hasPermission(): bool
    {
        return auth()->user()->role === Role::TOP_HR;
    }
}
