<?php

namespace App\Http\Requests\Concrete\Company;

use App\Http\Requests\AbstractUpdateRequest;
use App\Http\Requests\Permissions\PersonnelAllowed;
use App\Http\Requests\Rules\CompanyRequestRules;

class CompanyUpdateRequest extends AbstractUpdateRequest
{
    use CompanyRequestRules;
    use PersonnelAllowed;

    public const ENTITY = 'company';

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
        $updatedId = $this->route()->parameter('company');

        return [
            'name' => Rule::unique('companies')->ignore($updatedId),
            'domain' => Rule::unique('companies')->ignore($updatedId),
            'email' => Rule::unique('companies')->ignore($updatedId),
            'personnel_id' => ['exists:users,id',  new UserIdBelongsToPersonnel()],
        ];
    }*/
}
