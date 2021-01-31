<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\OnlyAdminAllowedRequest;
use App\Http\Requests\OwnerAllowedRequest;
use App\Models\Company;
use App\Rules\User\UserIdBelongsToPersonnel;

class CompanyShowRequest extends CompanyOwnerAllowedRequest
{

}
