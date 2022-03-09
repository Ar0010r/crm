<?php

namespace App\Source\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
{
    use BaseResource;

    public static $wrap = 'model';
}
