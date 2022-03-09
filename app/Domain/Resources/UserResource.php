<?php

namespace App\Domain\Resources;

use App\Source\Resources\ModelResource;

class UserResource extends ModelResource
{
    public function toArray($request)
    {
        return $this->resource->attributesToArray();
    }
}
