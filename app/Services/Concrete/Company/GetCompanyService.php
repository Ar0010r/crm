<?php


namespace App\Services\Concrete\Company;

use App\Models\Company;
use App\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;

class GetCompanyService extends AbstractGetService
{
    protected array $notStringFilters = [
        'type', 'manager_id'
    ];

    protected array $likeFilters = [
        'name',
        'email',
        'domain',
        'pseudonym',
    ];

    protected array $scopeFilters = [
        'created_before',
        'created_after',
    ];

    protected function getModel(): Model
    {
        return new Company();
    }
}
