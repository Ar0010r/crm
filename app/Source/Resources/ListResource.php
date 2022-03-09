<?php

namespace App\Source\Resources;

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
