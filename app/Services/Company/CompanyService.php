<?php


namespace App\Services\Company;

use App\Models\Company;
use App\Models\User;

class CompanyService
{
    private UserCompanyService $userCompanyService;

    public function __construct(UserCompanyService $userCompanyService)
    {
        $this->userCompanyService = $userCompanyService;
    }

    public function get()
    {
        return $this->userCompanyService->getUserCompanies();
    }

    public function store(Company $company)
    {
        $company->save();
        $company->personnel;
        $company->employees_count = 0;
        $company->exported_employees_count = 0;
        $company->good_employees_count = 0;

        return $company;
    }

    public function getUserCompanyIds(User $user = null)
    {
        $user = $user ?? auth()->user();
        $companies = $user->companies()->get()->toArray();

        return array_map(function ($company) {
            return $company['id'];
        }, $companies);
    }

}