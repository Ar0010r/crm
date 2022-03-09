<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concrete\Employee\EmployeeBulkDestroyRequest;
use App\Http\Requests\Concrete\Employee\EmployeeBulkUpdateRequest;
use App\Http\Requests\Concrete\Employee\EmployeeGetRequest;
use App\Http\Requests\Concrete\Employee\EmployeeStoreRequest;
use App\Http\Requests\Concrete\Employee\EmployeeUpdateRequest;
use App\Http\Requests\Concrete\Employee\GetMediaRequest;
use App\Http\Requests\Concrete\Employee\UploadFileRequest;
use App\Http\Resources\Base\ListResource;
use App\Http\Resources\Base\ModelResource;
use App\Http\Resources\EmployeeResource;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use App\Models\Media;
use App\Services\Concrete\Employee\GetEmployeeService;
use App\Services\Concrete\Employee\StoreEmployeeService;
use App\Shared\Value\Race;
use App\Shared\Value\Status;
use Carbon\Carbon;
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

        return new ListResource($data);
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
