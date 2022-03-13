<?php

namespace App\Domain\Controllers\V1;

use App\Domain\Resources\Test\TestCollection;
use App\Domain\Resources\Test\TestResource;
use App\Source\Control\Controller;
use App\Domain\Requests\Concrete\Test\TestGetRequest;
use App\Domain\Requests\Concrete\Test\TestStoreRequest;
use App\Domain\Requests\Concrete\Test\TestUpdateRequest;
use App\Domain\Models\Test;
use App\Domain\Services\Test\GetTestService;
use App\Domain\Services\Test\StoreTestService;

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

        return new TestCollection($data);
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
        $this->storeService->destroy($test);
        return new TestResource($test);
    }
}
