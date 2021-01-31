<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EmployeeIndexRequest;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Properties\Race;
use App\Properties\Status;
use Illuminate\Http\JsonResponse;

class EmployeePropertiesController extends Controller
{
    public function statuses()
    {
        return Status::STATUSES_CSS_CLASSES;

        /*return [
            'statuses' => Status::STATUSES,
            'status_css_classes' => Status::STATUSES_CSS_CLASSES
        ];*/
    }

    public function races()
    {
        return Race::RACES;
    }
}
