<?php

namespace App\Domain\Requests\Concrete\Test;


use App\Source\Requests\AbstractStoreRequest;
use App\Domain\Requests\Permissions\AnyManagerAllowed;
use App\Domain\Requests\Rules\TestRequestRules;

class TestStoreRequest extends AbstractStoreRequest
{
    use AnyManagerAllowed;
    use TestRequestRules;

    public function required(): array
    {
        return [
            'date',
            'env',
            'template',
            'company_id'
        ];
    }
}
