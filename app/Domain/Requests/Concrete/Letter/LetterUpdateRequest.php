<?php

namespace App\Domain\Requests\Concrete\Letter;

use App\Source\Requests\AbstractUpdateRequest;
use App\Domain\Requests\Permissions\HrAllowed;
use App\Domain\Requests\Rules\LetterRequestRules;

class LetterUpdateRequest extends AbstractUpdateRequest
{
    use HrAllowed;
    use LetterRequestRules;
    public const ENTITY = 'letter';
}
