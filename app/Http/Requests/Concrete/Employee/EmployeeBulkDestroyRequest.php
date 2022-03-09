<?php

namespace App\Http\Requests\Concrete\Employee;

use App\Http\Requests\AbstractRequest;
use App\Rules\Employee\EmployeesAreEditable;

class EmployeeBulkDestroyRequest extends AbstractRequest
{
    public function baseRules(): array
    {
        return [
            'employees' => ['required', 'array', new EmployeesAreEditable()]
        ];
    }
}
