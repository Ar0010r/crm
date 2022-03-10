<?php


namespace App\Domain\Services\Test;


use App\Domain\Models\Test;
use App\Domain\Models\User;
use App\Source\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;

class GetTestService extends AbstractGetService
{
    protected array $whereFilters = [
        'env',
        'template',
        'manager_id',
        'company_id',
    ];

    protected array $scopeFilters = [
        "date_before",
        "date_after",
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
