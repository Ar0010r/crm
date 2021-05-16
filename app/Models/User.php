<?php

namespace App\Models;

use App\Models\Pivot\TopHrHr;
use App\Models\Traits\HasUuid;
use App\Shared\Value\Role;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasUuid;

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
        if($this->role === Role::PERSONNEL){
            return $this->hasMany(Company::class, 'personnel_id', 'id');
        }
        return Company::query()->select('companies.*');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'hr_id', 'id');
    }

    public function topHrEmployees()
    {
        return $this->topHrHrs()->with('employees')->select('employees.*');
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
