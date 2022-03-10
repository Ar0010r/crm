<?php

namespace App\Domain\Requests\Concrete\Subscription;

use App\Domain\Requests\Rules\SubscriptionRequestRules;
use App\Source\Requests\AbstractUpdateRequest;
use App\Domain\Requests\Permissions\HrAllowed;

class SubscriptionUpdateRequest extends AbstractUpdateRequest
{
    use HrAllowed;
    use SubscriptionRequestRules;
    public const ENTITY = 'Subscription';
}
