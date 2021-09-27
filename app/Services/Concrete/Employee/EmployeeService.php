<?php


namespace App\Services\Concrete\Employee;

use App\Models\Employee;
use App\Services\AbstractSearchableResourceService;
use App\Shared\Value\Status;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class EmployeeService extends AbstractSearchableResourceService
{
    public function store(Model $model): bool
    {
        $model->status = Status::NEED_DATA;
        $model->hr_id = $model->hr_id ?? auth()->user()->getAuthIdentifier();
        return parent::store($model);
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
