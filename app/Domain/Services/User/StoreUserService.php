<?php


namespace App\Domain\Services\User;

use App\Domain\Models\Pivot\TopHrHr;
use App\Domain\Models\User;
use App\Source\Services\AbstractStoreService;
use App\Domain\Enums\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class StoreUserService extends AbstractStoreService
{
    public static function getTopHrTeamIds(User $user = null): Collection
    {
        $user = $user ?? auth()->user();

        $ids = $user->topHrHrs()->pluck('users.id');
        $ids[] = $user->id;

        return $ids;
    }

    public function update(Model $model): bool
    {
        if ($model->avatar instanceof UploadedFile) {
            $model->avatar = $this->saveAvatar($model->avatar);
        }

        return parent::update($model);
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

    public function make(Request $request, Model $resource = null): Model
    {
        $avatar = $request->file('file');

        if ($avatar) {
            $request->merge(["avatar" => $avatar]);
        }
        if ($request->password) {
            $request->merge(["password" => bcrypt($request->password)]);
        }

        return parent::make($request, $resource);
    }

    protected function getModel(): Model
    {
        return new User();
    }
}
