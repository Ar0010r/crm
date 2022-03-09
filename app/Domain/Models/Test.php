<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Test extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'id',
        'date',
        'manager_id',
        'company_id',
        'env',
        'template',
        'google',
        'outlook',
        'yahoo',
        'other',
    ];

    protected $casts = [
        'outlook' => 'integer',
        'google' => 'integer',
        'yahoo' => 'integer',
    ];

    public function manager()
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function scopeDateBefore(Builder $query, $date): Builder
    {
        return $query->where('date', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeDateAfter(Builder $query, $date): Builder
    {
        return $query->where('date', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }
}
