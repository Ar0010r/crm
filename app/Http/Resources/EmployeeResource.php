<?php

namespace App\Http\Resources;

use App\Http\Resources\Base\ModelResource;

class EmployeeResource extends ModelResource
{
    public function toArray($request)
    {
        return array_merge(
            $this->resource->attributesToArray(),
            [
                'hr' => $this->hr,
                'company' => $this->company,
                'agreement_exists' => $this->agreement_exists ?? $this->agreement()->exists(),
                'selfie_exists' => $this->selfie_exists ?? $this->selfie()->exists(),
                'scan_exists' => $this->scan_exists ?? $this->scan()->exists()
            ]
        );
    }
}
