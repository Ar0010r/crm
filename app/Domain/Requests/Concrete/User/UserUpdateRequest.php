<?php

namespace App\Domain\Requests\Concrete\User;

use App\Source\Requests\AbstractUpdateRequest;
use App\Domain\Requests\Rules\UserRequestRules;
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
