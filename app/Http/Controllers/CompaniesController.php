<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CompanyDeleteRequest;
use App\Http\Requests\Company\CompanyIndexRequest;
use App\Http\Requests\Company\CompanyShowRequest;
use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompaniesController extends Controller
{
    public function index(CompanyIndexRequest $r)
    {
        return response(Company::all(), JsonResponse::HTTP_OK);
    }

    public function store(CompanyStoreRequest $r)
    {
        $company = Company::create($r->all());

        return response(['company' => $company], JsonResponse::HTTP_OK);
    }

    public function show(Company $company, CompanyShowRequest $r)
    {
        return response(['company' => $company], JsonResponse::HTTP_OK);
    }

    public function update(CompanyUpdateRequest $r, Company $company)
    {
        $company->update($r->all());

        return response("updated", JsonResponse::HTTP_NO_CONTENT);
    }

    public function destroy(Company $company, CompanyDeleteRequest $r)
    {
        try {
            $company->delete();
            return response("deleted", JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }
}
