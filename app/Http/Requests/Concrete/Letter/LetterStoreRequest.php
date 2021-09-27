<?php

namespace App\Http\Requests\Concrete\Letter;


use App\Http\Requests\AbstractStoreRequest;
use App\Http\Requests\Permissions\HrAllowed;
use App\Http\Requests\Rules\LetterRequestRules;

class LetterStoreRequest extends AbstractStoreRequest
{
    use HrAllowed;
    use LetterRequestRules;

    public function required(): array
    {
        return [
            'received_at'
        ];
    }
}
