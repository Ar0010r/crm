<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concrete\Employee\EmployeeBulkDestroyRequest;
use App\Http\Requests\Concrete\Employee\EmployeeBulkUpdateRequest;
use App\Http\Requests\Concrete\Employee\EmployeeGetRequest;
use App\Http\Requests\Concrete\Employee\EmployeeStoreRequest;
use App\Http\Requests\Concrete\Employee\EmployeeUpdateRequest;
use App\Http\Resources\Base\ListResource;
use App\Http\Resources\Base\ModelResource;
use App\Http\Resources\EmployeeResource;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use App\Models\Letter;
use App\Services\Concrete\Employee\GetEmployeeService;
use App\Services\Concrete\Employee\StoreEmployeeService;
use App\Shared\Value\Race;
use App\Shared\Value\Status;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;


class EmployeeController extends Controller
{
    private StoreEmployeeService $storeService;
    private GetEmployeeService $getService;

    public function __construct(StoreEmployeeService $storeService, GetEmployeeService $getService)
    {
        $this->storeService = $storeService;
        $this->getService = $getService;
    }

    public function index(EmployeeGetRequest $request)
    {
        $data = $this->getService->get($request);

        return new ListResource($data);
    }

    public function store(EmployeeStoreRequest $r)
    {
        $employee = $this->storeService->make($r);
        $this->storeService->store($employee);

        return new EmployeeResource($employee);
    }

    public function import(Request $request, EmployeeImport $import)
    {
        $file = $request->file('file');
        Excel::import($import, $file);

        return new ModelResource([]);
    }

    public function show(Employee $employee)
    {
        $employee = $this->getService->show($employee);

        return new EmployeeResource($employee);
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $employee = $this->storeService->make($request, $employee);
        $this->storeService->update($employee);

        return new EmployeeResource($employee);
    }

    public function bulkUpdate(EmployeeBulkUpdateRequest $request)
    {
        $this->storeService->bulkUpdate($request->employees, $request->status);

        return new ModelResource([]);
    }

    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return new ModelResource([]);
        } catch (\Exception $e) {
            return response($e->getMessage(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function bulkDestroy(EmployeeBulkDestroyRequest $r)
    {
        $this->storeService->bulkDestroy($r->employees);

        return new ModelResource([]);
    }

    public function statuses()
    {
        return new ModelResource([
            'all' => Status::ALL_STATUSES,
            'available' => Status::getAvailableRoles()
        ]);
    }

    public function races()
    {
        return new ListResource(Race::RACES);
    }

    public function statistics()
    {
        $first = Employee::query()->orderBy('created_at')->first();
        $date = Carbon::make($first->created_at);

        $data = [];
        do {
            $end = clone $date->endOfMonth();
            $start = clone $date->startOfMonth();

            $all = QueryBuilder::for(Employee::class)
                ->with('company')
                ->whereBetween('created_at', [$start, $end])
                ->get();

            $letters = Letter::query()->whereBetween('received_at', [$start, $end])
                ->with('hr')
                ->get();

            $companies = $all->map(function ($emp) {
                return [
                    'id' => $emp->company->id,
                    'name' => $emp->company->name,
                    'personnel' => $emp->company->manager->login,
                ];
            })->unique();

            $hrs = $letters->map(function ($letter) {
                return [
                    'id' => $letter->hr->id,
                    'login' => $letter->hr->login,
                ];
            })->unique();

            foreach ($companies as $company) {
                $related = $all->where('company_id', $company['id']);
                $companyLetters = $letters->where('company_id', $company['id']);
                $record = [
                    'head' => [
                        'title' => $date->monthName . ' ' . $date->year . ' - ' . $company['name'],
                        'period' => $date->monthName . ' ' . $date->year,
                        'company' => $company['name'],
                        'personnel' => $company['personnel'],
                        'letters' => $companyLetters->sum('google') + $companyLetters->sum('outlook') + $companyLetters->sum('yahoo') + $companyLetters->sum('other')
                    ],
                    'applicants' => [
                        'total' => $related->count(),
                        'good' => $related->whereIn('status', [Status::READY, Status::INVITED, Status::EXPORTED])->count(),
                        'need_data' => $related->where('status', Status::NEED_DATA)->count(),
                        'ready' => $related->where('status', Status::READY)->count(),
                        'invited' => $related->where('status', Status::INVITED)->count(),
                        'bad' => $related->where('status', Status::BAD)->count(),
                        'exported' => $related->where('status', Status::EXPORTED)->count(),
                    ]
                ];

                //$hrs = User::query()->whereIn('role', [Role::HR, Role::TOP_HR])->get();

                foreach ($hrs as $hr) {
                    $hrLetters = $companyLetters->where('hr_id', $hr['id']);
                    $record['hrs'][] = [
                        'login' => $hr['login'],
                        'letters' => $hrLetters->sum('google') + $hrLetters->sum('outlook') + $hrLetters->sum('yahoo') + $hrLetters->sum('other'),
                        'total' => $related->where('hr_id', $hr['id'])->count(),
                        'hired' => $related->whereIn('status', [Status::READY, Status::INVITED, Status::EXPORTED])->where('hr_id', $hr['id'])->count()
                    ];
                }

                $data[] = $record;
            }

            $date->addMonth();

        } while (Carbon::now()->gte($date));

        return new ListResource(collect($data)->reverse());
    }
}
