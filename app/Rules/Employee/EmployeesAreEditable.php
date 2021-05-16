<?php

namespace App\Rules\Employee;

use App\Models\Employee;
use Illuminate\Contracts\Validation\Rule;
use phpDocumentor\Reflection\Types\Array_;
use function PHPUnit\Framework\isEmpty;

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
