<?php

namespace App\Domain\Resources;

use App\Source\Resources\ModelResource;

class SubscriptionResource extends ModelResource
{
    public function toArray($request)
    {
        return array_merge(
            $this->resource->attributesToArray(),
            [
                'company' => $this->company,
            ]
        );
    }
}
