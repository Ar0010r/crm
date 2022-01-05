<?php


namespace App\Services\Concrete\Employee;

use App\Models\Employee;
use App\Services\AbstractGetService;
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

    protected array $notStringFilters = [
        'company_id',
        'hr_id',
        'status',
        'pickup',
        'race',
    ];


    protected function getModel(): Model
    {
        return new Employee();
    }
}
