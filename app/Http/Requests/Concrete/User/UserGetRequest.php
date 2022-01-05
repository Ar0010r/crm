<?php

namespace App\Http\Requests\Concrete\User;

use App\Http\Requests\AbstractGetRequest;
use App\Http\Requests\Rules\UserRequestRules;

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
