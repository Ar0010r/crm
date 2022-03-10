<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use App\System\Search\Database\RangeFilters\LetterRangeFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Letter extends Model
{
    use HasFactory, HasUuid, LetterRangeFilters;

    protected $fillable = [
        'id',
        'hr_id',
        'company_id',
        'google',
        'outlook',
        'yahoo',
        'other',
        'received_at',
        'processed'
    ];

    public function hr()
    {
        return $this->hasOne(User::class, 'id', 'hr_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
