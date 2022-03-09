<?php

namespace App\Source\Requests\Contracts;

interface RequestInterface
{
    public function rules(): array;
    public function authorize(): bool;
}
