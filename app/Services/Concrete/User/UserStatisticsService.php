<?php

namespace App\Services\Concrete\User;

class UserStatisticsService
{
    protected ScopeUserService $scopeService;

    public function __construct(ScopeUserService $scopeService)
    {
        $this->scopeService = $scopeService;
    }

    public function calculate()
    {

    }

}
