<?php

namespace App\System\Search\Database\RangeFilters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait SubscriptionRangeFilters
{
    public function scopePaidBefore(Builder $query, $date): Builder
    {
        return $query->where('last_payment', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopePaidAfter(Builder $query, $date): Builder
    {
        return $query->where('last_payment', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }
}
