<?php

namespace App\Rules\Employee;

use App\Models\Employee;
use Illuminate\Contracts\Validation\Rule;

class EmployeesAreEditable implements Rule
{
    private $employee;


    public function passes($attribute, $value)
    {
        foreach ($value as $employee) {
            $isNotValid = Employee::where(['id' => $employee['id']])->doesntExist();
            if ($isNotValid) {
                $this->employee = $employee;
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'One employee that you try to delete does not exist. Please reload the page';
    }
}
