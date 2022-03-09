<?php

namespace App\Domain\Resources;

use App\Source\Resources\ModelResource;

class CompanyResource extends ModelResource
{
    public function toArray($request)
    {
        return array_merge(
            $this->resource->attributesToArray(),
            [
                'personnel' => $this->personnel,
                'employees_count' => $this->employees_count ?? 0,
                'good_employees_count' => $this->good_employees_count ?? 0,
                'exported_employees_count' => $this->exported_employees_count ?? 0,
            ]
        );
    }
}
