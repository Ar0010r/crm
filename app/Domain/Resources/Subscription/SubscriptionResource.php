<?php

namespace App\Domain\Resources\Subscription;

use App\Source\Resources\ModelResource;

class SubscriptionResource extends ModelResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'provider' => $this->provider,
            'service' => $this->service,
            'price' => $this->price,
            'last_payment' => $this->last_payment,
            'period' => $this->period,
            'company' => $this->company,
        ];
    }
    /*public function toArray($request)
    {
        return array_merge(
            $this->resource->attributesToArray(),
            [
                'company' => $this->company,
            ]
        );
    }*/
}
