<?php

namespace App\Domain\Requests\Concrete\Test;


use App\Source\Requests\AbstractGetRequest;
use App\Domain\Requests\Rules\TestRequestRules;

class TestGetRequest extends AbstractGetRequest
{
    use TestRequestRules;

    public function orderByFields(): array
    {
        return [
            'id',
            'manager_id',
            'company_id',
            'google',
            'outlook',
            'yahoo',
            'other',
            'date'
        ];
    }

    public function validationData()
    {
        if(!$this->has('order_by')) {
            $this->merge([
                'order_by' => 'date',

            ]);
        }

        return parent::validationData();
    }


}
