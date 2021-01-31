<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\HrAllowedRequest;
use App\Http\Requests\OnlyAdminAllowedRequest;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeIndexRequest extends OnlyAdminAllowedRequest
{

}
