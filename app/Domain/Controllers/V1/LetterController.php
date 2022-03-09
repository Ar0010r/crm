<?php

namespace App\Domain\Controllers\V1;

use App\Source\Control\Controller;
use App\Domain\Requests\Concrete\Letter\LetterGetRequest;
use App\Domain\Requests\Concrete\Letter\LetterStoreRequest;
use App\Domain\Requests\Concrete\Letter\LetterUpdateRequest;
use App\Source\Resources\ListResource;
use App\Source\Resources\ModelResource;
use App\Domain\Resources\LetterResource;
use App\Domain\Models\Letter;
use App\Domain\Services\Letter\GetLetterService;
use App\Domain\Services\Letter\LetterStatisticsService;
use App\Domain\Services\Letter\StoreLetterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LetterController extends Controller
{
    private LetterStatisticsService $statisticsService;
    private StoreLetterService $storeService;
    private GetLetterService $getService;

    public function __construct(
        StoreLetterService $storeService,
        GetLetterService $getService,
        LetterStatisticsService $statisticsService
    ) {
        $this->statisticsService = $statisticsService;
        $this->storeService = $storeService;
        $this->getService = $getService;
    }

    public function index(LetterGetRequest $request)
    {
        $data = $this->getService->get($request);

        return new ListResource($data);
    }

    public function store(LetterStoreRequest $request)
    {
        $letter = $this->storeService->make($request);
        $this->storeService->store($letter);

        return new LetterResource($letter);
    }


    public function show(Letter $letter)
    {
        $letter = $this->getService->show($letter);

        return new LetterResource($letter);
    }

    public function update(LetterUpdateRequest $request, Letter $letter)
    {
        $letter = $this->storeService->make($request, $letter);
        $this->storeService->update($letter);

        return new LetterResource($letter);
    }

    public function destroy(Letter $letter)
    {
        try {
            $this->storeService->destroy($letter);
            return new LetterResource($letter);
        } catch (\Exception $e) {
            return response($e->getMessage(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function total()
    {
        $q = DB::table('letters');
        foreach (['google', 'yahoo', 'outlook', 'other'] as $client) {
            $q->selectRaw("SUM($client) as {$client}_total");
        }

        return new ModelResource($q->get());
    }

    public function statistics()
    {
        $data = $this->statisticsService->calculate(auth()->user());

        return new ListResource(['list' => $data]);

    }
}