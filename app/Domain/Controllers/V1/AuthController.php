<?php

namespace App\Domain\Controllers\V1;

use App\Source\Control\Controller;
use App\Source\Resources\ModelResource;
use App\System\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $user = $this->authService->login($request);

        return new ModelResource(['user' => $user, 'token' => $user->createToken($user->login)]);
    }

    public function profile()
    {
        return new ModelResource(auth()->user());
    }

    public function logout()
    {
        $this->authService->logout();
        return new ModelResource(['model' => true]);
    }
}
