<?php

namespace App\Http\Resources\Base;

use App\Dtos\ModelResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
{
    use BaseResource;

    public static $wrap = 'model';
}
