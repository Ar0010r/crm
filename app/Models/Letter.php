<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Letter extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'id',
        'hr_id',
        'company_id',
        'google',
        'outlook',
        'yahoo',
        'other',
        'received_at',
        'processed'
    ];

    public function hr()
    {
        return $this->hasOne(User::class, 'id', 'hr_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function scopeReceivedBefore(Builder $query, $date): Builder
    {
        return $query->where('received_at', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeReceivedAfter(Builder $query, $date): Builder
    {
        return $query->where('received_at', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }
}
