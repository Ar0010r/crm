<?php


namespace App\Services\Concrete\Test;


use App\Models\Test;
use App\Models\User;
use App\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;

class GetTestService extends AbstractGetService
{
    protected array $notStringFilters = [
        'manager_id',
        'company_id',
    ];

    protected array $whereFilters = [
        'env',
        'template'
    ];

    protected function setBaseQuery(User $user = null): AbstractGetService
    {
        parent::setBaseQuery($user);

        $this->query->with(['manager', 'company']);

        return $this;
    }

    protected function getModel(): Model
    {
        return new Test();
    }

}
