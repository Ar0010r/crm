<?php

namespace App\Domain\Controllers\V1;

use App\Domain\Resources\Company\CompanyCollection;
use App\Domain\Resources\Company\CompanyResource;
use App\Source\Control\Controller;
use App\Domain\Requests\Concrete\Company\CompanyGetRequest;
use App\Domain\Requests\Concrete\Company\CompanyStoreRequest;
use App\Domain\Requests\Concrete\Company\CompanyUpdateRequest;
use App\Source\Resources\ListResource;
use App\Domain\Models\Company;
use App\Domain\Services\Company\CompanyStatisticService;
use App\Domain\Services\Company\GetCompanyService;
use App\Domain\Services\Company\StoreCompanyService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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

        $data = $this->getService->get($request);


        return new CompanyCollection($data);
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
