<?php

namespace App\Http\Requests\Concrete\Employee;

use App\Http\Requests\AbstractUpdateRequest;
use App\Http\Requests\Permissions\HrAllowed;
use App\Http\Requests\Rules\EmployeeRequestRules;

class EmployeeUpdateRequest extends AbstractUpdateRequest
{
    use EmployeeRequestRules;
    public const ENTITY = 'employee';

    public function unique(): array
    {
        return [
            'email' => 'employees',
            'payapal' => 'employees',
            'address' => 'employees',
            'phone_1' => 'employees',
            'phone_2' => 'employees'
        ];
    }
}

/*public function rules()
    {
        $rules = $this->baseRules();
        $updatedId = $this->route()->parameter('employee');

        $rules['email'] = [Rule::unique('employees')->ignore($updatedId), 'email', 'nullable'];
        $rules['paypal'] = [Rule::unique('employees')->ignore($updatedId), 'email', 'nullable'];
        $rules['address'] = [Rule::unique('employees')->ignore($updatedId), 'string', 'nullable'];

        return $rules;
    }*/
