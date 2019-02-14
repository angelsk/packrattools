<?php

namespace App\Repository;

use App\Entity\Collection;
use App\Repository\Common\DoctrineRepository;
use App\Repository\Common\DoctrineRepositoryTrait;

class DoctrineCollectionRepository implements DoctrineRepository, CollectionRepository
{
    use DoctrineRepositoryTrait;

    /**
     * @inheritDoc
     */
    public function getEntityClass(): string
    {
        return Collection::class;
    }

    /**
     * @inheritDoc
     */
    public function getCurrentCollectionsWithFamily(): array
    {
        $queryBuilder = $this->createQueryBuilder('collection')
            ->select('collection, family, feat, related, relatedFeats, cards')
            ->addSelect('CASE WHEN family.id = :gadget THEN 1 ELSE 0 END AS HIDDEN isGadget')
            ->innerJoin('collection.family', 'family')
            ->leftJoin('collection.feat', 'feat')
            ->leftJoin('collection.relatedCollections', 'related')
            ->leftJoin('related.feat', 'relatedFeats')
            ->leftJoin('collection.cards', 'cards')
            ->where('collection.expiryDate IS NULL OR collection.expiryDate >= :today')
            ->orderBy('isGadget', 'ASC')
            ->addOrderBy('collection.releaseDate', 'DESC')
            ->addOrderBy('collection.id', 'DESC')
            ->setParameters([
                'gadget' => 0,
                'today' => date('Y-m-d')
            ]);

        return $queryBuilder->getQuery()->execute();
    }
}
