<?php

namespace App\Domain\Enums;

class Race
{
    public const BLACK = 'Black';
    public const WHITE = 'White';
    public const ASIAN = 'Asian';
    public const ARAB = 'Arab';
    public const INDIAN = 'Indian';
    public const LATIN = 'Latin';

    public const RACES = [
        self::BLACK,
        self::WHITE,
        self::ASIAN,
        self::INDIAN,
        self::ARAB,
        self::LATIN
    ];
}
