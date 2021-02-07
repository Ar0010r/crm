<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = QueryBuilder::for(Employee::class)
           ->orderByDesc('employees.created_at')
           ->allowedFilters(['company_id', 'status'])
           ->with('hr')
           ->with('company')
           ->get()
           ->toArray();



        $data = ArrayHelper::changeNullFieldsToEmptyString($employees);

        return response($data, JsonResponse::HTTP_OK);
    }

    public function store(EmployeeStoreRequest $r)
    {
        $r->merge(["hr_id" => auth()->user()->getAuthIdentifier()]);
        $employee = Employee::create($r->all());

        return response(['employee' => $employee], JsonResponse::HTTP_OK);
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
}
