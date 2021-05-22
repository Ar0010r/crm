<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Company;
use App\Services\Company\CompanyService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class CompaniesController extends Controller
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        return response($this->companyService->get(), JsonResponse::HTTP_OK);
    }

    public function store(CompanyStoreRequest $r)
    {
        $company = Company::make($r->all());

        return response(['company' => $this->companyService->store($company)], JsonResponse::HTTP_OK);
    }

    public function show(Company $company)
    {
        return response(['company' => $company], JsonResponse::HTTP_OK);
    }

    public function update(CompanyUpdateRequest $r, Company $company)
    {
        $company->update($r->all());

        return response("updated", JsonResponse::HTTP_NO_CONTENT);
    }

    public function destroy(Company $company)
    {
        try {
            $company->delete();
            return response("deleted", JsonResponse::HTTP_NO_CONTENT);
        } catch (QueryException $e) {
            return response([
                'message' => 'can`t delete company ' . $company->name,
                'errors' => [['there are might be applicants in it']]
                ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        } catch (\Exception $e){
            return response(['message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
