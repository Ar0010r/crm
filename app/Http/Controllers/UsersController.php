<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\User\UserService;
use App\Services\User\UserSubordinateService;
use App\Shared\Value\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    private UserSubordinateService $userSubordinateService;
    private UserService $userService;

    public function __construct(
        UserService $userService,
        UserSubordinateService $userSubordinateService
    ) {
        $this->userSubordinateService = $userSubordinateService;
        $this->userService = $userService;
    }

    public function index()
    {
        $data = $this
            ->userSubordinateService
            ->getUserSubordinates(auth()->user());

        return response($data, JsonResponse::HTTP_OK);
    }

    public function store(UserStoreRequest $r)
    {
        $r->merge(["password" => bcrypt($r->password)]);
        $user = User::make($r->all());

        $user = $this->userService->store($user);

        return response(['user' => $user], JsonResponse::HTTP_OK);
    }

    public function show(User $user)
    {
        return response(['user' => $user], JsonResponse::HTTP_OK);
    }

    public function update(UserUpdateRequest $r, User $user)
    {
        $avatar = $r->file('file');

        if ($avatar) {
            $newName = $this->userService->saveAvatar($avatar);
            $r->merge(["avatar" => $newName]);
        }
        if ($r->password) {
            $r->merge(["password" => bcrypt($r->password)]);
        }

        $user->update($r->all());

        return response($user, JsonResponse::HTTP_OK);
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response("deleted", JsonResponse::HTTP_NO_CONTENT);
        } catch (QueryException $e) {
            return response([
                'message' => 'can`t delete manager ' . $user->login,
                'errors' => [['he might control some companies']]
            ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAvailableRoles()
    {
        switch (auth()->user()->role) {
            case Role::TOP_HR:
                $data = Role::TOP_HR__AVAILABLE_ROLES;
                break;
            case Role::ADMIN:
                $data = Role::ADMIN_AVAILABLE_ROLES;
                break;
            default:
                $data = [];
        }
        return response($data, JsonResponse::HTTP_OK);
    }
}
