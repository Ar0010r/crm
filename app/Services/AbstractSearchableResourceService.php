<?php


namespace App\Services;

use App\Services\Contracts\UserResourceServiceInterface;
use App\Services\AbstractResourceService as AbstractService;
use App\Services\Contracts\ResourceSearchServiceInterface as SearchServiceInterface;

abstract class AbstractSearchableResourceService extends AbstractService implements SearchServiceInterface
{
    protected SearchServiceInterface $searchService;

    public function __construct(UserResourceServiceInterface $service, SearchServiceInterface $searchService)
    {
        $this->searchService = $searchService;
        parent::__construct($service);
    }

    public function search(string $keyword): array
    {
        return $this->searchService->search($keyword);
    }
}
