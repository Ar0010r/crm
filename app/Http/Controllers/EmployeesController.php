<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EmployeeIndexRequest;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::query()
            ->orderByDesc('employees.created_at')
            ->with('hr')
            ->with('company')
            ->get()
            ->toArray();

        foreach ($employees as &$employee) {
            foreach ($employee as $itemKey => &$item) {
                $employee[$itemKey] = $item ?? '';
                if (is_iterable($item)) {
                    foreach ($item as $key => &$value) {
                        $item[$key] = $value ?? "";
                    }
                }
            }
        }

        return response($employees, JsonResponse::HTTP_OK);
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
