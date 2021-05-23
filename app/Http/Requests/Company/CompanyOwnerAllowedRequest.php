<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\OwnerAllowedRequest;
use App\Models\Company;
use App\Shared\Value\Role;

abstract class CompanyOwnerAllowedRequest extends OwnerAllowedRequest
{
    protected const ENTITY = 'company';
    private const OWNER_ID_NOT_FOUND = 0;

    public function authorize()
    {
        $authorize = parent::authorize();

        return $authorize || auth()->user()->role === Role::ADMIN;
    }

    protected function entityOwnerId(): string
    {
        return Company::find($this->requestId)->personnel_id ?? self::OWNER_ID_NOT_FOUND;
    }
}
