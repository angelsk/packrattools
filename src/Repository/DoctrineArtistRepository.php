<?php

namespace App\Repository;

use App\Entity\Artist;
use App\Repository\Common\DoctrineRepository;
use App\Repository\Common\DoctrineRepositoryTrait;

class DoctrineArtistRepository implements DoctrineRepository, ArtistRepository
{
    use DoctrineRepositoryTrait;

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return Artist::class;
    }

    /**
     * @inheritDoc
     */
    public function getStatistics(): array
    {
        $queryBuilder = $this->createQueryBuilder('artist')
            ->select('artist')
            ->addSelect('COUNT(DISTINCT collection) AS total')
            ->addSelect(
                'SUM(CASE WHEN collection.expiryDate >= :today OR collection.expiryDate IS NULL THEN 1 ELSE 0 END) ' .
                'AS current'
            )
            ->innerJoin('artist.collections', 'collection')
            ->setParameter('today', date('Y-m-d'))
            ->groupBy('artist')
            ->orderBy('artist.name');

        return $queryBuilder->getQuery()->getScalarResult();
    }
}
