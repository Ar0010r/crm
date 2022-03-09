<?php

namespace App\Source\Requests;

use App\Source\Requests\Contracts\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractGetRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function queryRules(): array
    {
        return [
            'page' => ['numeric'],
            'take' => ['numeric'],
            'asc' => [],
            'order_by' => ['string', 'in:created_at,updated_at,' . implode(',', $this->orderByFields())]
        ];
    }

    public function rules(): array
    {
        return array_merge($this->baseRules(), $this->queryRules());
    }

    public function messages()
    {
        return [
            'order_by.in' => 'order by field is invalid. List of valid values: created_at,updated_at,' . implode(',',
                    $this->orderByFields())
        ];
    }

    abstract public function orderByFields(): array;

    abstract public function baseRules(): array;
}
