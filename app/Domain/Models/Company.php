<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use App\System\Search\Database\RangeFilters\CompanyRangeFilters;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasUuid;
    use HasFactory;
    use SoftDeletes;
    use CompanyRangeFilters;

    protected $fillable = [
        'name',
        'type',
        'email',
        'domain',
        'pseudonym',
        'manager_id',
        'status',
        'scam'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id')
            ->select(['users.id', 'users.login']);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id', 'id');
    }

    public function letters()
    {
        return $this->hasMany(Letter::class, 'company_id', 'id');
    }

    public function tests()
    {
        return $this->hasMany(Test::class, 'company_id', 'id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'company_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
