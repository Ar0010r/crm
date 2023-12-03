<?php

namespace App\Domain\Models;

use App\Source\Traits\HasUuid;
use App\System\Media\MediaCollection;
use App\System\Search\Database\RangeFilters\EmployeeRangeFilters;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model  implements HasMedia
{
    use HasFactory, HasUuid, EmployeeRangeFilters, InteractsWithMedia, SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'hired_at'];

    protected $fillable = [
        'id',
        'company_id',
        'hr_company_id',
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
        'secondary_email',
        'address_2'
    ];

    public function hr()
    {
        return $this->belongsTo(User::class, 'hr_id', 'id')
            ->select(['users.id', 'users.login']);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')
            ->select(['companies.id', 'companies.name']);
    }

    public function hrCompany()
    {
        return $this->belongsTo(Company::class, 'hr_company_id', 'id')
            ->select(['companies.id', 'companies.name']);
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
}
