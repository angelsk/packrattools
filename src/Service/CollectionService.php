<?php

namespace App\Service;

use App\Entity\Collection;
use App\Repository\CollectionRepository;

class CollectionService
{
    /**
     * @var CollectionRepository
     */
    private $repository;

    /**
     * @param CollectionRepository $repository
     */
    public function __construct(CollectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection[]
     */
    public function getCurrentCollections(): array
    {
        return $this->repository->getCurrentCollectionsWithFamily();
    }

    /**
     * @return array
     */
    public function getStatistics(): array
    {
        return $this->repository->getStatistics();
    }
}
