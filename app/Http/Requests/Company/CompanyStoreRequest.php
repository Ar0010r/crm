<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\OnlyAdminAllowedRequest;
use App\Rules\User\UserIdBelongsToPersonnel;

class CompanyStoreRequest extends OnlyAdminAllowedRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
   /* public function authorize()
    {
        return auth()->user()->tokenCan(Permission::COMPANY_CREATE);
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100|unique:companies',
            'user_id' => ['exists:users,id',  new UserIdBelongsToPersonnel()],
        ];
    }
}
