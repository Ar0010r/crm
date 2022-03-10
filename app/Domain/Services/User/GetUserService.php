<?php


namespace App\Domain\Services\User;

use App\Domain\Models\User;
use App\Source\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;

class GetUserService extends AbstractGetService
{
    protected array $whereFilters = [
        'role',
    ];

    protected array $likeFilters = [
        'login',
    ];

    protected array $scopeFilters = [
        'created_before',
        'created_after',
    ];

    protected function getModel(): Model
    {
       return new User();
    }
}
