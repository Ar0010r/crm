<?php

namespace App\Domain\Resources\Employee;

use App\Source\Resources\ModelResource;
use DateTimeInterface;

class EmployeeResource extends ModelResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'hr_company_id' => $this->hr_company_id,
            'hr_id' => $this->hr_id,
            'status' => $this->resource->status,
            'birthday' => $this->birthday,
            'name' => $this->name,
            'avatar' => $this->avatar,
            'email' => $this->email,
            'paypal' => $this->paypal,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'pickup' => $this->pickup,
            'zip' => $this->zip,
            'phone_1' => $this->phone_1,
            'phone_2' => $this->phone_2,
            'race' => $this->race,
            'contacted' => $this->contacted,
            'created_at'=> $this->created_at->format('Y-m-d'),
            'hired_at'=> $this->hired_at instanceof DateTimeInterface ? $this->hired_at->format('Y-m-d'): null,

            'hr' => $this->hr,
            'company' => $this->company,
            'hrCompany' => $this->hrCompany,
            'agreement_exists' => $this->agreement_exists ?? $this->agreement()->exists(),
            'selfie_exists' => $this->selfie_exists ?? $this->selfie()->exists(),
            'scan_exists' => $this->scan_exists ?? $this->scan()->exists()
        ];
    }
}
