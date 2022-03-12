<?php

namespace App\Domain\Requests\Concrete\Subscription;

use App\Domain\Requests\Permissions\AnyManagerAllowed;
use App\Domain\Requests\Rules\SubscriptionRequestRules;
use App\Source\Requests\AbstractUpdateRequest;

class SubscriptionUpdateRequest extends AbstractUpdateRequest
{
    use AnyManagerAllowed;
    use SubscriptionRequestRules;
    public const ENTITY = 'Subscription';
}
