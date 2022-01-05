<?php


namespace App\Services\Concrete\Employee;

use App\Models\Employee;
use App\Services\AbstractStoreService;
use App\Shared\Value\Status;
use Illuminate\Database\Eloquent\Model;

class StoreEmployeeService extends AbstractStoreService
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

    protected function getModel(): Model
    {
        return new Employee();
    }

}
