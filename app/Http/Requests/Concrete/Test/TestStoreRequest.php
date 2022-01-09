<?php

namespace App\Http\Requests\Concrete\Test;


use App\Http\Requests\AbstractStoreRequest;
use App\Http\Requests\Permissions\AnyManagerAllowed;
use App\Http\Requests\Rules\TestRequestRules;

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
