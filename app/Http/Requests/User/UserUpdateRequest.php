<?php

namespace App\Http\Requests\User;

use App\Http\Requests\OwnerAllowedRequest;
use App\Properties\Role;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends OwnerAllowedRequest
{
    public const ENTITY = 'user';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        $updatedId = $this->route()->parameter('user')->id;
        $authUserId = auth()->user()->getAuthIdentifier();

        return auth()->user()->tokenCan(Permission::USER_UPDATE) || $updatedId === $authUserId;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $updatedId = $this->route()->parameter('user');

        return [
            'login' => Rule::unique('users')->ignore($updatedId),
            'password' => 'string|max:12',
            'avatar' => 'image|mimes:jpeg,png,jpg',
            'file' => 'image|mimes:jpeg,png,jpg',
            'role' => 'in:' . Role::ADMIN . ',' . Role::HR . ',' . Role::PERSONNEL
        ];
    }

    protected function entityOwnerId(): int
    {
        return $this->requestId;
    }
}
