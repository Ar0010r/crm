<?php

namespace App\Domain\Requests\Concrete\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'uuid'],
            'collection' => ['required', 'string'],
            'file' => ['required', 'file']
        ];
    }
}
