<?php


namespace App\Domain\Services\Letter;

use App\Domain\Models\Letter;
use App\Source\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;

class GetLetterService extends AbstractGetService
{
    protected array $whereFilters = [
        'hr_id',
        'company_id',
    ];

    protected array $scopeFilters = [
        'received_before',
        'received_after',
    ];

    protected function getModel(): Model
    {
        return new Letter();
    }
}
