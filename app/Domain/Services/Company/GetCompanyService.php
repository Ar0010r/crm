<?php


namespace App\Domain\Services\Company;

use App\Domain\Models\Company;
use App\Source\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;

class GetCompanyService extends AbstractGetService
{
    protected array $whereFilters = [
        'type', 'manager_id', 'status', 'scam'
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
