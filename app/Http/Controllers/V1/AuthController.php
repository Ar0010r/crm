<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Base\ModelResource;
use App\Services\Concrete\User\StoreUserService;
use App\Services\Concrete\User\UserProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private StoreUserService $storeService;
    private UserProfileService $profileService;

    public function __construct(StoreUserService $storeService, UserProfileService $profileService)
    {
        $this->storeService = $storeService;
        $this->profileService = $profileService;
    }

    public function login(Request $r)
    {
        $credentials = $r->only('login', 'password');
        if (!auth()->attempt($credentials)) {
            return response(['message' => 'Invalid credentials'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $user = auth()->user();

        return new ModelResource(['user' => $user, 'token' => $user->createToken($user->login)]);
    }

    public function profile()
    {
        $user = $this->profileService->getProfile(auth()->user());

        return new ModelResource($user);
    }

    public function logout()
    {
        try {
            $bearer = \request()->header('Authorization');
            $tokenWithId = str_replace('Bearer ', '', $bearer);
            $id = (int)collect(explode('|', $tokenWithId))->shift();

            auth()->user()->tokens()->where('id', $id)->delete();
            return new ModelResource(['model' => true]);
        } catch (\Exception $e) {
            return new ModelResource(['model' => $e->getMessage()]);
        }
    }
}
