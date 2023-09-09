<?php


namespace App\Domain\Requests\Rules;

trait CompanyRequestRules
{
    public function baseRules(): array
    {
        return [
            'name' => ['string'],
            'type' => ['numeric'],
            'domain' => ['string'],
            'email' => ['string'],
            'manager_id' => ['exists:users,id'],
            'status' => ['string'],
            'scam' => ['string'],
        ];
    }
}
