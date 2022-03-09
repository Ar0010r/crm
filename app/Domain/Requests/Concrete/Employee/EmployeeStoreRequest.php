<?php

namespace App\Domain\Requests\Concrete\Employee;

use App\Source\Requests\AbstractStoreRequest;
use App\Domain\Requests\Permissions\HrAllowed;
use App\Domain\Requests\Rules\EmployeeRequestRules;

class EmployeeStoreRequest extends AbstractStoreRequest
{
    use EmployeeRequestRules;
    use HrAllowed;

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

    public function required(): array
    {
        return ['name', 'email', 'company_id'];
    }
}
