<?php

namespace App\Domain\Requests\Concrete\Employee;

use Illuminate\Foundation\Http\FormRequest;

class GetEmailsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'created_before' => ['date'],
            'created_after' => ['date']
        ];
    }
}
