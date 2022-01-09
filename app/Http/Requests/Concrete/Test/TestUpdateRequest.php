<?php

namespace App\Http\Requests\Concrete\Test;

use App\Http\Requests\AbstractUpdateRequest;
use App\Http\Requests\Permissions\HrAllowed;
use App\Http\Requests\Rules\TestRequestRules;

class TestUpdateRequest extends AbstractUpdateRequest
{
    use HrAllowed;
    use TestRequestRules;
    public const ENTITY = 'Test';
}
