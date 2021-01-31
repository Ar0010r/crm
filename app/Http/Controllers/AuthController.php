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
        auth()->user()->tokens()->delete();
        $permissions = auth()->user()->permissions();

        return auth()->user()->createToken('authToken', $permissions);
    }

    public function logout()
    {
        return auth()->user()->tokens()->delete();
    }
}
