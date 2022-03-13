<?php

namespace App\Domain\Controllers\V1;

use App\Domain\Resources\User\UserCollection;
use App\Domain\Resources\User\UserResource;
use App\Source\Control\Controller;
use App\Domain\Requests\Concrete\User\UserGetRequest;
use App\Domain\Requests\Concrete\User\UserStoreRequest;
use App\Domain\Requests\Concrete\User\UserUpdateRequest;
use App\Source\Resources\ListResource;
use App\Domain\Models\User;
use App\Domain\Services\User\GetUserService;
use App\Domain\Services\User\StoreUserService;

class UserController extends Controller
{
    private StoreUserService $storeService;
    private GetUserService $getService;

    public function __construct(StoreUserService $storeService, GetUserService $getService) {
        $this->storeService = $storeService;
        $this->getService = $getService;
    }

    public function index(UserGetRequest $request)
    {
        $data = $this->getService->get($request);

        return new UserCollection($data);
    }

    public function store(UserStoreRequest $request)
    {
        $user = $this->storeService->make($request);
        $this->storeService->store($user);

        return new UserResource($user);
    }

    public function show(User $user)
    {
        $user = $this->getService->show($user);

        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user = $this->storeService->make($request, $user);
        $this->storeService->update($user);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $this->storeService->destroy($user);
        return new UserResource($user);
    }

    public function getAvailableRoles()
    {
        $data = $this->getService->getRoles(auth()->user());
        return new ListResource($data);
    }
}
