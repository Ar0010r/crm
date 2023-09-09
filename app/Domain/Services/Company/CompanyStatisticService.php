<?php

namespace App\Domain\Services\Company;

use App\Domain\Models\Company;
use App\Domain\Models\Employee;
use App\Domain\Models\User;
use App\Domain\Enums\CompanyType;
use App\Domain\Enums\Status;
use App\Domain\Requests\Concrete\Company\CompanyGetRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class CompanyStatisticService
{
    private ?\DateTimeInterface $before = null;
    private ?\DateTimeInterface $after = null;

    public function get(CompanyGetRequest $request): LengthAwarePaginator
    {
        $request->has('created_to') && $this->before = Carbon::parse($request->created_to);
        $request->has('created_from') && $this->after = Carbon::parse($request->created_from);
        $request->offsetUnset('created_to');
        $request->offsetUnset('created_from');

        $companies =  $this->getCompanies($request);
        $data = collect($companies->items())->whereInstanceOf(Company::class)
            ->map(function ($company) {
                return $this->buildRecord($company);
            });

        return new LengthAwarePaginator($data, $companies->total(), $companies->perPage(), $companies->currentPage());

    }

    private function getCompanies(CompanyGetRequest $request): LengthAwarePaginator
    {
        $before = $this->before instanceof \DateTimeInterface ? $this->before->format('Y-m-d H:m:s') : null;
        $after = $this->after instanceof \DateTimeInterface ? $this->after->format('Y-m-d H:m:s') : null;
        $service = new GetCompanyService(new ScopeCompanyService());
        $query = $service->buildQuery($request)->getQuery()
            ->with(['manager', 'letters' => function(HasMany $query) use ($before, $after) {
                is_null($before) || $query->where('letters.created_at', '<=', $before);
                is_null($after) || $query->where('letters.created_at', '>=', $after);
            }])
            ->withCount([
                "employees AS employees_count" => function (Builder $query) use ($before, $after) {
                    is_null($before) || $query->where('employees.created_at', '<=', $before);
                    is_null($after) || $query->where('employees.created_at', '>=', $after);
                }
            ])
            ->where('type', CompanyType::DELIVERY);

        foreach (Status::STATUSES as $status) {
            $alias = str_ireplace(' ', '_', strtolower($status));
            $query->withCount([
                "employees AS {$alias}_employees_count" => function (Builder $query) use ($status, $before, $after) {
                    $query->where('employees.status', $status);
                    is_null($before) || $query->where('employees.created_at', '<=', $before);
                    is_null($after) || $query->where('employees.created_at', '>=', $after);
                }
            ]);
        }

        $query->whereRelation('letters', function($q)  use ($before, $after) {
            is_null($before) || $q->where('letters.created_at', '<=', $before);
            is_null($after) || $q->where('letters.created_at', '>=', $after);
        })/*->whereRelation('employees', function($q)  use ($before, $after) {
            is_null($before) || $q->where('employees.created_at', '<=', $before);
            is_null($after) || $q->where('employees.created_at', '>=', $after);
        })*/;

        return $query->latest()->paginate(perPage: $request->get('take'), page: $request->get('page'));
    }

    private function buildRecord(Company $company): array
    {
        $record['head'] = [
            'title' => $company->name,
            'company' => $company->name,
            'personnel' => $company->manager->login,
            'letters' => $company->letters->sum('google') + $company->letters->sum('outlook') + $company->letters->sum('yahoo') + $company->letters->sum('other')
        ];
        $record['hrs'] = $this->getHrsData($company);
        $record['applicants'] = [
            'total' => $company->employees_count,
            'need_data' => $company->need_data_employees_count,
            'ready' => $company->ready_employees_count,
            'invited' => $company->invited_employees_count,
            'died' => $company->died_employees_count,
            'exported' => $company->exported_employees_count,
            'bad' => $company->bad_employees_count + ($company->scam_employees_count ?? 0)+ ($company->not_usa_employees_count ?? 0),
            'good' => $company->ready_employees_count + $company->invited_employees_count + $company->exported_employees_count + $company->died_employees_count,
        ];

        return $record;
    }

    private function getHrsData(Company $company): Collection
    {
        $before = $this->before instanceof \DateTimeInterface ? $this->before->format('Y-m-d H:m:s') : null;
        $after = $this->after instanceof \DateTimeInterface ? $this->after->format('Y-m-d H:m:s') : null;

        $hrs = $company->letters->map(function ($letter) {
            return $letter->hr_id;
        })->unique();

        $hrs = User::query()->whereIn('id', $hrs)->get();

        return collect($hrs)->whereInstanceOf(User::class)->map(function ($hr) use ($company, $before, $after) {
            $hrLetters = $company->letters->where('hr_id', $hr->id);
            $hrEmployees = Employee::query()->where('hr_id', $hr->id)->where('company_id', $company->id);
            is_null($before) || $hrEmployees->where('employees.created_at', '<=', $before);
            is_null($after) || $hrEmployees->where('employees.created_at', '>=', $after);

            return [
                'id' => $hr->id,
                'login' => $hr->login,
                'total' => $hrEmployees->count(),
                'hired' => $hrEmployees->whereIn('status', [Status::READY, Status::INVITED, Status::EXPORTED, Status::DIED])->count(),
                'letters' => $hrLetters->sum('google') + $hrLetters->sum('outlook') + $hrLetters->sum('yahoo') + $hrLetters->sum('other'),
                'processed' => $hrLetters->sum('processed'),
            ];
        });
    }
}
