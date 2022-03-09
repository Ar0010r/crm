<?php

namespace App\Domain\Services\User;

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
