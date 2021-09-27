<?php

namespace App\Http\Requests\Concrete\Employee;

use App\Http\Requests\AbstractRequest;
use App\Http\Requests\Permissions\HrAllowed;
use App\Rules\Employee\EmployeesAreEditable;
use App\Shared\Value\Status;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeBulkUpdateRequest extends AbstractRequest
{
    public function baseRules(): array
    {
        return [
            'employees' => ['required', 'array', new EmployeesAreEditable()],
            'status' => 'required|string|in:' . implode(',', Status::STATUSES)
        ];
    }
}
