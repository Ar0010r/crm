<?php

namespace App\Http\Requests\Employee;

use App\Properties\Race;
use App\Rules\User\UserIdBelongsToHr;

trait EmployeeRequestRulesTrait
{
    protected $states =
        'AL,AK,AS,AZ,AR,CA,CO,CT,DE,DC,FM,FL,GA,GU,HI,ID,IL,IN,IA,KS,KY,LA,ME,MH,MD,MA,MI,MN,MS,MO,MT,NE,NV,NH,NJ,NM,NY,
        NC,ND,MP,OH,OK,OR,PW,PA,PR,RI,SC,SD,TN,TX,UT,VT,VI,VA,WA,WV,WI,WY,AE,AA,AP';

    public function basicRules()
    {
        return [
            'company_id' => 'exists:companies,id',
            'user_id' => ['exists:users,id', new UserIdBelongsToHr()],
            'name' => 'string',
            'avatar' => 'string',
            'email' => 'email|unique:employees|unique:employees,paypal',
            'paypal' => 'email|unique:employees|unique:employees,email',
            'address' => 'string',
            'city' => 'string',
            'state' => 'string|in:' . $this->states,
            'zip' => 'regex:/^\d{5}(-\d{4})?$/',
            'phone_1' => 'regex:/^\d{3}-\d{3}-\d{4}$/',
            'phone_2' => 'regex:/^\d{3}-\d{3}-\d{4}$/',
            'race' => 'string|in:' . implode(',', Race::RACES),
        ];
    }
}
