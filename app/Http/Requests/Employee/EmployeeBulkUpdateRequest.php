<?php

namespace App\Http\Requests\Employee;

use App\Rules\Employee\EmployeesAreEditable;
use App\Shared\Value\Status;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeBulkUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employees' => new EmployeesAreEditable(),
            'status' => 'required|string|in:' . implode(',', Status::STATUSES),

        ];
    }
}
