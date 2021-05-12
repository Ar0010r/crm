<?php

namespace App\Http\Requests\Employee;

use App\Rules\Employee\EmployeesAreEditable;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeBulkDestroyRequest extends FormRequest
{
    use EmployeeRequestRulesTrait;

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
         'employees' => new EmployeesAreEditable()
       ];
    }
}
