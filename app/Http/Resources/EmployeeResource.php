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
                'company' => $this->company
            ]
        );
    }
}
