<?php

namespace App\Domain\Resources\Letter;

use App\Source\Resources\ModelResource;

class LetterResource extends ModelResource
{
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'hr_id' => $this->hr_id,
            'company_id' => $this->company_id,
            'google' => $this->google,
            'outlook' => $this->outlook,
            'yahoo' => $this->yahoo,
            'other' => $this->other,
            'received_at' => $this->received_at,
            'processed' => $this->processed,

            'hr' => $this->hr,
            'company' => $this->company,
            'total' => $this->total()
        ];
    }

    /*public function toArray($request)
    {
        return array_merge(
            $this->resource->attributesToArray(),
            [
                'hr' => $this->hr,
                'company' => $this->company,
                'total' => $this->total()
            ]
        );
    }*/

    private function total(): int
    {
        return (int)$this->google + (int)$this->outlook + (int)$this->yahoo + (int)$this->other;
    }
}
