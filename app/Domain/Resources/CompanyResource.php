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
                'manager' => $this->manager,
            ]
        );
    }
}
