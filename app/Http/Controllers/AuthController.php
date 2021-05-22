<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $r)
    {
        $credentials = $r->only('login', 'password');
        if (!auth()->attempt($credentials)) {
            return response(['message' => 'Invalid credentials'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $user = auth()->user();

        return response(['user' => $user, 'token' =>$user->createToken('authToken')], JsonResponse::HTTP_OK);
    }

    public function profile()
    {
        $user = $this->userService->getProfile(auth()->user());

        return response($user, JsonResponse::HTTP_OK);
    }

    public function logout()
    {
        return auth()->user()->tokens()->delete();
    }
}
