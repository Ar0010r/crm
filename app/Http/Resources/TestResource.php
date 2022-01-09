<?php

namespace App\Http\Resources;

use App\Http\Resources\Base\ModelResource;

class TestResource extends ModelResource
{
    public function toArray($request)
    {
        return array_merge(
            $this->resource->attributesToArray(),
            [
                'manager' => $this->manager,
                'company' => $this->company,
            ]
        );
    }
}
