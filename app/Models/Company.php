<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
