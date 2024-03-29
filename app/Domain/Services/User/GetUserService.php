<?php


namespace App\Domain\Services\User;

use App\Domain\Enums\Role;
use App\Domain\Models\User;
use App\Source\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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

    public function getRoles(User $user)
    {
        switch ($user->role) {
            case Role::TOP_HR:
                return Role::TOP_HR_AVAILABLE_ROLES;
            case Role::ADMIN:
                return Role::ADMIN_AVAILABLE_ROLES;
            default:
                return [];
        }
    }

    public static function getTopHrTeamIds(User $user = null): Collection
    {
        $user = $user ?? auth()->user();

        $ids = $user->topHrHrs()->pluck('users.id');
        $ids[] = $user->id;

        return $ids;
    }
}
