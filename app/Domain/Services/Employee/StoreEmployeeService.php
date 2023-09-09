<?php


namespace App\Domain\Services\Employee;

use App\Domain\Enums\Action;
use App\Domain\Models\LeadLog;
use App\Domain\Requests\Concrete\Employee\GetMediaRequest;
use App\Domain\Requests\Concrete\Employee\UploadFileRequest;
use App\Domain\Models\Employee;
use App\Source\Services\AbstractStoreService;
use App\Domain\Enums\Status;
use App\System\Media\Media as SystemMedia;
use App\System\Media\MediaCollection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class StoreEmployeeService extends AbstractStoreService
{
    public function store(Model $model): bool
    {
        $model->status = Status::NEED_DATA;
        $model->hr_id = $model->hr_id ?? auth()->user()->getAuthIdentifier();
        return parent::store($model);
    }

    public function update(Model $model): bool
    {
        $oneDirty = count($model->getDirty()) == 1;
        $contactedDirty = collect($model->getDirty())->has('contacted_at');
        $justHired = is_null($model->hired_at) && $model->status == Status::READY;
        $model->hired_at = $justHired ? Carbon::now() : $model->hired_at;
        $log = LeadLog::make([
            'employee_id' => $model->getKey(),
            'action' => $contactedDirty && $oneDirty ? Action::EMAIL : Action::UPDATE
        ]);

        DB::transaction(fn () => $log->save() && parent::update($model));


        return true;
    }

    public function bulkUpdate(array $employees, ?string $status = null, $contacted = null): bool
    {
        $ids = array_map(function ($employee) {
            return $employee['id'];
        }, $employees);

        return match (true) {
            is_string($status) && !is_null($contacted) => Employee::whereIn('id', $ids)
                ->update(['status' => $status, 'contacted' => $contacted]),
            is_string($status) => Employee::whereIn('id', $ids)->update(['status' => $status]),
            !is_null($contacted) => Employee::whereIn('id', $ids)->update(['contacted' => $contacted]),
            default => false
        };
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

        return match ($request->get('collection')) {
            MediaCollection::AGREEMENT => $employee->agreement()->first(),
            MediaCollection::SELFIE => $employee->selfie()->first(),
            MediaCollection::SCAN => $employee->scan()->first(),
            default => throw new \Exception('Unknown media collection')
        };

    }

    public function deleteMedia(SystemMedia $media)
    {
        DB::transaction(function () use ($media) {
            $employee = Employee::query()->findOrFail($media->model_id);
            $employee->clearMediaCollection($media->collection_name);
            $media->deleteOrFail();
        });

        return true;

    }

    protected function getModel(): Model
    {
        return new Employee();
    }
}
