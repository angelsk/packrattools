<?php

namespace App\Repository;

interface ArtistRepository
{
    /**
     * @return array
     */
    public function getStatistics(): array;
}
