<?php

namespace App\Domain\Requests\Concrete\Company;

use App\Domain\Requests\Permissions\AnyManagerAllowed;
use App\Source\Requests\AbstractUpdateRequest;
use App\Domain\Requests\Permissions\PersonnelAllowed;
use App\Domain\Requests\Rules\CompanyRequestRules;

class CompanyUpdateRequest extends AbstractUpdateRequest
{
    use CompanyRequestRules;
    use AnyManagerAllowed;

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
            'manager_id' => ['exists:users,id',  new UserIdBelongsToPersonnel()],
        ];
    }*/
}
