<?php

namespace App\Http\Requests\Company;

use App\Rules\User\UserIdBelongsToPersonnel;
use Illuminate\Validation\Rule;

class CompanyUpdateRequest extends CompanyOwnerAllowedRequest
{
   /* public function authorize()
    {
        return auth()->user()->tokenCan(Permission::COMPANY_UPDATE);
    }*/

    public function rules()
    {
        $updatedId = $this->route()->parameter('company');

        return [
            'name' => Rule::unique('companies')->ignore($updatedId),
            'domain' => Rule::unique('companies')->ignore($updatedId),
            'email' => Rule::unique('companies')->ignore($updatedId),
            'personnel_id' => ['exists:users,id',  new UserIdBelongsToPersonnel()],
        ];
    }
}
