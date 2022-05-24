<?php

namespace App\Domain\Resources\Subscription;

use App\Domain\Enums\Period;
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
            'last_payment' => $this->last_payment->format('Y-m-d'),
            'next_payment' => $this->nextPayment(),
            'period' => $this->period,
            'company' => $this->company,
            'status' => $this->resource->status,
        ];
    }

    private function nextPayment()
    {
        return match ($this->period) {
            Period::MONTHLY => $this->last_payment->addMonth()->format('Y-m-d'),
            Period::QUARTERLY => $this->last_payment->addMonths(3)->format('Y-m-d'),
            Period::HALF_YEARLY => $this->last_payment->addMonths(6)->format('Y-m-d'),
            Period::YEARLY => $this->last_payment->addYear()->format('Y-m-d'),
            default => ""
        };
    }
}
