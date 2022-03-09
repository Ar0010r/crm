<?php

namespace App\Shared\Value;

class MediaCollection
{
    public const SELFIE = 'selfie';
    public const AGREEMENT = 'agreement';
    public const SCAN = 'scan';

    public const ALL = [
        self::SELFIE,
        self::AGREEMENT,
        self::SCAN,
    ];
}
