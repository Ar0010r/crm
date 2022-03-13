<?php

namespace App\Domain\Requests\Concrete\Employee;

use App\Source\Requests\AbstractGetRequest;
use App\Domain\Requests\Rules\EmployeeRequestRules;

class EmployeeGetRequest extends AbstractGetRequest
{
    use EmployeeRequestRules;

    protected array $with = ['hr', 'company'];
    protected array $withExists = ['selfie', 'agreement', 'scan'];

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'contacted_between' => ['nullable'],
            'contacted_before' => ['nullable'],
            'contacted_after' => ['nullable']
        ]);
    }

    public function orderByFields(): array
    {
        return [
            'id',
            'company_id',
            'hr_id',
            'status',
            'birthday',
            'name',
            'avatar',
            'email',
            'paypal',
            'address',
            'city',
            'state',
            'pickup',
            'zip',
            'phone_1',
            'phone_2',
            'race',
        ];
    }
}
