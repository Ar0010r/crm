<?php

namespace App\Http\Requests\User;

use App\Http\Requests\OnlyAdminAllowedRequest;
use App\Properties\Permission;
use App\Properties\Role;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends OnlyAdminAllowedRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return auth()->user()->tokenCan(Permission::USER_CREATE);
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'login' => 'required|string|max:100|unique:users',
            'password' => 'required|string|max:12',
            'role' => 'required|in:' . Role::ADMIN . ',' . Role::HR . ',' . Role::PERSONNEL
        ];
    }
}
