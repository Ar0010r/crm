<?php

namespace App\Properties;

class Permission
{
    public const USER_CREATE = 'users:create';
    public const USER_LIST = 'users:list';
    public const USER_SHOW = 'users:show';
    public const USER_UPDATE = 'users:update';
    public const USER_DELETE = 'users:delete';

    public const COMPANY_CREATE = 'companies:create';
    public const COMPANY_LIST = 'companies:list';
    public const COMPANY_SHOW = 'companies:show';
    public const COMPANY_UPDATE = 'companies:update';
    public const COMPANY_DELETE = 'companies:delete';

    public const EMPLOYEE_CREATE = 'employees:create';
    public const EMPLOYEE_LIST = 'employees:list';
    public const EMPLOYEE_SHOW = 'employees:show';
    public const EMPLOYEE_UPDATE = 'employees:update';
    public const EMPLOYEE_DELETE = 'employees:delete';
    public const EMPLOYEE_EXPORT = 'employees:export';
}
