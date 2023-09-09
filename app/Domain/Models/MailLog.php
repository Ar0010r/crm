<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use App\System\Search\Database\RangeFilters\LetterRangeFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailLog extends Model
{
    use HasFactory, HasUuid, LetterRangeFilters;

    protected $fillable = [
        'id',
        'batch_id',
        'hr_id',
        'processed',
        'wave',
        'created_at'
    ];

    public function letter()
    {
        return $this->hasOne(Letter::class, 'id', 'batch_id');
    }
}
