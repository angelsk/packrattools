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
    public function getArtistsWithCollections(): array
    {
        $queryBuilder = $this->createQueryBuilder('artist')
            ->select('artist, collection, feat') // @TODO: See collection repo
            ->innerJoin('artist.collections', 'collection')
            ->leftJoin('collection.feat', 'feat')
            ->orderBy('artist.name');

        return $queryBuilder->getQuery()->execute();
    }
}
