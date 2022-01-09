<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concrete\Test\TestGetRequest;
use App\Http\Requests\Concrete\Test\TestStoreRequest;
use App\Http\Requests\Concrete\Test\TestUpdateRequest;
use App\Http\Resources\Base\ListResource;
use App\Http\Resources\Base\ModelResource;
use App\Http\Resources\TestResource;
use App\Models\Test;
use App\Services\Concrete\Test\GetTestService;
use App\Services\Concrete\Test\StoreTestService;
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

       /* $a = collect($data)->whereInstanceOf(Test::class)
            ->map(fn(Test $test) => $test->toArray())
            ->groupBy('company_id')
            ->map(function (Collection $record) {
                return [
                    'company' => $record[0]['company']['name'],
                    'results' => $record->take(5),
                ];
            });*/

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
