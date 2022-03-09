<?php

namespace App\System\Search\Database\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait HasScopeFilters
{
    public function scopeCreatedDateFrom(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date)->format('Y-m-d'));
    }

    public function scopeCreatedDateTo(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date)->format('Y-m-d'));
    }
}
