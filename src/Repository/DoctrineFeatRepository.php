<?php

namespace App\Repository;

use App\Entity\Feat;
use App\Repository\Common\DoctrineRepository;
use App\Repository\Common\DoctrineRepositoryTrait;

class DoctrineFeatRepository implements DoctrineRepository, FeatRepository
{
    use DoctrineRepositoryTrait;

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return Feat::class;
    }

    /**
     * @inheritDoc
     */
    public function getStatistics(): array
    {
        $queryBuilder = $this->createQueryBuilder('feat')
            ->select('COUNT(DISTINCT feat) AS total')
            ->addSelect('SUM(CASE WHEN feat.collection IS NULL THEN 1 ELSE 0 END) AS achievements')
            ->addSelect('SUM(CASE WHEN feat.collection IS NOT NULL THEN 1 ELSE 0 END) AS collections')
            ->addSelect(
                'SUM(CASE WHEN feat.collection IS NULL AND feat.available = :true THEN 1 ELSE 0 END) ' .
                'AS currentAchievements'
            )
            ->addSelect(
                'SUM(CASE WHEN collection.expiryDate >= :today OR ' .
                '(feat.collection IS NOT NULL AND collection.expiryDate IS NULL) ' .
                'THEN 1 ELSE 0 END) AS currentCollections'
            )
            ->leftJoin('feat.collection', 'collection')
            ->setParameters([
                'today' => date('Y-m-d'),
                'true' => true,
            ]);

        $result = $queryBuilder->getQuery()->getScalarResult();

        return $result[0] ?? [];
    }
}
