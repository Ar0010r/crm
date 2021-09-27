<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concrete\Employee\EmployeeBulkDestroyRequest;
use App\Http\Requests\Concrete\Employee\EmployeeBulkUpdateRequest;
use App\Http\Requests\Concrete\Employee\EmployeeStoreRequest;
use App\Http\Requests\Concrete\Employee\EmployeeUpdateRequest;
use App\Http\Resources\Base\ListResource;
use App\Http\Resources\Base\ModelResource;
use App\Http\Resources\EmployeeResource;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use App\Services\Contracts\ResourceSearchServiceInterface;
use App\Shared\Value\Race;
use App\Shared\Value\Status;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    private ResourceSearchServiceInterface $service;

    public function __construct(ResourceSearchServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //$records = request()->get('recordsPerPage') ?? 100;
        $data = $this->service->get();

        return new ListResource($data);

        // return response(['data' => $data->items(), 'pagination' => $data], JsonResponse::HTTP_OK);
    }

    public function store(EmployeeStoreRequest $r)
    {
        $employee = $this->service->make($r);
        $this->service->store($employee);

        return new EmployeeResource($employee);
    }

    public function import(Request $r, EmployeeImport $import)
    {
        $file = $r->file('file');
        Excel::import($import, $file);

        return new ModelResource([]);
    }

    public function show(Employee $employee)
    {
        $employee = $this->service->show($employee);

        return new EmployeeResource($employee);
    }

    public function update(EmployeeUpdateRequest $r, Employee $employee)
    {
        $employee = $this->service->make($r, $employee);
        $this->service->update($employee);

        return new EmployeeResource($employee);
    }

    public function bulkUpdate(EmployeeBulkUpdateRequest $r)
    {
        $this->service->bulkUpdate($r->employees, $r->status);

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
        $this->service->bulkDestroy($r->employees);

        return new ModelResource([]);
    }

    public function search(Request $r)
    {
        if (!$r->keyword || trim($r->keyword) === "") {
            return $this->index();
        }

        $data = $this->service->search($r->keyword);

        return response(['list' => $data, 'meta' => []], JsonResponse::HTTP_OK);
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
}
