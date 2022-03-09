<?php

namespace App\Domain\Controllers\V1;

use App\Source\Control\Controller;
use App\Domain\Requests\Concrete\Test\TestGetRequest;
use App\Domain\Requests\Concrete\Test\TestStoreRequest;
use App\Domain\Requests\Concrete\Test\TestUpdateRequest;
use App\Source\Resources\ListResource;
use App\Source\Resources\ModelResource;
use App\Domain\Resources\TestResource;
use App\Domain\Models\Test;
use App\Domain\Services\Test\GetTestService;
use App\Domain\Services\Test\StoreTestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    private StoreTestService $storeService;
    private GetTestService $getService;

    public function __construct(
        StoreTestService $storeService,
        GetTestService $getService
    ) {
        $this->storeService = $storeService;
        $this->getService = $getService;
    }

    public function index(TestGetRequest $request)
    {
        $data = $this->getService->get($request);

        return new ListResource($data);
    }

    public function store(TestStoreRequest $request)
    {
        $test = $this->storeService->make($request);
        $this->storeService->store($test);

        return new TestResource($test);
    }


    public function show(Test $test)
    {
        $test = $this->getService->show($test);

        return new TestResource($test);
    }

    public function update(TestUpdateRequest $request, Test $test)
    {
        $test = $this->storeService->make($request, $test);
        $this->storeService->update($test);

        return new TestResource($test);
    }

    public function destroy(Test $test)
    {
        try {
            $this->storeService->destroy($test);
            return new TestResource($test);
        } catch (\Exception $e) {
            return response($e->getMessage(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function total()
    {
        $q = DB::table('tests');
        foreach (['google', 'yahoo', 'outlook', 'other'] as $client) {
            $q->selectRaw("SUM($client) as {$client}_total");
        }

        return new ModelResource($q->get());
    }
}
