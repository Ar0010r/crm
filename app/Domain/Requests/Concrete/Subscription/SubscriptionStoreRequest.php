<?php

namespace App\Domain\Requests\Concrete\Subscription;


use App\Domain\Requests\Rules\SubscriptionRequestRules;
use App\Source\Requests\AbstractStoreRequest;
use App\Domain\Requests\Permissions\AnyManagerAllowed;

class SubscriptionStoreRequest extends AbstractStoreRequest
{
    use AnyManagerAllowed;
    use SubscriptionRequestRules;

    public function required(): array
    {
        return [
            'provider',
            'service',
            'price',
            'period'
        ];
    }
}
