<?php


namespace App\Services\User;

use App\Models\Pivot\TopHrHr;
use App\Models\User;
use App\Shared\Value\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class UserService
{
    private UserProfileService $userProfileService;
    private UserSubordinateService $userSubordinateService;

    public function __construct(
        UserProfileService $userProfileService,
        UserSubordinateService $userSubordinateService
    ) {
        $this->userProfileService = $userProfileService;
        $this->userSubordinateService = $userSubordinateService;
    }

    public static function getTopHrTeamIds(User $user = null): Collection
    {
        $user = $user ?? auth()->user();

        $ids = $user->topHrHrs()->pluck('users.id');
        $ids[] = $user->id;

        return $ids;
    }

    public function getProfile(User $user = null): User
    {
        $user = $user ?? auth()->user();
        return $this->userProfileService->getProfile($user);
    }

    public function getUserSubordinates(User $user = null): Collection
    {
        $user = $user ?? auth()->user();
        return $this->userSubordinateService->getUserSubordinates($user);
    }

    public function saveAvatar(UploadedFile $avatar): string
    {
        $new_name = rand() . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('images'), $new_name);

        return $new_name;
    }

    public function store(User $user): User
    {
        $user->save();
        if (auth()->user()->role === Role::TOP_HR && $user->role === Role::HR) {
            TopHrHr::create(['top_hr_id' => auth()->user()->id, 'hr_id' => $user->id]);
        }

        return $this->userProfileService->getProfile($user);
    }

    public function destroy(User $user)
    {
        try {
            if($user->role === Role::HR){
                TopHrHr::where('hr_id', $user->id)->delete();
            }
            $user->delete();
            return response("deleted", JsonResponse::HTTP_NO_CONTENT);
        } catch (QueryException $e) {
            if ($user->role === Role::PERSONNEL) {
                throw new \ErrorException('manager might control some companies');
            }
            if ($user->role === Role::TOP_HR) {
                throw new \ErrorException('manager might control some hrs or employees');
            }
            throw new \ErrorException('manager might have some hired employees');
        }
    }

}