<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Collection;

class UserService
{
    public function getTopHrTeamIds(User $user= null): Collection
    {
        $user = $user ?? auth()->user();

        $ids = $user->topHrHrs()->pluck('users.id');
        $ids[] = $user->id;

        return $ids;
    }

}