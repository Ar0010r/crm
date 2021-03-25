<?php

namespace App\Http\Requests\User;

use App\Http\Requests\OwnerAllowedRequest;

class UserShowRequest extends OwnerAllowedRequest
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

        return auth()->user()->tokenCan(Permission::USER_SHOW) || $updatedId === $authUserId;
    }*/

    protected function entityOwnerId(): int
    {
        return $this->requestId;
    }
}
