<?php


namespace App\Domain\Services\Subscription;


use App\Domain\Models\Subscription;
use App\Source\Services\AbstractStoreService;
use Illuminate\Database\Eloquent\Model;

class StoreSubscriptionService extends AbstractStoreService
{
    protected function getModel(): Model
    {
        return new Subscription();
    }

}
