<?php


namespace App\Services\Concrete\Company;

use App\Models\Company;
use App\Models\User;
use App\Services\AbstractUserResourceService;
use App\Services\Concrete\User\UserService;
use App\Shared\Value\Status;
use Carbon\Carbon;
use http\QueryString;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class UserCompanyService extends AbstractUserResourceService
{
    protected function adminResources()
    {
        $q = Company::with('personnel');

        foreach (Status::ALL_STATUSES as $status => $css) {
            $alias = str_ireplace(' ', '_', strtolower($status));
            $q->withCount([
                "employees AS {$alias}_employees_count" => function ($query) use ($status) {
                    $query->where('employees.status', $status);
                }
            ]);
        }

        return $q->withCount('employees')
            ->withCount('goodEmployees')
            ->withCount('exportedEmployees');

        /* return Company::with('personnel')
             ->withCount([
                 'employees AS ready_employees' => function ($query) {
                     $query->where('employees.status', Status::READY);
                 }
             ])
             ->withCount('employees')
             ->withCount('goodEmployees')
             ->withCount('exportedEmployees');*/
    }

    protected function personnelResources(User $user = null)
    {
        $user = $user ?? auth()->user();

        return $user->companies()
            ->with('personnel')
            ->withCount('employees')
            ->withCount('goodEmployees')
            ->withCount('exportedEmployees');
    }

    protected function topHrResources(User $user = null)
    {
        $user = $user ?? auth()->user();

        $ids = UserService::getTopHrTeamIds($user);

        $query = $user->companies()
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

        foreach (Status::HR_STATUSES as $status => $css) {
            $alias = str_ireplace(' ', '_', strtolower($status));
            $query->withCount([
                "employees AS {$alias}_employees_count" => function ($query) use ($status, $ids) {
                    $query->where('employees.status', $status)
                        ->whereIn('employees.hr_id', $ids);
                }
            ]);
        }

        return $query;

    }

    protected function hrResources(User $user = null)
    {
        $user = $user ?? auth()->user();

        $query = $user->companies()
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

        foreach (Status::HR_STATUSES as $status => $css) {
            $alias = str_ireplace(' ', '_', strtolower($status));
            $query->withCount([
                "employees AS {$alias}_employees_count" => function ($query) use ($status, $user) {
                    $query->where('employees.status', $status)
                        ->where('employees.hr_id', '=', $user->id);
                }
            ]);
        }

        return $query;
    }

    public function getBaseQuery()
    {
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        return parent::getBaseQuery()->withCount([
            "employees AS september_total_count" => function ($query) use($startDate, $endDate) {
            $query->whereBetween('employees.created_at', [$startDate, $endDate]);
            //$query->whereBetween('employees.created_at', ['2021-09-01', '2021-09-30']);
            }
        ]);

    }

    public function getResourceModel(): Model
    {
        return new Company();
    }
}
