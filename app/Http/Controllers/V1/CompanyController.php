<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concrete\Company\CompanyGetRequest;
use App\Http\Requests\Concrete\Company\CompanyStoreRequest;
use App\Http\Requests\Concrete\Company\CompanyUpdateRequest;
use App\Http\Resources\Base\ListResource;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\Employee;
use App\Services\Concrete\Company\CompanyStatisticService;
use App\Services\Concrete\Company\GetCompanyService;
use App\Services\Concrete\Company\StoreCompanyService;
use App\Shared\Value\CompanyType;
use App\Shared\Value\Status;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    private StoreCompanyService $storeService;
    private GetCompanyService $getService;
    private CompanyStatisticService $statisticService;

    public function __construct(
        StoreCompanyService $storeService,
        GetCompanyService $getService,
        CompanyStatisticService $statisticService
    ) {
        $this->storeService = $storeService;
        $this->getService = $getService;
        $this->statisticService = $statisticService;
    }

    public function index(CompanyGetRequest $request)
    {
        $data = $this->getService->get($request)->items();
        return new ListResource($data);
    }

    public function store(CompanyStoreRequest $r)
    {
        $company = $this->storeService->make($r);
        $this->storeService->store($company);

        return new CompanyResource($company);
    }

    public function show(Company $company)
    {
        $company = $this->getService->show($company);

        return new CompanyResource($company);
    }

    public function update(CompanyUpdateRequest $r, Company $company)
    {
        $company = $this->storeService->make($r, $company);
        $this->storeService->update($company);

        return new CompanyResource($company);
    }

    public function statistics()
    {
        $data = $this->statisticService->get();

        return new ListResource($data);
    }

    public function destroy(Company $company)
    {
        try {
            $this->storeService->destroy($company);
            return new CompanyResource($company);
        } catch (QueryException $e) {
            return response([
                'message' => 'can`t delete company ' . $company->name,
                'errors' => [['there are might be applicants in it']]
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
