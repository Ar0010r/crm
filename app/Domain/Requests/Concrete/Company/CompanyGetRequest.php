<?php

namespace App\Domain\Requests\Concrete\Company;

use App\Source\Requests\AbstractGetRequest;
use App\Domain\Requests\Rules\CompanyRequestRules;

class CompanyGetRequest extends AbstractGetRequest
{
    use CompanyRequestRules;

    protected array $with = ['manager'];

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

    protected function additionalFilters(): array
    {
        return ['created_from' => 'date', 'created_to' => 'date'];
    }
}
