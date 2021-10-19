<?php


namespace App\Http\Requests\Rules;


use App\Rules\User\UserIdBelongsToPersonnel;

trait CompanyRequestRules
{
    public function baseRules(): array
    {
        return [
            'name' => ['string'],
            'domain' => ['string'],
            'email' => ['string'],
            'personnel_id' => ['exists:users,id', new UserIdBelongsToPersonnel()]
        ];
    }
}
