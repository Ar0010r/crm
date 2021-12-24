<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
