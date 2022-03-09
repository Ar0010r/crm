<?php

namespace App\Http\Resources;

use App\Http\Resources\Base\ModelResource;

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
