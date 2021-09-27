<?php

namespace App\Http\Requests\Contracts;

interface RequestInterface
{
    public function rules(): array;
    public function authorize(): bool;
}
