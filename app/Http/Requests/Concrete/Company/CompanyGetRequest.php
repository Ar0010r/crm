<?php

namespace App\Http\Requests\Concrete\Company;

use App\Http\Requests\AbstractGetRequest;
use App\Http\Requests\Permissions\AnyManagerAllowed;
use App\Http\Requests\Rules\CompanyRequestRules;

class CompanyGetRequest extends AbstractGetRequest
{
    use CompanyRequestRules;

    public function orderByFields(): array
    {
        return [
            'name',
            'type',
            'email',
            'domain',
            'pseudonym',
            'manager_id'
        ];
    }
}
