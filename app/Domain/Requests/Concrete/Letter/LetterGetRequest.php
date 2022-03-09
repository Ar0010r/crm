<?php

namespace App\Domain\Requests\Concrete\Letter;


use App\Source\Requests\AbstractGetRequest;
use App\Domain\Requests\Rules\LetterRequestRules;

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
