<?php

namespace App\Models;

use App\Models\Pivot\TopHrHr;
use App\Shared\Value\Role;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'login',
        'avatar',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        //'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'personnel_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'hr_id', 'id');
    }

    public function hrEmployees()
    {

    }

    public function topHrEmployees()
    {
        return $this->topHrHrs()->with('employees')->select('employees.*');
    }

    public function personnelEmployees()
    {
        
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
    public function permissions()
    {
        if (!array_key_exists($this->role, Role::PERMISSIONS)) {
            throw new \Exception('it seems that user role was specified incorrectly : ' . $this->role);
        }
        return Role::PERMISSIONS[$this->role];
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i');
    }
}
