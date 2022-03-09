<?php


namespace App\Domain\Services\Employee;

use App\Domain\Requests\Concrete\Employee\GetMediaRequest;
use App\Domain\Requests\Concrete\Employee\UploadFileRequest;
use App\Domain\Models\Employee;
use App\Source\Services\AbstractStoreService;
use App\Domain\Enums\Status;
use App\System\Media\MediaCollection;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    public function uploadFile(UploadFileRequest $request): Employee
    {
        $file = $request->file('file')->getRealPath();
        $collection = $request->validated('collection');
        $employee = Employee::query()->findOrFail($request->get('id'));

        $employee->clearMediaCollection($collection)->addMedia($file)
            ->toMediaCollection($collection);

        return $employee;
    }

    public function getMedia(GetMediaRequest $request): Media
    {
       $employee = Employee::query()->findOrFail($request->get('id'));

       return match ($request->get('collection')){
           MediaCollection::AGREEMENT => $employee->agreement()->first(),
           MediaCollection::SELFIE => $employee->selfie()->first(),
           MediaCollection::SCAN => $employee->scan()->first(),
           default => throw new \Exception('Unknown media collection')
       };

    }

    protected function getModel(): Model
    {
        return new Employee();
    }
}