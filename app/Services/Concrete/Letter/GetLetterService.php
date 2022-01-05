<?php


namespace App\Services\Concrete\Letter;


use App\Models\Letter;
use App\Models\User;
use App\Services\AbstractGetService;
use App\Services\AbstractStoreService;
use Illuminate\Database\Eloquent\Model;

class GetLetterService extends AbstractGetService
{
    protected array $notStringFilters = [
        'hr_id',
        'company_id',
    ];

    protected function setBaseQuery(User $user = null): AbstractGetService
    {
        parent::setBaseQuery($user);

        $this->query->with(['hr', 'company']);

        return $this;
    }

    protected function getModel(): Model
    {
        return new Letter();
    }

}
