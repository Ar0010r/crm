<?php


namespace App\Http\Requests\Rules;


use App\Rules\User\UserIdBelongsToPersonnel;

trait CompanyRequestRules
{
    public function baseRules(): array
    {
        return [
            'name' => ['string'],
            'type' => ['numeric'],
            'domain' => ['string'],
            'email' => ['string'],
            'manager_id' => ['exists:users,id', new UserIdBelongsToPersonnel()]
        ];
    }
}
