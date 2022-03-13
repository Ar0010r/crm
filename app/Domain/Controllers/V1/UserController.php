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
use App\Domain\Enums\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
        try {
            $this->storeService->destroy($user);
            return new UserResource($user);
        } catch (\ErrorException $e) {
            return response([
                'message' => 'can`t delete manager ' . $user->login,
                'errors' => [[$e->getMessage()]]
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAvailableRoles()
    {
        switch (auth()->user()->role) {
            case Role::TOP_HR:
                $data = Role::TOP_HR_AVAILABLE_ROLES;
                break;
            case Role::ADMIN:
                $data = Role::ADMIN_AVAILABLE_ROLES;
                break;
            default:
                $data = [];
        }
        return new ListResource($data);
    }
}
