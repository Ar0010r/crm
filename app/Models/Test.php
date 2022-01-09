<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
