<?php

namespace App\Http\Requests;

abstract class AbstractStoreRequest extends AbstractRequest
{
    public function rules(): array
    {
        $rules = [];
        foreach ($this->baseRules() as $key => $rule) {
            $rule = $this->addRequiredToRule($key, $rule);
            $rule = $this->addUniqueToRule($key, $rule);
            $rules[$key] = $rule;
        }

        return $rules;
    }

    private function addRequiredToRule(string $key, array $rule): array
    {
        $required = $this->required();
        if (in_array($key, $required)) {
            $rule[] = 'required';
        }

        return $rule;
    }

    private function addUniqueToRule(string $key, array $rule): array
    {
        $unique = $this->unique();
        if (in_array($key, array_keys($unique))) {
            if (is_array($unique[$key])) {
                $rule[] = 'unique:' . $unique[$key]['table'] . ',' . $unique[$key]['field'];
            } else {
                $rule[] = 'unique:' . $unique[$key];
            }
        }

        return $rule;
    }
}
