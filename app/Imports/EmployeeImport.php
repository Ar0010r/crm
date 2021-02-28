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
        /*if(!isset($row[16])){
            return null;
        }*/
        $company = Company::where('name', $row['company'])->first();

        return new Employee([
            'company_id' => $company['id'] ?? null,
            'hr_id' => auth()->user()->getAuthIdentifier(),
            'status' => $row['status'],
            'name' => $row['name'],
            'email' => $row['email'],
            'paypal' => $row['paypal'],
            'address' => $row['address'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip' => $row['zip'],
            'phone_1' => $row['phone_1'],
            'phone_2' => $row['phone_2'],
            'race' => $row['race'],
        ]);
    }

    public function rules(): array
    {
        return  $rules = $this->basicRules();
    }
}
