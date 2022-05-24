<?php

namespace App\Domain\Enums;

use App\Domain\Models\User;

class Period
{
    public const MONTHLY = 'monthly';
    public const QUARTERLY = 'quarterly';
    public const HALF_YEARLY = 'half-yearly';
    public const YEARLY = 'yearly';
}
