<?php

namespace App\Domain\Requests\Concrete\Test;

use App\Domain\Requests\Permissions\AnyManagerAllowed;
use App\Source\Requests\AbstractUpdateRequest;
use App\Domain\Requests\Rules\TestRequestRules;

class TestUpdateRequest extends AbstractUpdateRequest
{
    use AnyManagerAllowed;
    use TestRequestRules;
    public const ENTITY = 'Test';
}
