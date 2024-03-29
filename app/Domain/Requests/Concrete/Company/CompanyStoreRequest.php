<?php

namespace App\Domain\Requests\Concrete\Company;

use App\Source\Requests\AbstractStoreRequest;
use App\Domain\Requests\Permissions\AnyManagerAllowed;
use App\Domain\Requests\Rules\CompanyRequestRules;

class CompanyStoreRequest extends AbstractStoreRequest
{
    use AnyManagerAllowed;
    use CompanyRequestRules;

    public function required(): array
    {
        return ['name', 'domain', 'email', 'manager_id', 'type'];
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
            'manager_id' => ['exists:users,id', new UserIdBelongsToPersonnel()],
        ];
    }*/
}
