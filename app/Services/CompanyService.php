<?php


namespace App\Services;

use App\Models\User;

class CompanyService
{
    public function getUserCompanyIds(User $user= null)
    {
        $user = $user ?? auth()->user();
        $companies = $user->companies()->get()->toArray();

        return array_map(function ($company){
            return $company['id'];
        }, $companies);
    }

}