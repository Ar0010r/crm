<?php


namespace App\Domain\Services\User;


use App\Domain\Models\Employee;
use App\Domain\Models\Letter;
use App\Domain\Models\User;
use App\Source\Services\AbstractScopeService;
use App\Domain\Enums\Role;
use App\Domain\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
        $letters = Letter::all();
        $user['admin_employees_count'] = Employee::all()->count();
        $user['admin_letters_count'] = (int)$letters->sum('google') + (int)$letters->sum('yahoo')
            + (int)$letters->sum('outlook') + (int)$letters->sum('other');
        $user['exported_admin_employees_count'] = Employee::where('employees.status',
            Status::EXPORTED)->count();
        $user['admin_good_employees_count'] = Employee::whereIn('employees.status',[
           Status::EXPORTED, Status::READY, Status::INVITED
        ])->count();
        return $user;
    }

    private function getTopHrProfile(User $user): User
    {
        $ids = StoreUserService::getTopHrTeamIds($user);
        $user['top_hr_employees_count'] = Employee::whereIn('hr_id', $ids)->count();
        $user['good_top_hr_employees_count'] = Employee::whereIn('hr_id', $ids)
            ->whereIn('employees.status', [
                Status::READY,
                Status::INVITED,
                Status::EXPORTED
            ])
            ->count();
        return $user;
    }

    private function getHrProfile(User $user): User
    {
        $query = User::where('id', $user->id)
            ->withCount('hrEmployees')
            ->withCount([
                'hrEmployees as good_hr_employees_count' => function ($query) {
                    $query->whereIn('employees.status', [
                        Status::READY,
                        Status::INVITED,
                        Status::EXPORTED
                    ]);
                }
            ]);

        foreach (['google', 'yahoo', 'outlook', 'other'] as $client) {
            $query->withCount([
                "letters AS {$client}_total" => function ($query) use($client)  {
                    $query->select(DB::raw("SUM($client) as {$client}total"));
                }
            ]);
        }

        return $query->first();
    }

}
