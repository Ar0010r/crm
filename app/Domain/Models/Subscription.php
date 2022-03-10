<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasUuid;

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
