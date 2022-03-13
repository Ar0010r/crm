<?php

namespace App\Domain\Services\Company;

use App\Domain\Models\Company;
use App\Domain\Models\Employee;
use App\Domain\Models\User;
use App\Domain\Enums\CompanyType;
use App\Domain\Enums\Status;
use Illuminate\Support\Collection;

class CompanyStatisticService
{
    public function get(): Collection
    {
        return $this->getCompanies()
            ->whereInstanceOf(Company::class)
            ->map(function ($company) {
                return $this->buildRecord($company);
            });
    }

    private function getCompanies(): Collection
    {
        $query = Company::query()->where('type', CompanyType::DELIVERY)->with([
            'letters',
            'manager'
        ])->withCount('employees');

        foreach (Status::STATUSES as $status) {
            $alias = str_ireplace(' ', '_', strtolower($status));
            $query->withCount([
                "employees AS {$alias}_employees_count" => function ($query) use ($status) {
                    $query->where('employees.status', $status);
                }
            ]);
        }

        return $query->orderByDesc('companies.created_at')
            ->take(20)->get()->toBase();
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
            'good' => $company->ready_employees_count + $company->invited_employees_count + $company->exported_employees_count + $company->died_employees_count,
            'need_data' => $company->need_data_employees_count,
            'ready' => $company->ready_employees_count,
            'invited' => $company->invited_employees_count,
            'bad' => $company->bad_employees_count,
            'died' => $company->died_employees_count,
            'exported' => $company->exported_employees_count,
        ];

        return $record;
    }

    private function getHrsData(Company $company): Collection
    {
        $hrs = $company->letters->map(function ($letter) {
            return $letter->hr;
        })->unique();

        return collect($hrs)->whereInstanceOf(User::class)->map(function ($hr) use ($company) {
            $hrLetters = $company->letters->where('hr_id', $hr->id);
            $hrEmployees = Employee::query()->where('hr_id', $hr->id)->where('company_id', $company->id);
            return [
                'id' => $hr->id,
                'login' => $hr->login,
                'total' => $hrEmployees->count(),
                'hired' => $hrEmployees->whereIn('status',
                    [Status::READY, Status::INVITED, Status::EXPORTED, Status::DIED])->count(),
                'letters' => $hrLetters->sum('google') + $hrLetters->sum('outlook') + $hrLetters->sum('yahoo') + $hrLetters->sum('other'),
            ];
        });
    }
}
