<?php

namespace App\Domain\Models;

use App\Domain\Requests\Rules\TestRequestRules;
use App\Source\Traits\HasUuid;
use App\System\Search\Database\RangeFilters\TestRangeFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory, HasUuid, TestRangeFilters, SoftDeletes;

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
        return $this->hasOne(User::class, 'id', 'manager_id')
            ->select(['users.id', 'users.login']);
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id')
            ->select(['companies.id', 'companies.name']);
    }
}
