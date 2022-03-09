<?php

namespace App\Domain\Requests\Rules;

use App\Domain\Models\Company;
use App\Domain\Enums\Race;
use App\Domain\Enums\Status;


trait EmployeeRequestRules
{
    protected $states = [
        'AL', 'AK', 'AS', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC', 'FM', 'FL', 'GA', 'GU', 'HI','ID', 'IL', 'IN',
        'IA', 'KS', 'KY', 'LA', 'ME', 'MH', 'MD', 'MA', 'MI', 'MN', 'MS', 'MO', 'MT', 'NE', 'NV', 'NH', 'NJ', 'NM',
        'NY', 'NC', 'ND', 'MP', 'OH', 'OK', 'OR', 'PW', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VI',
        'VA', 'WA', 'WV', 'WI', 'WY', 'AE', 'AA', 'AP'
    ];

    public function baseRules(): array
    {
        return [
            'company_id' => ['nullable', 'exists:companies,id'],
            'hr_id' => ['nullable', 'exists:users,id'],
            'name' => ['nullable', 'regex:/^[a-zA-Z ]+$/'],
            'avatar' => ['nullable', 'string'],
            'email' => ['nullable','email'], //'unique:employees,paypal'
            'paypal' => ['nullable','email'], //  'unique:employees,email'
            //'email' => 'nullable|email|unique:employees|unique:employees,paypal',
            //'paypal' => 'nullable|email|unique:employees|unique:employees,email',
            'address' => ['nullable', 'string'],
            //'address' => 'nullable|string|unique:employees',
            'city' => ['nullable', 'string'],
            'state' => ['nullable', 'string', 'in:' . implode(',', $this->states)],
            'zip' => ['nullable', 'regex:/^\d{5}(-\d{4})?$/'],
            'phone_1' => ['nullable', 'regex:/^\d{3}-\d{3}-\d{4}$/'], //'unique:employees,phone_2'
            'phone_2' => ['nullable', 'regex:/^\d{3}-\d{3}-\d{4}$/'], //'unique:employees,phone_1'
            'birthday' => ['nullable', 'date'],
            'contacted' => ['nullable', 'date'],
            'race' => ['nullable', 'string', 'in:' . implode(',', Race::RACES)],
            'status' => ['nullable', 'string', 'in:' . implode(',', Status::STATUSES)],
        ];
    }

    public function importRules()
    {
        return [
            '*.city' => 'required|string',
            '*.birthday' => 'required|date',
            '*.name' => 'required|regex:/^[a-zA-Z ]+$/',
            '*.zip' => 'required|regex:/^\d{5}(-\d{4})?$/',
            '*.address' => 'required|string|unique:employees',
            '*.state' => 'required|string|in:' . implode(',', $this->states),
            '*.phone_1' => 'required|regex:/^\d{3}-\d{3}-\d{4}$/',
            '*.phone_2' => 'nullable|regex:/^\d{3}-\d{3}-\d{4}$/',
            '*.email' => 'required|email|unique:employees|unique:employees,paypal',
            '*.race' => 'required|string|in:' . implode(',', Race::RACES),
            '*.status' => 'required|string|in:' . implode(',', Status::STATUSES),
            '*.company' => 'required|string|in:' . implode(',', Company::all()->pluck('name')->toArray()),

            //'*.paypal' => 'nullable|email|unique:employees|unique:employees,email',
        ];
    }
}
