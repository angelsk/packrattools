<?php

namespace App\Service;

use App\Repository\FeatRepository;

class FeatService
{
    /**
     * @var FeatRepository
     */
    private $repository;

    /**
     * @param FeatRepository $repository
     */
    public function __construct(FeatRepository $repository)
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
}
