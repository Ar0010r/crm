<?php


namespace App\Services\Contracts;


use App\Http\Requests\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ResourceSearchServiceInterface
{
    public function search(string $keyword): array;
}
