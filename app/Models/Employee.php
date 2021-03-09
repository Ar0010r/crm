<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Employee extends Model implements Searchable
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

    public function getSearchResult(): SearchResult
    {
        $url = route('employees.show', $this->id);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

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
