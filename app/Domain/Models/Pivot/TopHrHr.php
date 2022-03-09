<?php


namespace App\Domain\Models\Pivot;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class TopHrHr extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'top_hr_id',
        'hr_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i');
    }
}
