<?php

namespace App\Http\Requests\User;

use App\Http\Requests\OnlyAdminAllowedRequest;

class UserIndexRequest extends OnlyAdminAllowedRequest
{

}
