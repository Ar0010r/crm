<?php


namespace App\Http\Requests;

use Illuminate\Validation\Rule;

abstract class AbstractUpdateRequest extends AbstractRequest
{
    protected string $updatedId;

    public function rules(): array
    {
        $unique = $this->unique();
        if (empty($unique)) {
            return $this->baseRules();
        }

        $this->setUpdatedId();

        $rules = [];
        foreach ($this->baseRules() as $key => $rule) {
            $rules[$key] = $this->addUniqueToRule($key, $rule);
        }

        return $rules;
    }

    protected function setUpdatedId()
    {
        if (!static::ENTITY) {
            throw new \Exception('please specify entity in ENTITY const');
        }

        $this->updatedId = $this->route()->parameter(static::ENTITY)->getKey();

        if (!$this->updatedId) {
            throw new \Exception('cant find id parameter for update request');
        }
    }

    private function addUniqueToRule(string $key, array $rule): array
    {
        $unique = $this->unique();

        if (in_array($key, array_keys($unique))) {
            if (is_array($unique[$key])) {
                $rule[] = Rule::unique($unique[$key]['table'])->ignore($this->updatedId);
            } else {
                $rule[] = Rule::unique($unique[$key])->ignore($this->updatedId);
            }
        }

        return $rule;
    }
}
