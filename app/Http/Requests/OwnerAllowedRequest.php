<?php

namespace App\Http\Requests;

use App\Shared\Value\Role;
use Illuminate\Foundation\Http\FormRequest;

abstract class OwnerAllowedRequest extends FormRequest
{
    protected $requestId;
    public function authorize()
    {
        if (!static::ENTITY) {
            throw new \Exception('please specify entity in ENTITY const');
        }
        $this->requestId = $this->route()->parameter(static::ENTITY)->id;
        $authUserId = auth()->user()->getAuthIdentifier();

        return auth()->user()->role === Role::ADMIN || $this->entityOwnerId() === $authUserId;
    }

    public function rules()
    {
        return [];
    }

    abstract protected function entityOwnerId(): int;
}
