<?php

namespace App\Domain\Controllers\V1;

use App\Domain\Resources\Letter\LetterCollection;
use App\Domain\Resources\Letter\LetterResource;
use App\Source\Control\Controller;
use App\Domain\Requests\Concrete\Letter\LetterGetRequest;
use App\Domain\Requests\Concrete\Letter\LetterStoreRequest;
use App\Domain\Requests\Concrete\Letter\LetterUpdateRequest;
use App\Source\Resources\ListResource;
use App\Source\Resources\ModelResource;
use App\Domain\Models\Letter;
use App\Domain\Services\Letter\GetLetterService;
use App\Domain\Services\Letter\LetterStatisticsService;
use App\Domain\Services\Letter\StoreLetterService;

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

        return new LetterCollection($data);
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
        $this->storeService->destroy($letter);
        return new LetterResource($letter);
    }

    public function total()
    {
        $total = $this->statisticsService->getTotal();

        return new ModelResource($total);
    }

    public function statistics()
    {
        $data = $this->statisticsService->calculate(auth()->user());

        return new ListResource(['list' => $data]);
    }
}
