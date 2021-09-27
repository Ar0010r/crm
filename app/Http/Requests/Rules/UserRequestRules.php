<?php


namespace App\Http\Requests\Rules;

use App\Shared\Value\Role;

trait UserRequestRules
{
    public function baseRules(): array
    {
        return [
            'login' => ['string'],
            'password' => ['string'],
            'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            'file' => ['image', 'mimes:jpeg,png,jpg'],
            'role' => ['string', 'in:' . Role::ADMIN . ',' . implode(',', Role::ADMIN_AVAILABLE_ROLES)]
        ];
    }
}
