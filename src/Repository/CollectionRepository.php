<?php

namespace App\Repository;

use App\Entity\Collection;

interface CollectionRepository
{
    /**
     * @return Collection[]
     */
    public function getCurrentCollectionsWithFamily(): array;
}
