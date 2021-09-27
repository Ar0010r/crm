<?php

namespace App\Http\Requests\Concrete\User;

use App\Http\Requests\AbstractStoreRequest;
use App\Http\Requests\Permissions\TopHrAllowed;
use App\Http\Requests\Rules\UserRequestRules;

class UserStoreRequest extends AbstractStoreRequest
{
    use TopHrAllowed;
    use UserRequestRules;

    public function required(): array
    {
        return ['login', 'password', 'role'];
    }

    public function unique(): array
    {
        return ['login' => 'users'];
    }
}
