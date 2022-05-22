<?php

namespace App\Domain\Resources\Company;

use App\Source\Resources\ModelResource;

class CompanyResource extends ModelResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => (int)$this->type,
            'email' => $this->email,
            'domain' => $this->domain,
            'pseudonym' => $this->pseudonym,
            'manager_id' => $this->manager_id,
            'created_at' => $this->created_at->format('Y-m-d'),
            'status' => $this->resource->status,
            'scam' => $this->resource->scam,

            'manager' => $this->manager,
        ];
    }
}
