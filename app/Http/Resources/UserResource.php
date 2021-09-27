<?php

namespace App\Http\Resources;

use App\Http\Resources\Base\ModelResource;

class UserResource extends ModelResource
{
    public function toArray($request)
    {
        return $this->resource->attributesToArray();
    }
}
