<?php

namespace App\System\Search\Database\RangeFilters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait TestRangeFilters
{
    public function scopeDateBefore(Builder $query, $date): Builder
    {
        return $query->where('date', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeDateAfter(Builder $query, $date): Builder
    {
        return $query->where('date', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }
}
