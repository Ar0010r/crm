<?php

namespace App\Http\Resources\Base;

use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
{
    use BaseResource;

    public static $wrap = 'model';
}
