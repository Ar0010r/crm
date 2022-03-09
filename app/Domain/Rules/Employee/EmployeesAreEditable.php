<?php

namespace App\Domain\Rules\Employee;

use App\Domain\Models\Employee;
use Illuminate\Contracts\Validation\Rule;

class EmployeesAreEditable implements Rule
{
    private const EMPTY_DATA_ERROR = 'Array with applicants that must be deleted is empty';
    private const WRONG_DATA_ERROR = 'One employee that you try to delete does not exist. Please reload the page';
    private array $employee = [];

    public function passes($attribute, $value)
    {
        foreach ($value as $employee) {
            $isNotValid = Employee::where(['id' => $employee['id']])->doesntExist();
            if ($isNotValid) {
                $this->employee = $employee;
                return false;
            }
        }

        return ! empty($value);
    }

    public function message()
    {
        return empty($this->employee) ? self::EMPTY_DATA_ERROR : self::WRONG_DATA_ERROR;
    }
}
