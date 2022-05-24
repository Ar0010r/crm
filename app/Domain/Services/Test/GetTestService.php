<?php


namespace App\Domain\Services\Test;


use App\Domain\Models\Test;
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

    protected function getModel(): Model
    {
        return new Test();
    }

}
