<?php

namespace App\Http\Requests\Concrete\User;

use App\Http\Requests\AbstractUpdateRequest;
use App\Http\Requests\Rules\UserRequestRules;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends AbstractUpdateRequest
{
    use UserRequestRules;

    public const ENTITY = 'user';

    public function unique(): array
    {
        return ['login' => 'users'];
    }
}

/* public function rules()
    {
        $updatedId = $this->route()->parameter('user');

        return [
            'login' => Rule::unique('users')->ignore($updatedId),
            'password' => 'string|max:12',
            'avatar' => 'image|mimes:jpeg,png,jpg',
            'file' => 'image|mimes:jpeg,png,jpg',
            'role' => 'in:' . Role::ADMIN . ',' . Role::HR . ',' . Role::PERSONNEL . ',' . Role::TOP_HR
        ];
    }*/
