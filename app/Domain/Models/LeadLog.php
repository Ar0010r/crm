<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use App\System\Search\Database\RangeFilters\LetterRangeFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadLog extends Model
{
    use HasFactory, HasUuid, LetterRangeFilters;

    protected $fillable = [
        'id',
        'employee_id',
        'action',
        'created_at'
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
