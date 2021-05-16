<?php


namespace App\Services;

use App\Models\Employee;
use App\Shared\Value\Status;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmployeeService
{
    private UserEmployeeService $userEmployeeService;
    private EmployeeSearchService $searchService;

    public function __construct(EmployeeSearchService $searchService, UserEmployeeService $userEmployeeService )
    {
        $this->searchService = $searchService;
        $this->userEmployeeService = $userEmployeeService;
    }

    public function get(int $recordsPerPage): LengthAwarePaginator
    {
        return $this->userEmployeeService->getUserEmployees($recordsPerPage);
    }

    public function search(string $keyword): array
    {
        return $this->searchService->search($keyword);
    }

    public function store(Employee $employee): Employee
    {
        $employee->status = Status::NEW;
        $employee->save();
        $employee->hr;
        $employee->company;

        return $employee;
    }

    public function bulkUpdate(array $employees, string $status): bool
    {
        $ids = array_map(function ($employee) {
            return $employee['id'];
        }, $employees);

        return Employee::whereIn('id', $ids)->update(['status' => $status]);
    }

    public function bulkDestroy(array $employees): bool
    {
        $ids = array_map(function ($employee) {
            return $employee['id'];
        }, $employees);

        return Employee::destroy($ids);
    }

}