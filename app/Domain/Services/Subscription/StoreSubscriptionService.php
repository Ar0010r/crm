<?php


namespace App\Domain\Services\Subscription;


use App\Domain\Enums\Period;
use App\Domain\Models\Subscription;
use App\Source\Services\AbstractStoreService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreSubscriptionService extends AbstractStoreService
{
    protected function getModel(): Model
    {
        return new Subscription();
    }

    public function make(Request $request, Model $resource = null): Model
    {
        $model = parent::make($request, $resource);
        $model->next_payment = $this->nextPayment($model);

        return $model;
    }

    public function nextPayment(Subscription $subscription)
    {
        if ($subscription->last_payment && is_string($subscription->period)) {
            return match ($subscription->period) {
                Period::MONTHLY => $subscription->last_payment->addMonth()->format('Y-m-d'),
                Period::QUARTERLY => $subscription->last_payment->addMonths(3)->format('Y-m-d'),
                Period::HALF_YEARLY => $subscription->last_payment->addMonths(6)->format('Y-m-d'),
                Period::YEARLY => $subscription->last_payment->addYear()->format('Y-m-d'),
                default => null
            };
        }

        return null;
    }

}
