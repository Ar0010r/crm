<?php

namespace App\System\Imports;

use App\Domain\Requests\Rules\EmployeeRequestRules;
use App\Domain\Models\Company;
use App\Domain\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeeImport implements ToModel, WithHeadingRow, WithValidation
{
    use EmployeeRequestRules;

    private const REQUIRED_KEYS = [
        'company',
        'hr_id',
        'status',
        'name',
        'email',
        'paypal',
        'address',
        'birthday',
        'city',
        'state',
        'zip',
        'phone_1',
        'phone_2',
        'race',
    ];

    public function model(array $row)
    {
        $company = Company::where('name', $row['company'])->first();

        return new Employee([
            'company_id' => $company['id'],
            'hr_id' => auth()->user()->getAuthIdentifier(),
            'status' => $row['status'],
            'name' => $row['name'],
            'email' => $row['email'],
            'address' => $row['address'],
            'birthday' => $row['birthday'],
            'city' => $row['city'],
            'state' => $row['state'],
            'zip' => $row['zip'],
            'phone_1' => $row['phone_1'],
            'phone_2' => $row['phone_2'],
            'race' => $row['race'],
            //'paypal' => $row['paypal'],
        ]);
    }

    public function rules(): array
    {
        return $this->importRules();
        /*return array_map(function ($rule){
            return 'required|'.$rule;
        }, $this->importRules());*/

    }
}
