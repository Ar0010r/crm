<?php

namespace App\Domain\Requests\Concrete\Subscription;

use App\Domain\Requests\Rules\SubscriptionRequestRules;
use App\Source\Requests\AbstractGetRequest;

class SubscriptionGetRequest extends AbstractGetRequest
{
    use SubscriptionRequestRules;
    protected array $with=['company'];

    public function orderByFields(): array
    {
        return [
            'id',
            'provider',
            'service',
            'price',
            'last_payment',
            'period'
        ];
    }
}
