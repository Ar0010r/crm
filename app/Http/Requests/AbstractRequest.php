<?php

namespace App\Http\Requests;

use App\Http\Requests\Contracts\AuthorizeRequestInterface;
use App\Http\Requests\Contracts\RequestInterface;
use App\Shared\Value\Role;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest implements RequestInterface, AuthorizeRequestInterface
{
    public function authorize(): bool
    {
        return $this->hasPermission() || auth()->user()->role === Role::ADMIN;
    }

    public function rules(): array
    {
        return $this->baseRules();
    }

    public function required(): array
    {
        return [];
    }

    public function unique(): array
    {
        return [];
    }

    public function hasPermission(): bool
    {
        return true;
    }

    abstract public function baseRules(): array;
}
