<?php

namespace App\Domain\Requests\Concrete\Test;

use App\Source\Requests\AbstractUpdateRequest;
use App\Domain\Requests\Permissions\HrAllowed;
use App\Domain\Requests\Rules\TestRequestRules;

class TestUpdateRequest extends AbstractUpdateRequest
{
    use HrAllowed;
    use TestRequestRules;
    public const ENTITY = 'Test';
}
