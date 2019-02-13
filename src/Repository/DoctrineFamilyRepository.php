<?php

namespace App\Repository;

use App\Entity\Family;
use App\Repository\Common\DoctrineRepository;
use App\Repository\Common\DoctrineRepositoryTrait;

class DoctrineFamilyRepository implements DoctrineRepository, FamilyRepository
{
    use DoctrineRepositoryTrait;

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return Family::class;
    }

    /**
     * @inheritDoc
     */
    public function getStatistics(): array
    {
        $queryBuilder = $this->createQueryBuilder('family')
            ->select('family')
            ->addSelect('COUNT(DISTINCT collection) AS total')
            ->addSelect(
                'SUM(CASE WHEN collection.expiryDate >= :today OR collection.expiryDate IS NULL ' .
                'THEN 1 ELSE 0 END) AS current'
            )
            ->innerJoin('family.collections', 'collection')
            ->setParameter('today', date('Y-m-d'))
            ->groupBy('family')
            ->orderBy('family.name');

        return $queryBuilder->getQuery()->getScalarResult();
    }

    /**
     * @inheritDoc
     */
    public function getCardStatistics(): array
    {
        $queryBuilder = $this->createQueryBuilder('family')
            ->select('family')
            ->addSelect('COUNT(collection) AS total')
            ->addSelect(
                'SUM(CASE WHEN collection.expiryDate >= :today OR collection.expiryDate IS NULL ' .
                'THEN 1 ELSE 0 END) AS current'
            )
            ->innerJoin('family.collections', 'collection')
            ->innerJoin('collection.cards', 'card')
            ->setParameter('today', date('Y-m-d'))
            ->groupBy('family')
            ->orderBy('family.name');

        return $queryBuilder->getQuery()->getScalarResult();
    }
}
