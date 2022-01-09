<?php

namespace App\Http\Requests\Rules;

trait TestRequestRules
{
    public function baseRules(): array
    {
        return [
            'manager_id' => ['uuid', 'exists:users,id', 'nullable'],
            'env' => ['string'],
            'template' => ['string'],
            'company_id' => ['nullable', 'string', 'exists:companies,id'],
            'google' => ['boolean', 'nullable'],
            'outlook' => ['boolean', 'nullable'],
            'yahoo' => ['boolean', 'nullable'],
            'other' => ['boolean', 'nullable'],
            'date' => ['date']
        ];
    }
}
