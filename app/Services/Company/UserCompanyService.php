<?php


namespace App\Services\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\User\UserService;
use App\Shared\Value\Role;
use Illuminate\Database\Eloquent\Collection;

class UserCompanyService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUserCompanies(User $user = null)
    {
        $user = $user ?? auth()->user();

        switch ($user->role) {
            case Role::PERSONNEL:
                return $this->getPersonnelCompanies($user);
            case Role::ADMIN:
                return $this->getAdminCompanies();
            case Role::TOP_HR :
                return $this->getTopHrCompanies();
            case Role::HR :
                return $this->getHrCompanies();

            default:
                return [];
        }
    }

    private function getAdminCompanies(): Collection
    {
        return Company::with('personnel')
            ->withCount('employees')
            ->withCount('goodEmployees')
            ->withCount('exportedEmployees')
            ->get();
    }

    private function getPersonnelCompanies(User $user = null): Collection
    {
        $user = $user ?? auth()->user();

        return $user->companies()
            ->with('personnel')
            ->withCount('employees')
            ->withCount('goodEmployees')
            ->withCount('exportedEmployees')
            ->get();
    }

    private function getTopHrCompanies(User $user = null): Collection
    {
        $user = $user ?? auth()->user();

        $ids = UserService::getTopHrTeamIds($user);

        return $user->companies()
            ->with('personnel')
            ->withCount(['employees' => function ($query) use ($ids) {
                $query->whereIn('employees.hr_id', $ids);
            }])
            ->withCount(['goodEmployees' => function ($query) use ($ids) {
                $query->whereIn('employees.hr_id', $ids);
            }])
            ->withCount(['exportedEmployees' => function ($query) use ($ids) {
                $query->whereIn('employees.hr_id', $ids);
            }])
            ->get();
    }

    private function getHrCompanies(User $user = null): Collection
    {
        $user = $user ?? auth()->user();

        return $user->companies()
            ->with('personnel')
            ->withCount(['employees' => function ($query) use ($user) {
                $query->where('employees.hr_id', '=', $user->id);
            }])
            ->withCount(['goodEmployees' => function ($query) use ($user) {
                $query->where('employees.hr_id', '=', $user->id);
            }])
            ->withCount(['exportedEmployees' => function ($query) use ($user) {
                $query->where('employees.hr_id', '=', $user->id);
            }])
            ->get();
    }
}