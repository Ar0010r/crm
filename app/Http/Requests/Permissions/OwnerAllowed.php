<?php


namespace App\Http\Requests\Permissions;


use App\Shared\Value\Role;

trait OwnerAllowed
{
    public function authorize()
    {
        if (!static::ENTITY) {
            throw new \Exception('please specify entity in ENTITY const');
        }
        $this->requestId = $this->route()->parameter(static::ENTITY)->id;
        $authUserId = auth()->user()->getAuthIdentifier();

        return $this->resourceOwnerId() === $authUserId;
    }
}
