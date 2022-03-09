<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use App\Domain\Enums\Status;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Company extends Model
{
    use HasUuid;
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'email',
        'domain',
        'pseudonym',
        'manager_id'
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
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

    public function scopeCreatedBefore(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeCreatedAfter(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }
}
