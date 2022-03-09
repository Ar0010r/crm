<?php

namespace App\Domain\Requests\Concrete\User;

use App\Source\Requests\AbstractStoreRequest;
use App\Domain\Requests\Permissions\TopHrAllowed;
use App\Domain\Requests\Rules\UserRequestRules;

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
