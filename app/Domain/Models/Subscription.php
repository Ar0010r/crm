<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasUuid;

    protected $fillable = [
        'provider',
        'service',
        'price',
        'last_payment',
        'period'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
