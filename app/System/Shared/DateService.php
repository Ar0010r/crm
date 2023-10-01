<?php

namespace App\System\Shared;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class DateService
{
    public static function getDays(\DateTimeInterface $from, \DateTimeInterface $to): Collection
    {
        $start = Carbon::parse($from);
        $end = Carbon::parse($to);
        $days = [];

        while ($start->lte($end)) {
            $days[] = $start->toDateString();
            $start->addDay();
        }

        return collect($days);
    }
}
