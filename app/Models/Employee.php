<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'company_id',
        'hr_id',
        'status',
        'birthday',
        'name',
        'avatar',
        'email',
        'paypal',
        'address',
        'city',
        'state',
        'pickup',
        'zip',
        'phone_1',
        'phone_2',
        'race',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password',
        //'remember_token',
    ];

    public function hr()
    {
        return $this->belongsTo(User::class, 'hr_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i');
    }
}
