<?php


namespace App\Domain\Services\Employee;

use App\Domain\Models\Employee;
use App\Domain\Requests\Concrete\Employee\GetEmailsRequest;
use App\Source\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetEmployeeService extends AbstractGetService
{
    protected array $likeFilters = [
        'name',
        'email',
        'paypal',
        'address',
        'city',
        'state',
        'zip',
        'phone_1',
        'phone_2',
    ];

    protected array $whereFilters = [
        'company_id',
        'hr_company_id',
        'hr_id',
        'status',
        'pickup',
        'race',
    ];

    protected array $scopeFilters = [
        'contacted_before',
        'contacted_after',
        'contacted_between',
        'created_before',
        'created_after',
    ];

    public function getEmails(GetEmailsRequest $request): Collection
    {
        $this->setSearchRequest($request);

        return QueryBuilder::for(Employee::class, $this->request)
            ->allowedFilters([
                AllowedFilter::scope('created_before'),
                AllowedFilter::scope('created_after'),
            ])->select(['email'])->pluck('email');
    }


    protected function getModel(): Model
    {
        return new Employee();
    }
}
