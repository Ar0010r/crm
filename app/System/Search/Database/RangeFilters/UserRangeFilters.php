<?php

namespace App\System\Search\Database\RangeFilters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait UserRangeFilters
{
    public function scopeCreatedBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeCreatedAfter(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }
}
