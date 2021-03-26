<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CompanyDeleteRequest;
use App\Http\Requests\Company\CompanyIndexRequest;
use App\Http\Requests\Company\CompanyShowRequest;
use App\Http\Requests\Company\CompanyStoreRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Company;
use App\Shared\Value\Role;
use Illuminate\Http\JsonResponse;

class CompaniesController extends Controller
{
    public function index()
    {
        switch (auth()->user()->role) {
            case Role::PERSONNEL:
                $data = auth()->user()->companies()->with('personnel')->get();
                break;
            case Role::TOP_HR || Role::HR || Role::ADMIN:
                $data = Company::with('personnel')->get();
                break;
            default:
                $data = [];
        }

        return response($data, JsonResponse::HTTP_OK);
    }

    public function store(CompanyStoreRequest $r)
    {
        $company = Company::create($r->all());

        return response(['company' => $company], JsonResponse::HTTP_OK);
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
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }
}
