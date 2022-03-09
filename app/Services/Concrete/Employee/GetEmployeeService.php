<?php


namespace App\Services\Concrete\Employee;

use App\Models\Employee;
use App\Models\User;
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

    protected function setBaseQuery(User $user = null): AbstractGetService
    {
        parent::setBaseQuery($user);

        $this->query->with(['hr', 'company'])->withExists(['selfie', 'agreement', 'scan']);

        return $this;
    }
}
