<?php

namespace App\Domain\Requests\Concrete\User;

use App\Source\Requests\AbstractGetRequest;
use App\Domain\Requests\Rules\UserRequestRules;

class UserGetRequest extends AbstractGetRequest
{
    use UserRequestRules;

    public function orderByFields(): array
    {
        return [
            'login'
        ];
    }

}
