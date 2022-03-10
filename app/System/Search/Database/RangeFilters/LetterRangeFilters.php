<?php

namespace App\System\Search\Database\RangeFilters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

trait LetterRangeFilters
{
    public function scopeReceivedBefore(Builder $query, $date): Builder
    {
        return $query->where('received_at', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeReceivedAfter(Builder $query, $date): Builder
    {
        return $query->where('received_at', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }
}
