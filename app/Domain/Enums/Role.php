<?php

namespace App\Domain\Enums;

class Role
{
    public const HR = 'hr';
    public const TOP_HR = 'top hr';
    public const PERSONNEL = 'personnel';
    public const ADMIN = 'admin';

    public const ADMIN_AVAILABLE_ROLES = [self::HR, self::PERSONNEL, self::TOP_HR];

    public const TOP_HR_AVAILABLE_ROLES = [self::HR];
}
