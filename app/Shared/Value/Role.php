<?php

namespace App\Shared\Value;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role
{
    public const HR = 'hr';
    public const PERSONNEL = 'personnel';
    public const ADMIN = 'admin';

    public const AVAILABLE_ROLES = [self::HR, self::PERSONNEL];


    public const PERMISSIONS = [
        self::HR => [
            Permission::EMPLOYEE_CREATE,
            Permission::EMPLOYEE_SHOW,
            Permission::EMPLOYEE_UPDATE,
            Permission::EMPLOYEE_DELETE,
            Permission::EMPLOYEE_LIST,

            Permission::COMPANY_LIST,
            Permission::COMPANY_SHOW
        ],
        self::PERSONNEL => [
            Permission::EMPLOYEE_EXPORT,
            Permission::EMPLOYEE_SHOW,
            Permission::EMPLOYEE_UPDATE,
            Permission::EMPLOYEE_DELETE
        ],
        self::ADMIN => [ '*'
            /*Permission::USER_CREATE,
            Permission::USER_SHOW,
            Permission::USER_UPDATE,
            Permission::USER_DELETE,

            Permission::COMPANY_CREATE,
            Permission::COMPANY_SHOW,
            Permission::COMPANY_UPDATE,
            Permission::COMPANY_DELETE,

            Permission::EMPLOYEE_CREATE,
            Permission::EMPLOYEE_SHOW,
            Permission::EMPLOYEE_UPDATE,
            Permission::EMPLOYEE_DELETE,
            Permission::EMPLOYEE_EXPORT,*/
        ],
    ];
}
