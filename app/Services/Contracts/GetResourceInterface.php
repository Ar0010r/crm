<?php


namespace App\Services\Contracts;


use App\Http\Requests\AbstractGetRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GetResourceInterface
{
    public function get(AbstractGetRequest $request): LengthAwarePaginator;
}
