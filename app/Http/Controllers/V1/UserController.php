<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concrete\User\UserStoreRequest;
use App\Http\Requests\Concrete\User\UserUpdateRequest;
use App\Http\Resources\Base\ListResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Contracts\ResourceServiceInterface;
use App\Shared\Value\Role;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private ResourceServiceInterface $service;

    public function __construct(ResourceServiceInterface $service) {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->get()->items();

        return new ListResource($data);
    }

    public function store(UserStoreRequest $r)
    {
        $user = $this->service->make($r);
        $this->service->store($user);

        return new UserResource($user);
    }

    public function show(User $user)
    {
        $user = $this->service->show($user);

        return new UserResource($user);
    }

    public function update(UserUpdateRequest $r, User $user)
    {
        $user = $this->service->make($r, $user);

        $this->service->update($user);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        try {
            $this->service->destroy($user);
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
