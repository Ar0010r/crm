<?php


namespace App\Services\Concrete\User;

use App\Models\User;
use App\Services\AbstractUserResourceService;
use App\Shared\Value\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class UserSubordinateService extends AbstractUserResourceService
{
    protected function topHrResources(): QueryBuilder | Builder
    {
        $ids = UserService::getTopHrTeamIds($this->user);

        return User::whereIn('id', $ids)
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
    }

    protected function adminResources(): QueryBuilder | Builder
    {
        return User::query()
            ->withCount('hrEmployees')
            ->withCount([
                'hrEmployees as good_hr_employees_count' => function ($query) {
                    $query->whereIn('employees.status', [
                        Status::READY,
                        Status::INVITED,
                        Status::EXPORTED
                    ]);
                }
            ])
            ->withCount('personnelEmployees')
            ->withCount([
                'personnelEmployees as exported_personnel_employees_count' => function ($query) {
                    $query->where('employees.status', Status::EXPORTED);
                }
            ]);
    }

    protected function personnelResources(): QueryBuilder | Builder
    {
        return User::where('id', null);
    }

    protected function hrResources(): QueryBuilder | Builder
    {
        return User::where('id', null);
    }

    public function getResourceModel(): Model
    {
        return new User();
    }
}
