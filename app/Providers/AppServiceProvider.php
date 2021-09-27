<?php

namespace App\Providers;

use App\Http\Controllers\V1\CompanyController;
use App\Http\Controllers\V1\EmployeeController;
use App\Http\Controllers\V1\LetterController;
use App\Http\Controllers\V1\UserController;
use App\Services\Concrete\Company\CompanyService;
use App\Services\Concrete\Company\UserCompanyService;
use App\Services\Concrete\Employee\EmployeeSearchService;
use App\Services\Concrete\Employee\EmployeeService;
use App\Services\Concrete\Employee\UserEmployeeService;
use App\Services\Concrete\Letter\LetterService;
use App\Services\Concrete\Letter\UserLetterService;
use App\Services\Concrete\User\UserService;
use App\Services\Concrete\User\UserSubordinateService;
use App\Services\Contracts\ResourceSearchServiceInterface;
use App\Services\Contracts\ResourceServiceInterface;
use App\Services\Contracts\UserResourceServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->when(CompanyService::class)
            ->needs(UserResourceServiceInterface::class)
            ->give(UserCompanyService::class);

        $this->app->when(CompanyController::class)
            ->needs(ResourceServiceInterface::class)
            ->give(CompanyService::class);


        $this->app->when(EmployeeService::class)
            ->needs(UserResourceServiceInterface::class)
            ->give(UserEmployeeService::class);

        $this->app->when(EmployeeService::class)
            ->needs(ResourceSearchServiceInterface::class)
            ->give(EmployeeSearchService::class);

        $this->app->when(EmployeeController::class)
            ->needs(ResourceSearchServiceInterface::class)
            ->give(EmployeeService::class);


        $this->app->when(LetterService::class)
            ->needs(UserResourceServiceInterface::class)
            ->give(UserLetterService::class);
        $this->app->when(LetterController::class)
            ->needs(ResourceServiceInterface::class)
            ->give(LetterService::class);


        $this->app->when(UserService::class)
            ->needs(UserResourceServiceInterface::class)
            ->give(UserSubordinateService::class);
        $this->app->when(UserController::class)
            ->needs(ResourceServiceInterface::class)
            ->give(UserService::class);
    }

    public function boot()
    {
        //
    }
}
