<?php

namespace App\Domain\Requests\Concrete\Employee;

use Illuminate\Foundation\Http\FormRequest;

class GetMediaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'uuid'],
            'collection' => ['required', 'string'],
        ];
    }
}
