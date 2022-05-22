<?php


namespace App\Domain\Services\Employee;

use App\Domain\Models\Employee;
use App\Source\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;

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


    protected function getModel(): Model
    {
        return new Employee();
    }
}
