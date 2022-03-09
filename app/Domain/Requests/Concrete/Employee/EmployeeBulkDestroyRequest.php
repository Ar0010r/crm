<?php

namespace App\Domain\Requests\Concrete\Employee;

use App\Source\Requests\AbstractRequest;
use App\Domain\Rules\Employee\EmployeesAreEditable;

class EmployeeBulkDestroyRequest extends AbstractRequest
{
    public function baseRules(): array
    {
        return [
            'employees' => ['required', 'array', new EmployeesAreEditable()]
        ];
    }
}
