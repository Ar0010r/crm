<?php

namespace App\Http\Requests\Contracts;

interface AuthorizeRequestInterface
{
    public function hasPermission(): bool;

}
