<?php

namespace App\Http\Requests\User;

use App\Http\Requests\OnlyAdminAllowedRequest;

class UserDeleteRequest extends OnlyAdminAllowedRequest
{

}
