<?php

namespace App\Http\Requests\Concrete\Employee;

use App\Http\Requests\AbstractGetRequest;
use App\Http\Requests\Rules\EmployeeRequestRules;

class EmployeeGetRequest extends AbstractGetRequest
{
    use EmployeeRequestRules;

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
