<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use App\Shared\Value\MediaCollection;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model  implements HasMedia
{
    use HasFactory, HasUuid, InteractsWithMedia;

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
        'contacted',
    ];

    public function hr()
    {
        return $this->belongsTo(User::class, 'hr_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function selfie(): MorphMany
    {
        return $this->media()->where('collection_name', MediaCollection::SELFIE);
    }

    public function agreement(): MorphMany
    {
        return $this->media()->where('collection_name', MediaCollection::AGREEMENT);
    }

    public function scan(): MorphMany
    {
        return $this->media()->where('collection_name', MediaCollection::SCAN);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function scopeContactedBefore(Builder $query, $date): Builder
    {
        return $query->where('contacted', '<=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeContactedAfter(Builder $query, $date): Builder
    {
        return $query->where('contacted', '>=', Carbon::parse($date)->format('Y-m-d h:m:s'));
    }

    public function scopeContactedBetween(Builder $query, $from, $to): Builder
    {
        return $query->where('contacted', '>=', Carbon::parse($from)->format('Y-m-d h:m:s'))
            ->where('contacted', '<=', Carbon::parse($to)->format('Y-m-d h:m:s'));
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
