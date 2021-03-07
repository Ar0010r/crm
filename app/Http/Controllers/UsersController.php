<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserIndexRequest;
use App\Http\Requests\User\UserShowRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Shared\Value\Role;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function index(UserIndexRequest $r)
    {
        return response(User::all(), JsonResponse::HTTP_OK);
    }

    public function store(UserStoreRequest $r)
    {
        $r->merge(["password" => bcrypt($r->password)]);
        $user = User::create($r->all());

        return response(['user' => $user], JsonResponse::HTTP_OK);
    }

    public function show(UserShowRequest $r, User $user)
    {
        return response(['user' => $user], JsonResponse::HTTP_OK);
    }

    public function update(UserUpdateRequest $r, User $user)
    {
        if ($r->password) {
            $r->merge(["password" => bcrypt($r->password)]);
        }
        $user->update($r->all());

        return response("updated", JsonResponse::HTTP_NO_CONTENT);
    }

    public function destroy(UserDeleteRequest $r, User $user)
    {
        try {
            $user->delete();
            return response("deleted", JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function getAvailableRoles()
    {
        return response(Role::AVAILABLE_ROLES, JsonResponse::HTTP_OK);
    }
}
