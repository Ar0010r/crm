<?php


namespace App\Source\Services\Contracts;


use App\Source\Requests\AbstractGetRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GetResourceInterface
{
    public function get(AbstractGetRequest $request): LengthAwarePaginator;
}
