<?php

namespace App\Service;

use App\Repository\ArtistRepository;

class ArtistService
{
    /**
     * @var ArtistRepository
     */
    private $repository;

    /**
     * @param ArtistRepository $repository
     */
    public function __construct(ArtistRepository $repository)
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
