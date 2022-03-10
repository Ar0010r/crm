<?php

namespace App\Domain\Models;

use App\Domain\Models\Pivot\TopHrHr;
use App\Source\Traits\HasUuid;
use App\Domain\Enums\Status;
use App\System\Search\Database\RangeFilters\UserRangeFilters;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasUuid, UserRangeFilters;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'login',
        'avatar',
        'role',
        'password',
    ];


    protected $hidden = [
        'password',
        //'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'manager_id', 'id');
    }

    public function letters()
    {
        return $this->hasMany(Letter::class, 'hr_id', 'id');
    }

    public function goodEmployees()
    {
        return $this->employees()
            ->whereIn('status', [
                    Status::READY,
                    Status::INVITED,
                    Status::EXPORTED,
                    Status::DIED
                ]
            );
    }

    public function exportedEmployees()
    {
        return $this->employees()
            ->whereIn('status', [
                    Status::EXPORTED
                ]
            );
    }

    public function hrEmployees()
    {
        return $this->hasMany(Employee::class, 'hr_id', 'id');
    }


    public function personnelEmployees()
    {
        return $this->hasManyThrough(
            Employee::class,
            Company::class,
            'manager_id',
            'company_id',
            'id',
            'id'
        )->whereIn('employees.status', [
            Status::READY,
            Status::INVITED,
            Status::EXPORTED,
            Status::DIED,
        ]);
    }

    public function topHrHrs()
    {
        return $this->hasManyThrough(
            self::class,
            TopHrHr::class,
            'top_hr_id',
            'id',
            'id',
            'hr_id'
        );
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
