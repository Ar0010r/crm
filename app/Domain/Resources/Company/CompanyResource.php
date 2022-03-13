<?php

namespace App\Domain\Resources\Company;

use App\Source\Resources\ModelResource;
use Carbon\Carbon;


class CompanyResource extends ModelResource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'type'=> $this->type,
            'email'=> $this->email,
            'domain'=> $this->domain,
            'pseudonym'=> $this->pseudonym,
            'manager_id'=> $this->manager_id,
            'created_at'=> $this->created_at->format('Y-m-d'),

            'manager' => $this->manager,
        ];
    }
    /*public function toArray($request)
    {
        return array_merge(
            $this->resource->attributesToArray(),
            [
                'manager' => $this->manager,
            ]
        );
    }*/
}
