<?php

namespace App\Shared\Value;

class Race
{
    public const BLACK = 'Black';
    public const WHITE = 'White';
    public const ASIAN = 'Asian';
    public const ARAB = 'Arab';
    public const INDIAN = 'Indian';

    public const RACES = [
        self::BLACK,
        self::WHITE,
        self::ASIAN,
        self::INDIAN,
        self::ARAB
    ];
}
