<?php

namespace App\Http\Requests\Concrete\Company;

use App\Http\Requests\AbstractStoreRequest;
use App\Http\Requests\Permissions\PersonnelAllowed;
use App\Http\Requests\Rules\CompanyRequestRules;


class CompanyStoreRequest extends AbstractStoreRequest
{
    use PersonnelAllowed;
    use CompanyRequestRules;

    public function required(): array
    {
        return ['name', 'domain', 'email', 'personnel_id'];
    }

    public function unique(): array
    {
        return [
            'name' => 'companies',
            'domain' => 'companies',
            'email' => 'companies'
        ];
    }

    /*public function rules()
    {
        return [
            'name' => 'required|string|max:100|unique:companies',
            'domain' => 'required|string|max:100|unique:companies',
            'email' => 'required|string|max:100|unique:companies',
            'personnel_id' => ['exists:users,id', new UserIdBelongsToPersonnel()],
        ];
    }*/
}
