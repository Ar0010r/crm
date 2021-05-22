<?php


namespace App\Services\User;

use App\Models\User;
use App\Shared\Value\Role;
use App\Shared\Value\Status;
use Illuminate\Support\Collection;

class UserSubordinateService
{
    private UserProfileService $userProfileService;

    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }

    public function getUserSubordinates(User $user = null): Collection
    {
        $user = $user ?? auth()->user();

        switch ($user->role) {
            case Role::TOP_HR:
                return $this->getTopHrSubordinates($user);
            case Role::ADMIN:
                return $this->getAdminSubordinates($user);
            default:
                return collect([]);
        }
    }

    private function getTopHrSubordinates(User $user): Collection
    {
        $ids = UserService::getTopHrTeamIds($user);

        return User::whereIn('id', $ids)
            ->withCount('hrEmployees')
            ->withCount(['hrEmployees as good_hr_employees_count' => function ($query) {
                $query->whereIn('employees.status', [
                    Status::READY,
                    Status::GREETED,
                    Status::EXPORTED
                ]);
            }])
            ->get();

    }

    private function getAdminSubordinates(User $user): Collection
    {
        return $user->newQuery()
            ->withCount('hrEmployees')
            ->withCount(['hrEmployees as good_hr_employees_count' => function ($query) {
                $query->whereIn('employees.status', [
                    Status::READY,
                    Status::GREETED,
                    Status::EXPORTED
                ]);
            }])
            ->withCount('personnelEmployees')
            ->withCount(['personnelEmployees as exported_personnel_employees_count' => function ($query) {
                $query->where('employees.status', Status::EXPORTED);
            }])
            ->get();
    }
}