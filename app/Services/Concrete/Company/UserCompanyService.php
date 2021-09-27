<?php


namespace App\Services\Concrete\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\AbstractUserResourceService;
use App\Services\Concrete\User\UserService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class UserCompanyService extends AbstractUserResourceService
{
    protected function adminResources(): QueryBuilder | Builder
    {
        return Company::with('personnel')
            ->withCount('employees')
            ->withCount('goodEmployees')
            ->withCount('exportedEmployees');
    }

    protected function personnelResources(User $user = null): QueryBuilder | Builder
    {
        $user = $user ?? auth()->user();

        return $user->companies()
            ->with('personnel')
            ->withCount('employees')
            ->withCount('goodEmployees')
            ->withCount('exportedEmployees');
    }

    protected function topHrResources(User $user = null): QueryBuilder | Builder
    {
        $user = $user ?? auth()->user();

        $ids = UserService::getTopHrTeamIds($user);

        return $user->companies()
            ->with('personnel')
            ->withCount([
                'employees' => function ($query) use ($ids) {
                    $query->whereIn('employees.hr_id', $ids);
                }
            ])
            ->withCount([
                'goodEmployees' => function ($query) use ($ids) {
                    $query->whereIn('employees.hr_id', $ids);
                }
            ])
            ->withCount([
                'exportedEmployees' => function ($query) use ($ids) {
                    $query->whereIn('employees.hr_id', $ids);
                }
            ]);
    }

    protected function hrResources(User $user = null): QueryBuilder | Builder
    {
        $user = $user ?? auth()->user();

        return $user->companies()
            ->with('personnel')
            ->withCount([
                'employees' => function ($query) use ($user) {
                    $query->where('employees.hr_id', '=', $user->id);
                }
            ])
            ->withCount([
                'goodEmployees' => function ($query) use ($user) {
                    $query->where('employees.hr_id', '=', $user->id);
                }
            ])
            ->withCount([
                'exportedEmployees' => function ($query) use ($user) {
                    $query->where('employees.hr_id', '=', $user->id);
                }
            ]);
    }

    public function getResourceModel(): Model
    {
        return new Company();
    }
}
