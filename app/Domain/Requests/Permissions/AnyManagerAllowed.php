<?php

namespace App\Domain\Requests\Permissions;

use App\Domain\Enums\Role;

trait AnyManagerAllowed
{
    public function hasPermission(): bool
    {
        return true;
    }
}
