<?php

namespace App\Http\Requests\Concrete\Letter;


use App\Http\Requests\AbstractGetRequest;
use App\Http\Requests\Rules\LetterRequestRules;

class LetterGetRequest extends AbstractGetRequest
{
    use LetterRequestRules;

    public function orderByFields(): array
    {
        return [
            'id',
            'hr_id',
            'company_id',
            'google',
            'outlook',
            'yahoo',
            'other',
            'received_at',
            'processed'
        ];
    }
}
