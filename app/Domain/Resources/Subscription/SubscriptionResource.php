<?php

namespace App\Domain\Resources\Subscription;

use App\Domain\Enums\CompanyType;
use App\Domain\Enums\Period;
use App\Source\Resources\ModelResource;
use Illuminate\Support\Carbon;

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
            'next_payment' => $this->next_payment,
            'period' => $this->period,
            'company' => $this->company,
            'status' => $this->resource->status,
            'is_delayed' => $this->isDelayed()
        ];
    }

    private function isDelayed(): bool
    {
        $nextPayment = $this->next_payment;

        if(!is_null($nextPayment)) {
            $date = Carbon::parse($nextPayment);
            $now = Carbon::now();

            return $now->greaterThanOrEqualTo($date) ?? $date->diffInDays($now) < 3;
        }

        return true;
    }
}
