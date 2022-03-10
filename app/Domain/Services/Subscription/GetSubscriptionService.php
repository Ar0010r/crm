<?php


namespace App\Domain\Services\Subscription;

use App\Domain\Models\Subscription;
use App\Domain\Models\User;
use App\Source\Services\AbstractGetService;
use Illuminate\Database\Eloquent\Model;

class GetSubscriptionService extends AbstractGetService
{
    protected array $whereFilters = [
        'company_id',
        'provider',
        'service',
    ];

    protected array $scopeFilters = [
        'paid_before',
        'paid_after',
    ];

    protected function setBaseQuery(User $user = null): AbstractGetService
    {
        parent::setBaseQuery($user);

        $this->query->with(['company']);

        return $this;
    }

    protected function getModel(): Model
    {
        return new Subscription();
    }
}
