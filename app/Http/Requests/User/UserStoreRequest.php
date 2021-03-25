<?php

namespace App\Http\Requests\User;

use App\Http\Requests\OnlyAdminAllowedRequest;
use App\Shared\Value\Role;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role === Role::ADMIN || auth()->user()->role === Role::TOP_HR;
    }

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
            'role' => 'required|in:' . Role::ADMIN . ',' . Role::HR . ',' . Role::PERSONNEL. ','.Role::TOP_HR
        ];
    }
}
