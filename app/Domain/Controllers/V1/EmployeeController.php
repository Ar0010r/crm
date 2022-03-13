<?php

namespace App\Domain\Controllers\V1;

use App\Domain\Resources\Employee\EmployeeCollection;
use App\Domain\Resources\Employee\EmployeeResource;
use App\Source\Control\Controller;
use App\Domain\Requests\Concrete\Employee\EmployeeBulkDestroyRequest;
use App\Domain\Requests\Concrete\Employee\EmployeeBulkUpdateRequest;
use App\Domain\Requests\Concrete\Employee\EmployeeGetRequest;
use App\Domain\Requests\Concrete\Employee\EmployeeStoreRequest;
use App\Domain\Requests\Concrete\Employee\EmployeeUpdateRequest;
use App\Domain\Requests\Concrete\Employee\GetMediaRequest;
use App\Domain\Requests\Concrete\Employee\UploadFileRequest;
use App\Source\Resources\ListResource;
use App\Source\Resources\ModelResource;
use App\System\Imports\EmployeeImport;
use App\Domain\Models\Employee;
use App\System\Media\Media;
use App\Domain\Services\Employee\GetEmployeeService;
use App\Domain\Services\Employee\StoreEmployeeService;
use App\Domain\Enums\Race;
use App\Domain\Enums\Status;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private StoreEmployeeService $storeService;
    private GetEmployeeService $getService;

    public function __construct(StoreEmployeeService $storeService, GetEmployeeService $getService)
    {
        $this->storeService = $storeService;
        $this->getService = $getService;
    }

    public function index(EmployeeGetRequest $request)
    {
        $data = $this->getService->get($request);

        return new EmployeeCollection($data);
    }

    public function store(EmployeeStoreRequest $r)
    {
        $employee = $this->storeService->make($r);
        $this->storeService->store($employee);

        return new EmployeeResource($employee);
    }

    public function import(Request $request, EmployeeImport $import)
    {
        $file = $request->file('file');
        Excel::import($import, $file);

        return new ModelResource([]);
    }

    public function upload(UploadFileRequest $request)
    {
        $employee = $this->storeService->uploadFile($request);

        return new EmployeeResource($employee);
    }

    public function show(Employee $employee)
    {
        $employee = $this->getService->show($employee);

        return new EmployeeResource($employee);
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $employee = $this->storeService->make($request, $employee);
        $this->storeService->update($employee);

        return new EmployeeResource($employee);
    }

    public function bulkUpdate(EmployeeBulkUpdateRequest $request)
    {
        $this->storeService->bulkUpdate($request->employees, $request->status);

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
        $this->storeService->bulkDestroy($r->employees);

        return new ModelResource([]);
    }

    public function getMedia(GetMediaRequest $request)
    {
        $media = $this->storeService->getMedia($request);


        return new ModelResource([
            'id' => $media->getKey(),
            'url' =>  asset('storage/'.$media->getKey().'/'.$media->file_name),
            ]);
    }

    public function deleteMedia(Media $media)
    {
        $employee = Employee::query()->findOrFail($media->model_id);
        $employee->clearMediaCollection($media->collection_name);
        $media->deleteOrFail();

        return new ModelResource(['model' => true]);
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
