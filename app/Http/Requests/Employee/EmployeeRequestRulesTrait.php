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
            'company_id' => 'nullable|exists:companies,id',
            'user_id' => ['nullable|exists:users,id', new UserIdBelongsToHr()],
            'name' => 'nullable|string',
            'avatar' => 'nullable|string',
            'email' => 'nullable|email|unique:employees|unique:employees,paypal',
            'paypal' => 'nullable|email|unique:employees|unique:employees,email',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string|in:' . $this->states,
            'zip' => 'nullable|regex:/^\d{5}(-\d{4})?$/',
            'phone_1' => 'nullable|regex:/^\d{3}-\d{3}-\d{4}$/',
            'phone_2' => 'nullable|regex:/^\d{3}-\d{3}-\d{4}$/',
            'race' => 'nullable|string|in:' . implode(',', Race::RACES),
        ];
    }
}
