<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use App\Services\UserService;
use App\Shared\Value\Role;
use App\Shared\Value\Status;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'name',
        'email',
        'domain',
        'pseudonym',
        'personnel_id'
    ];

    public function personnel()
    {
        return $this->belongsTo(User::class, 'personnel_id', 'id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id', 'id');
    }

    public function goodEmployees()
    {
        return $this->employees()
            ->whereIn('status', [
                    Status::READY,
                    Status::INVITED,
                    Status::EXPORTED
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

    public function letters()
    {
        return $this->hasMany(Letter::class, 'company_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
