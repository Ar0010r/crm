<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
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
        $rules = $this->basicRules();
        $updatedId = $this->route()->parameter('employee');

        $rules['email'] = [Rule::unique('employees')->ignore($updatedId), 'email', 'nullable'];
        $rules['paypal'] = [Rule::unique('employees')->ignore($updatedId), 'email', 'nullable'];

        return $rules;
    }
}
