<?php


namespace App\Services\User;


use App\Models\Employee;
use App\Models\User;
use App\Shared\Value\Role;
use App\Shared\Value\Status;
use Illuminate\Support\Collection;

class UserProfileService
{
    public function getProfile(User $user = null): User
    {
        $user = $user ?? auth()->user();

        switch ($user->role) {
            case Role::PERSONNEL:
                return $this->getPersonnelProfile($user);
            case Role::ADMIN:
                return $this->getAdminProfile($user);
            case Role::TOP_HR:
                return $this->getTopHrProfile($user);
            default:
                return $this->getHrProfile($user);
        }
    }

    private function getPersonnelProfile(User $user): User
    {
        return User::where('id', $user->id)
            ->withCount('personnelEmployees')
            ->withCount([
                'personnelEmployees as exported_personnel_employees_count' => function ($query) {
                    $query->where('employees.status', Status::EXPORTED);
                }
            ])
            ->first();
    }

    private function getAdminProfile(User $user): User
    {
        $user['admin_employees_count'] = Employee::all()->count();
        $user['exported_admin_employees_count'] = Employee::where('employees.status',
            Status::EXPORTED)->count();
        return $user;
    }

    private function getTopHrProfile(User $user): User
    {
        $ids = UserService::getTopHrTeamIds($user);
        $user['top_hr_employees_count'] = Employee::whereIn('hr_id', $ids)->count();
        $user['good_top_hr_employees_count'] = Employee::whereIn('hr_id', $ids)
            ->whereIn('employees.status', [
                Status::READY,
                Status::GREETED,
                Status::EXPORTED
            ])
            ->count();
        return $user;
    }

    private function getHrProfile(User $user): User
    {
        return User::where('id', $user->id)
            ->withCount('hrEmployees')
            ->withCount([
                'hrEmployees as good_hr_employees_count' => function ($query) {
                    $query->whereIn('employees.status', [
                        Status::READY,
                        Status::GREETED,
                        Status::EXPORTED
                    ]);
                }
            ])
            ->first();
    }

}