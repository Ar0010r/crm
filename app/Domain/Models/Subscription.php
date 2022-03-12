<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use App\System\Search\Database\RangeFilters\SubscriptionRangeFilters;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasUuid;
    use SubscriptionRangeFilters;
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'provider',
        'service',
        'price',
        'last_payment',
        'period'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
