<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\OnlyAdminAllowedRequest;
use App\Rules\User\UserIdBelongsToPersonnel;
use App\Shared\Value\Role;

class CompanyStoreRequest extends OnlyAdminAllowedRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return parent::authorize() || auth()->user()->role === Role::PERSONNEL;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100|unique:companies',
            'domain' => 'required|string|max:100|unique:companies',
            'email' => 'required|string|max:100|unique:companies',
            'personnel_id' => ['exists:users,id',  new UserIdBelongsToPersonnel()],
        ];
    }
}
