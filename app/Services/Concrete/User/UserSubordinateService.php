<?php


namespace App\Services\Concrete\User;

use App\Models\Company;
use App\Models\User;
use App\Services\AbstractUserResourceService;
use App\Shared\Value\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class UserSubordinateService extends AbstractUserResourceService
{
    protected function topHrResources()
    {
        $ids = UserService::getTopHrTeamIds($this->user);

        $query = User::whereIn('id', $ids)
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

        return $query;
    }

    protected function adminResources()
    {
        $query = User::query()
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

        foreach (['google', 'yahoo', 'outlook', 'other'] as $client) {
            $query->withCount([
                "letters AS {$client}_total" => function ($query) use($client)  {
                    $query->select(DB::raw("SUM($client) as {$client}total"));
                }
            ]);
        }

      /*  foreach (Company::all() as $company) {

            $query->withCount([
                "hrEmployees as {$company->name}_count" => function ($query) use ($company) {
                    $query->whereIn('employees.status', [
                        Status::READY,
                        Status::INVITED,
                        Status::EXPORTED
                    ])->where('employees.company_id', $company->getKey());
                }
            ]);

            foreach (['google', 'yahoo', 'outlook', 'other'] as $client) {
                $query->withCount([
                    "letters AS {$company->name}_{$client}_total" => function ($query) use($client, $company)  {
                        $query->select(DB::raw("SUM($client) as {$client}total"))
                            ->where('letters.company_id', $company->getKey());
                    }
                ]);
            }
        }*/

        return $query;
    }

    protected function personnelResources()
    {
        return User::where('id', null);
    }

    protected function hrResources()
    {
        return User::where('id', null);
    }

    public function getResourceModel(): Model
    {
        return new User();
    }
}
