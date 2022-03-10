<?php

namespace App\System\Auth;

use App\Domain\Models\User;
use Illuminate\Http\Request;

class AuthService
{
    public function login(Request $request): User
    {
        $credentials = $request->only('login', 'password');
        if (!auth()->attempt($credentials)) {
            throw new \Exception('Invalid credentials');
        }

        return auth()->user();
    }

    public function logout()
    {
        $bearer = \request()->header('Authorization');
        $tokenWithId = str_replace('Bearer ', '', $bearer);
        $id = (int)collect(explode('|', $tokenWithId))->shift();

        auth()->user()->tokens()->where('id', $id)->delete();

    }
}
