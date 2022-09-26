<?php

namespace App\Domain\Requests\Concrete\Employee;

use App\Source\Requests\AbstractRequest;
use App\Domain\Requests\Permissions\HrAllowed;
use App\Domain\Rules\Employee\EmployeesAreEditable;
use App\Domain\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeBulkUpdateRequest extends AbstractRequest
{
    public function baseRules(): array
    {
        return [
            'employees' => ['required', 'nullable', 'array', new EmployeesAreEditable()],
            'status' => 'nullable|string|in:' . implode(',', Status::STATUSES),
            'contacted' => 'nullable|date',
        ];
    }
}
