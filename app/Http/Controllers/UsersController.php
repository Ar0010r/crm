<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserShowRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Pivot\TopHrHr;
use App\Models\User;
use App\Shared\Value\Role;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    public function index()
    {
        switch (auth()->user()->role) {
            case Role::TOP_HR:
                $data = auth()->user()->topHrHrs()->get()->toArray();
                $data[] = auth()->user();
                break;
            case Role::ADMIN:
                $data = User::all();
                break;
            default:
                $data = [];
        }

        return response($data, JsonResponse::HTTP_OK);
    }

    public function store(UserStoreRequest $r)
    {
        $r->merge(["password" => bcrypt($r->password)]);
        $user = User::create($r->all());

        if(auth()->user()->role = Role::TOP_HR){
            TopHrHr::create(['top_hr_id' => auth()->user()->id, 'hr_id' => $user->id]);
        }

        return response(['user' => $user], JsonResponse::HTTP_OK);
    }

    public function show(UserShowRequest $r, User $user)
    {
        return response(['user' => $user], JsonResponse::HTTP_OK);
    }

    public function update(UserUpdateRequest $r, User $user)
    {
        $avatar = $r->file('file');

        if ($avatar) {
            $new_name = rand() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('images'), $new_name);
            $r->merge(["avatar" => $new_name]);
        }
        if ($r->password) {
            $r->merge(["password" => bcrypt($r->password)]);
        }
        $user->update($r->all());

        return response($user, JsonResponse::HTTP_OK);
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
