<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Concrete\Company\CompanyStoreRequest;
use App\Http\Requests\Concrete\Company\CompanyUpdateRequest;
use App\Http\Resources\Base\ListResource;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\Employee;
use App\Services\Contracts\ResourceServiceInterface;
use App\Shared\Value\Status;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    private ResourceServiceInterface $service;

    public function __construct(ResourceServiceInterface $service) {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->get()->items();
        return new ListResource($data);
    }

    public function store(CompanyStoreRequest $r)
    {
        $company = $this->service->make($r);
        $this->service->store($company);

        return new CompanyResource($company);
    }

    public function show(Company $company)
    {
        $company = $this->service->show($company);

        return new CompanyResource($company);
    }

    public function update(CompanyUpdateRequest $r, Company $company)
    {
       $company = $this->service->make($r, $company);
       $this->service->update($company);

        return new CompanyResource($company);
    }

    public function destroy(Company $company)
    {
        try {
            $this->service->destroy($company);
            return new CompanyResource($company);
        } catch (QueryException $e) {
            return response([
                'message' => 'can`t delete company ' . $company->name,
                'errors' => [['there are might be applicants in it']]
                ], JsonResponse::HTTP_NOT_ACCEPTABLE);
        } catch (\Exception $e){
            return response(['message' => $e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function statistics()
    {
        $query = Company::query()->with('letters')->withCount('employees');

        foreach (Status::STATUSES as $status) {
            $alias = str_ireplace(' ', '_', strtolower($status));
            $query->withCount([
                "employees AS {$alias}_employees_count" => function ($query) use ($status) {
                    $query->where('employees.status', $status);
                }
            ]);
        }

        $companies = $query->orderByDesc('companies.created_at')->get();

        $data = $companies->map(function ($company) {
            $hrs = $company->letters->map(function ($letter) {
                return $letter->hr;
            })->unique();

            $hrsData = [];
            foreach ($hrs as $hr) {
                $hrLetters = $company->letters->where('hr_id', $hr->id);
                $hrEmployees = Employee::query()->where('hr_id', $hr->id)->where('company_id', $company->id);
                $hrsData[] = [
                    'id' => $hr->id,
                    'login' => $hr->login,
                    'total' => $hrEmployees->count(),
                    'hired' => $hrEmployees->whereIn('status', [Status::READY, Status::INVITED, Status::EXPORTED])->count(),
                    'letters' => $hrLetters->sum('google') + $hrLetters->sum('outlook') + $hrLetters->sum('yahoo') + $hrLetters->sum('other'),
                ];
            }

            $record['head'] = [
                'title' => $company->name,
                'company' => $company->name,
                'personnel' => $company->personnel->login,
                'letters' => $company->letters->sum('google') + $company->letters->sum('outlook') + $company->letters->sum('yahoo') + $company->letters->sum('other')
            ];
            $record['hrs'] = $hrsData;
            $record['applicants'] = [
                'total' => $company->employees_count,
                'good' => $company->ready_employees_count + $company->invited_employees_count + $company->exported_employees_count,
                'need_data' => $company->need_data_employees_count,
                'ready' => $company->ready_employees_count,
                'invited' => $company->invited_employees_count,
                'bad' => $company->bad_employees_count,
                'exported' => $company->exported_employees_count,
            ];

            return $record;

        });
        foreach ($companies as $company) {


        }

        return new ListResource($data);
    }
}
