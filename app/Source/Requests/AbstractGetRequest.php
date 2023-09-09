<?php

namespace App\Source\Requests;

use App\Source\Requests\Contracts\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractGetRequest extends FormRequest implements RequestInterface
{
    protected array $with = [];
    protected array $withCount = [];
    protected array $withExists = [];

    public function authorize(): bool
    {
        return true;
    }

    public function queryRules(): array
    {
        return [
            'page' => ['integer'],
            'take' => ['integer'],
            'asc' => [],
            'order_by' => ['string', 'in:created_at,updated_at,' . implode(',', $this->orderByFields())],
            '_with' => ['nullable', 'array'],
            '_with_count' => ['nullable', 'array'],
            '_with_exists' => ['nullable', 'array'],
        ];
    }

    public function rules(): array
    {
        return array_merge($this->baseRules(), $this->queryRules(), $this->additionalFilters());
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

    public function validationData()
    {
        if (!empty($this->with) && !$this->has('_with')) {
            $this->merge(['_with' => $this->with]);
        }

        if (!empty($this->withCount) && !$this->has('_with_count')) {
            $this->merge(['_with_count' => $this->withCount]);
        }

        if (!empty($this->withExists) && !$this->has('_with_exists')) {
            $this->merge(['_with_exists' => $this->withExists]);
        }

        return parent::validationData();
    }

    protected function additionalFilters(): array
    {
        return [];
    }
}
