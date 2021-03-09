<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $r)
    {
        $credentials = $r->only('login', 'password');
        if (!auth()->attempt($credentials)) {
            return response(['message' => 'Invalid credentials'], JsonResponse::HTTP_OK);
        }
        //auth()->user()->tokens()->delete();

        $user = auth()->user();
        $p = $user->permissions();

        return response(['user' => $user, 'token' =>$user->createToken('authToken', $p)], JsonResponse::HTTP_OK);
    }

    public function profile()
    {
        return response(auth()->user(), JsonResponse::HTTP_OK);
    }

    public function logout()
    {
        return auth()->user()->tokens()->delete();
    }
}
