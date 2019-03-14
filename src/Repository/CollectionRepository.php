<?php

namespace App\Repository;

use App\Entity\Collection;

interface CollectionRepository
{
    /**
     * @return Collection[]
     */
    public function getCurrentCollectionsWithFamily(): array;

    /**
     * @param int $id
     *
     * @return Collection|null
     */
    public function findOneById(int $id): ?Collection;
}
