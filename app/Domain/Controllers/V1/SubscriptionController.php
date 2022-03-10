<?php

namespace App\Domain\Controllers\V1;

use App\Source\Control\Controller;
use App\Domain\Requests\Concrete\Subscription\SubscriptionGetRequest;
use App\Domain\Requests\Concrete\Subscription\SubscriptionStoreRequest;
use App\Domain\Requests\Concrete\Subscription\SubscriptionUpdateRequest;
use App\Source\Resources\ListResource;
use App\Domain\Resources\SubscriptionResource;
use App\Domain\Models\Subscription;
use App\Domain\Services\Subscription\GetSubscriptionService;
use App\Domain\Services\Subscription\StoreSubscriptionService;

class SubscriptionController extends Controller
{
    private StoreSubscriptionService $storeService;
    private GetSubscriptionService $getService;

    public function __construct(
        StoreSubscriptionService $storeService,
        GetSubscriptionService $getService
    ) {
        $this->storeService = $storeService;
        $this->getService = $getService;
    }

    public function index(SubscriptionGetRequest $request)
    {
        $data = $this->getService->get($request);

        return new ListResource($data);
    }

    public function store(SubscriptionStoreRequest $request)
    {
        $subscription = $this->storeService->make($request);
        $this->storeService->store($subscription);

        return new SubscriptionResource($subscription);
    }

    public function show(Subscription $subscription)
    {
        $subscription = $this->getService->show($subscription);

        return new SubscriptionResource($subscription);
    }

    public function update(SubscriptionUpdateRequest $request, Subscription $subscription)
    {
        $subscription = $this->storeService->make($request, $subscription);
        $this->storeService->update($subscription);

        return new SubscriptionResource($subscription);
    }

    public function destroy(Subscription $subscription)
    {
        $this->storeService->destroy($subscription);

        return new SubscriptionResource($subscription);
    }
}
