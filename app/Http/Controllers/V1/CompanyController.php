<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concrete\Company\CompanyStoreRequest;
use App\Http\Requests\Concrete\Company\CompanyUpdateRequest;
use App\Http\Resources\Base\ListResource;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\Contracts\ResourceServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    private ResourceServiceInterface $service;

    public function __construct(ResourceServiceInterface $service) {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->get()->items();
        return new ListResource($data);
    }

    public function store(CompanyStoreRequest $r)
    {
        $company = $this->service->make($r);
        $this->service->store($company);

        return new CompanyResource($company);
    }

    public function show(Company $company)
    {
        $company = $this->service->show($company);

        return new CompanyResource($company);
    }

    public function update(CompanyUpdateRequest $r, Company $company)
    {
       $company = $this->service->make($r, $company);
       $this->service->update($company);

        return new CompanyResource($company);
    }

    public function destroy(Company $company)
    {
        try {
            $this->service->destroy($company);
            return new CompanyResource($company);
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
