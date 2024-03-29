<?php

namespace App\Domain\Rules\User;

use App\Domain\Models\User;
use App\Domain\Enums\Role;
use Illuminate\Contracts\Validation\Rule;

class UserIdBelongsToPersonnel implements Rule
{
    private $userId;


    public function passes($attribute, $value)
    {
        $this->userId = $value;
        return User::find($this->userId)->role === Role::PERSONNEL;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'User with id ' . $this->userId . ' is not a Personnel manager';
    }
}
