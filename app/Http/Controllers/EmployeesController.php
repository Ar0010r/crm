<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Imports\EmployeeImport;
use App\Models\Company;
use App\Models\Employee;
use App\Shared\Value\Race;
use App\Shared\Value\Status;

use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $recordsPerPage = request()->get('recordsPerPage') ?? 10;

        $data = QueryBuilder::for(Employee::class)
            ->orderByDesc('employees.created_at')
            ->allowedFilters(['company_id', 'status', 'page'])
            ->with('hr')
            ->with('company')
            ->paginate($recordsPerPage);

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

        return response('cshc');
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

    public function statuses()
    {
        return response(Status::STATUSES_CSS_CLASSES, JsonResponse::HTTP_OK);
    }

    public function races()
    {
        return response(Race::RACES, JsonResponse::HTTP_OK);
    }
}
