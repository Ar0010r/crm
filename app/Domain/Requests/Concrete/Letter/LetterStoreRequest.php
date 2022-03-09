<?php

namespace App\Domain\Requests\Concrete\Letter;


use App\Source\Requests\AbstractStoreRequest;
use App\Domain\Requests\Permissions\HrAllowed;
use App\Domain\Requests\Rules\LetterRequestRules;

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
