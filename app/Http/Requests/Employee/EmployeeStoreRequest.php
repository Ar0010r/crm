<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\HrAllowedRequest;

class EmployeeStoreRequest extends HrAllowedRequest
{
    use EmployeeRequestRulesTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->basicRules();
    }
}
