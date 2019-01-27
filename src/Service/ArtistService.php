<?php

namespace App\Service;

use App\Entity\Artist;
use App\Repository\ArtistRepository;

class ArtistService
{
    /**
     * @var ArtistRepository
     */
    private $repository;

    public function __construct(ArtistRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Artist[]
     */
    public function getArtists(): array
    {
        return $this->repository->getArtistsWithCollections();
    }
}
