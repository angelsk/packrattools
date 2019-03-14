<?php

namespace App\Service;

use App\Repository\FamilyRepository;

class FamilyService
{
    /**
     * @var FamilyRepository
     */
    private $repository;

    /**
     * @param FamilyRepository $repository
     */
    public function __construct(FamilyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function getStatistics(): array
    {
        return $this->repository->getStatistics();
    }

    /**
     * @return array
     */
    public function getCardStatistics(): array
    {
        return $this->repository->getCardStatistics();
    }
}
