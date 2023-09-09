<?php

namespace App\Domain\Requests\Concrete\Shared;

use Illuminate\Foundation\Http\FormRequest;

class DateRangeRequest extends FormRequest
{
    public function rules(): array
    {
        return ['from' => ['date'], 'to' => ['date']];
    }

}
