<?php

namespace App\Http\Resources\Base;

class PartialListResource extends ListResource
{
    public ?int $rowsCount = null;

    public function with($request)
    {
        return array_merge(parent::with($request), ['pagination' => $this->resource]);
    }

    public function toArray($request)
    {
        return $this->collection->items();
    }
}
