<?php

namespace App\Domain\Controllers\V1;

use App\Source\Control\Controller;
use App\Source\Resources\ModelResource;
use App\Domain\Services\User\UserProfileService;
use App\System\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;
    private UserProfileService $profileService;

    public function __construct(AuthService $authService, UserProfileService $profileService)
    {
        $this->authService = $authService;
        $this->profileService = $profileService;
    }

    public function login(Request $request)
    {
        $user = $this->authService->login($request);

        return new ModelResource(['user' => $user, 'token' => $user->createToken($user->login)]);
    }

    public function profile()
    {
        $user = $this->profileService->getProfile(auth()->user());

        return new ModelResource($user);
    }

    public function logout()
    {
        $this->authService->logout();
        return new ModelResource(['model' => true]);
    }
}
