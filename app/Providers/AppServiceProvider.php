<?php

namespace App\Providers;

use App\Services\Concrete\Company\GetCompanyService;
use App\Services\Concrete\Company\ScopeCompanyService;
use App\Services\Concrete\Employee\GetEmployeeService;
use App\Services\Concrete\Employee\ScopeEmployeeService;
use App\Services\Concrete\Letter\GetLetterService;
use App\Services\Concrete\Letter\ScopeLetterService;
use App\Services\Concrete\User\GetUserService;
use App\Services\Concrete\User\ScopeUserService;
use App\Services\Contracts\ScopeResourceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->when(GetCompanyService::class)
            ->needs(ScopeResourceInterface::class)
            ->give(ScopeCompanyService::class);


        $this->app->when(GetEmployeeService::class)
            ->needs(ScopeResourceInterface::class)
            ->give(ScopeEmployeeService::class);


        $this->app->when(GetLetterService::class)
            ->needs(ScopeResourceInterface::class)
            ->give(ScopeLetterService::class);


        $this->app->when(GetUserService::class)
            ->needs(ScopeResourceInterface::class)
            ->give(ScopeUserService::class);
    }

    public function boot()
    {
        //
    }
}
