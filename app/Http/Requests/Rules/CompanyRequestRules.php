<?php


namespace App\Http\Requests\Rules;


use App\Rules\User\UserIdBelongsToPersonnel;

trait CompanyRequestRules
{
    public function baseRules(): array
    {
        return [
            'name' => ['string', 'unique:companies'],
            'domain' => ['string', 'unique:companies'],
            'email' => ['string', 'unique:companies'],
            'personnel_id' => ['exists:users,id', new UserIdBelongsToPersonnel()]
        ];
    }
}
