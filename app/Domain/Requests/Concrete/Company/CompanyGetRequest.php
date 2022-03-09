<?php

namespace App\Domain\Requests\Concrete\Company;

use App\Source\Requests\AbstractGetRequest;
use App\Domain\Requests\Permissions\AnyManagerAllowed;
use App\Domain\Requests\Rules\CompanyRequestRules;

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
