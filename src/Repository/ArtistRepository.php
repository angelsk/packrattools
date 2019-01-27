<?php

namespace App\Repository;

use App\Entity\Artist;

interface ArtistRepository
{
    /**
     * @return Artist[]
     */
    public function getArtistsWithCollections(): array;
}
