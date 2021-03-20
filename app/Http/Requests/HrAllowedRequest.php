<?php

namespace App\Http\Requests;

use App\Shared\Value\Role;
use Illuminate\Foundation\Http\FormRequest;
abstract class HrAllowedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role === Role::ADMIN || auth()->user()->role === Role::HR;
    }

    public function rules()
    {
        return [];
    }
}
