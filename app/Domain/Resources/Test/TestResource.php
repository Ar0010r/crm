<?php

namespace App\Domain\Resources\Test;

use App\Source\Resources\ModelResource;

class TestResource extends ModelResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'manager_id' => $this->manager_id,
            'company_id' => $this->company_id,
            'env' => $this->env,
            'template' => $this->template,
            'google' => $this->google,
            'outlook' => $this->outlook,
            'yahoo' => $this->yahoo,
            'other' => $this->other,

            'manager' => $this->manager,
            'company' => $this->company,
        ];
    }
}
