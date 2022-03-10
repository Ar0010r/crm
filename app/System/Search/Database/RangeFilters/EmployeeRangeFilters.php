<?php

namespace App\System\Search\Database\RangeFilters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait EmployeeRangeFilters
{
    public function scopeContactedBefore(Builder $query, $date): Builder
    {
        return $query->where('contacted', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeContactedAfter(Builder $query, $date): Builder
    {
        return $query->where('contacted', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeContactedBetween(Builder $query, $from, $to): Builder
    {
        return $query->where('contacted', '>=', Carbon::parse($from)->format('Y-m-d h:m:s'))
            ->where('contacted', '<=', Carbon::parse($to)->format('Y-m-d h:m:s'));
    }

    public function scopeCreatedBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeCreatedAfter(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }
}
