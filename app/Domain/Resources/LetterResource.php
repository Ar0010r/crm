<?php

namespace App\Domain\Resources;

use App\Source\Resources\ModelResource;

class LetterResource extends ModelResource
{
    public function toArray($request)
    {
        return array_merge(
            $this->resource->attributesToArray(),
            [
                'hr' => $this->hr,
                'company' => $this->company,
                'total' => $this->total()
            ]
        );
    }

    private function total(): int
    {
        return (int)$this->google + (int)$this->outlook + (int)$this->yahoo + (int)$this->other;
    }
}
