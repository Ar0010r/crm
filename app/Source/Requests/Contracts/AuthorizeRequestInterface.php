<?php

namespace App\Source\Requests\Contracts;

interface AuthorizeRequestInterface
{
    public function hasPermission(): bool;

}
