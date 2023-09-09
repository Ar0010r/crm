<?php

namespace App\System\Shared;

use Carbon\Carbon;

class DateService
{
    public static function getDays(\DateTimeInterface $from, \DateTimeInterface $to): array
    {
        $start = Carbon::parse($from);
        $end = Carbon::parse($to);
        $days = [];

        while ($start->lte($end)) {
            $days[] = $start->toDateString();
            $start->addDay();
        }

        return $days;
    }
}
