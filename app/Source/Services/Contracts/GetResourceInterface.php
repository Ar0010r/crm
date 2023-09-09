<?php


namespace App\Source\Services\Contracts;


use App\Source\Requests\AbstractGetRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

interface GetResourceInterface
{
    public function get(Request $request): LengthAwarePaginator;
}
