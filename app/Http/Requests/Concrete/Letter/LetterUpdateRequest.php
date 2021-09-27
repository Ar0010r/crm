<?php

namespace App\Http\Requests\Concrete\Letter;

use App\Http\Requests\AbstractUpdateRequest;
use App\Http\Requests\Permissions\HrAllowed;
use App\Http\Requests\Rules\LetterRequestRules;

class LetterUpdateRequest extends AbstractUpdateRequest
{
    use HrAllowed;
    use LetterRequestRules;
    public const ENTITY = 'letter';
}
