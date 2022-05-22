<?php

namespace App\Domain\Requests\Rules;

trait SubscriptionRequestRules
{
    public function baseRules(): array
    {
        return [
            'company_id' => ['nullable', 'exists:companies,id'],
            'hr_id' => ['nullable', 'exists:users,id'],
            'provider' => ['nullable', 'string'],
            'service' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric'],
            'last_payment' => ['nullable', 'date'],
            'status' => ['nullable', 'string']
        ];
    }
}
