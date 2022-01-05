<?php


namespace App\Services\Concrete\User;

use App\Models\User;
use App\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;

class GetUserService extends AbstractGetService
{
    protected array $notStringFilters = [
        'role',
    ];

    protected array $likeFilters = [
        'login',
    ];
    protected function getModel(): Model
    {
       return new User();
    }
}
