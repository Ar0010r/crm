<?php

namespace App\Http\Requests\Rules;

trait LetterRequestRules
{
    public function baseRules(): array
    {
        return [
            'hr_id' => ['string', 'exists:users,id'],
            'company_id' => ['nullable', 'string', 'exists:companies,id'],
            'google' => ['numeric'],
            'outlook' => ['numeric'],
            'yahoo' => ['numeric'],
            'received_at' => ['date']
        ];
    }
}
