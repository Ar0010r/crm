<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use App\Services\EmployeeService;
use App\Shared\Value\Race;
use App\Shared\Value\Role;
use App\Shared\Value\Status;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class EmployeesController extends Controller
{
    private EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $records = request()->get('recordsPerPage') ?? 10;

        switch (auth()->user()->role) {
            case Role::PERSONNEL:
                $data = $this->employeeService->getPersonnelEmployees($records);
                break;
            case Role::HR:
                $data = $this->employeeService->getHrEmployees($records);
                break;
            case Role::ADMIN:
                $data = $this->employeeService->getAdminEmployees($records);
                break;
            case Role::TOP_HR:
                $data = $this->employeeService->getTopHrEmployees($records);
                break;
            default:
                $data = [];
        }

        return response(['data' => $data->items(), 'pagination' => $data], JsonResponse::HTTP_OK);
    }

    public function store(EmployeeStoreRequest $r)
    {
        $r->merge(["hr_id" => auth()->user()->getAuthIdentifier()]);
        $employee = Employee::create($r->all());
        $employee['status'] = Status::NEW;

        return response(['employee' => $employee], JsonResponse::HTTP_OK);
    }

    public function import(Request $r, EmployeeImport $import)
    {
        $file = $r->file('file');
        Excel::import($import, $file);

        return response('stored', JsonResponse::HTTP_NO_CONTENT);
    }

    public function show(Employee $employee)
    {
        return response(['employee' => $employee], JsonResponse::HTTP_OK);
    }

    public function update(EmployeeUpdateRequest $r, Employee $employee)
    {
        $employee->update($r->all());

        return response("updated", JsonResponse::HTTP_NO_CONTENT);
    }

    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return response("deleted", JsonResponse::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    public function search(Request $r)
    {
        if (!$r->keyword) return $this->index();

        $data = $this->employeeService->search($r->keyword);

        return response(['data' => $data, 'pagination' => []], JsonResponse::HTTP_OK);
    }

    public function statuses()
    {
        return response(Status::STATUSES_CSS_CLASSES, JsonResponse::HTTP_OK);
    }

    public function races()
    {
        return response(Race::RACES, JsonResponse::HTTP_OK);
    }
}
