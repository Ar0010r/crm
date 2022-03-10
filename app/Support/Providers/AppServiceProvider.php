<?php

namespace App\Support\Providers;

use App\Domain\Services\Company\GetCompanyService;
use App\Domain\Services\Company\ScopeCompanyService;
use App\Domain\Services\Employee\GetEmployeeService;
use App\Domain\Services\Employee\ScopeEmployeeService;
use App\Domain\Services\Letter\GetLetterService;
use App\Domain\Services\Letter\ScopeLetterService;
use App\Domain\Services\Subscription\GetSubscriptionService;
use App\Domain\Services\Subscription\ScopeSubscriptionService;
use App\Domain\Services\Test\GetTestService;
use App\Domain\Services\Test\ScopeTestService;
use App\Domain\Services\User\GetUserService;
use App\Domain\Services\User\ScopeUserService;
use App\Source\Services\Contracts\ScopeResourceInterface;
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

        $this->app->when(GetTestService::class)
            ->needs(ScopeResourceInterface::class)
            ->give(ScopeTestService::class);

        $this->app->when(GetSubscriptionService::class)
            ->needs(ScopeResourceInterface::class)
            ->give(ScopeSubscriptionService::class);
    }

    public function boot()
    {
        //
    }
}
