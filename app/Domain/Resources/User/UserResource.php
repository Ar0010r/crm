<?php

namespace App\Domain\Resources\User;

use App\Source\Resources\ModelResource;

class UserResource extends ModelResource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'login'=> $this->login,
            'avatar'=> $this->avatar,
            'role'=> $this->role,
            'companies'=> $this->companies,
            'created_at'=> $this->created_at->format('Y-m-d'),
        ];
    }
}
