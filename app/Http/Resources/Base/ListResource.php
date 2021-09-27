<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ListResource extends ResourceCollection
{
    use BaseResource;

    public static $wrap = 'list';

    public function toArray($request)
    {
        return $this->collection;
    }
}
