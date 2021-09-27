<?php


namespace App\Services\Concrete\User;

use App\Models\Pivot\TopHrHr;
use App\Models\User;
use App\Services\AbstractResourceService;
use App\Services\Contracts\UserResourceServiceInterface;
use App\Shared\Value\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class UserService extends AbstractResourceService
{
    private UserProfileService $userProfileService;

    public function __construct(UserResourceServiceInterface $s)
    {
        $this->userProfileService = new UserProfileService();
        parent::__construct($s);
    }

    public static function getTopHrTeamIds(User $user = null): Collection
    {
        $user = $user ?? auth()->user();

        $ids = $user->topHrHrs()->pluck('users.id');
        $ids[] = $user->id;

        return $ids;
    }

    public function getProfile(User $user = null): User
    {
        $user = $user ?? auth()->user();
        return $this->userProfileService->getProfile($user);
    }

    public function update(Model $model): bool
    {
        if ($model->avatar instanceof UploadedFile) {
            $model->avatar = $this->saveAvatar($model->avatar);
        }

        return parent::update($model); // TODO: Change the autogenerated stub
    }

    public function saveAvatar(UploadedFile $avatar): string
    {
        $new_name = rand() . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('images'), $new_name);

        return $new_name;
    }

    public function store(Model $model): bool
    {
        $model->save();
        if (auth()->user()->role === Role::TOP_HR && $model->role === Role::HR) {
            TopHrHr::create(['top_hr_id' => auth()->user()->id, 'hr_id' => $model->id]);
        }

        return true;

        //return $this->userProfileService->getProfile($user);
    }

    public function destroy(Model $model): bool
    {
        try {
            if ($model->role === Role::HR) {
                TopHrHr::where('hr_id', $model->id)->delete();
            }
            return $model->delete();
        } catch (QueryException $e) {
            if ($model->role === Role::PERSONNEL) {
                throw new \ErrorException('manager might control some companies');
            }
            if ($model->role === Role::TOP_HR) {
                throw new \ErrorException('manager might control some hrs or employees');
            }
            throw new \ErrorException('manager might have some hired employees');
        }
    }

    public function make(Request $r, Model $model = null): Model
    {
        $avatar = $r->file('file');

        if ($avatar) {
            $r->merge(["avatar" => $avatar]);
        }
        if ($r->password) {
            $r->merge(["password" => bcrypt($r->password)]);
        }

        return parent::make($r, $model);
    }
}
