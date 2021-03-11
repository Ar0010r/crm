<?php

namespace App\Imports;

use App\Http\Requests\Employee\EmployeeRequestRulesTrait;
use App\Models\Company;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeeImport implements ToModel, WithHeadingRow, WithValidation
{
    use EmployeeRequestRulesTrait;

    public function model(array $row)
    {
        $company = Company::where('name', $row['company'])->first();

        return new Employee([
            'company_id' => $company['id'] ?? null,
            'hr_id' => auth()->user()->getAuthIdentifier(),
            'status' => $row['status'] ?? null,
            'name' => $row['name'] ?? null,
            'email' => $row['email'] ?? null,
            'paypal' => $row['paypal'] ?? null,
            'address' => $row['address'] ?? null,
            'birthday' => $row['birthday'] ?? null,
            'city' => $row['city'] ?? null,
            'state' => $row['state'] ?? null,
            'zip' => $row['zip'] ?? null,
            'phone_1' => $row['phone_1'] ?? null,
            'phone_2' => $row['phone_2'] ?? null,
            'race' => $row['race'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return  $rules = $this->basicRules();
    }
}
