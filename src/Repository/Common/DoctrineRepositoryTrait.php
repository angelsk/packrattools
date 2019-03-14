<?php

namespace App\Repository\Common;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\QueryBuilder;

trait DoctrineRepositoryTrait
{
    /**
     * @var managerRegistry
     */
    private $managerRegistry;

    /**
     * @param managerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @param string $alias
     *
     * @return QueryBuilder
     */
    private function createQueryBuilder(string $alias): QueryBuilder
    {
        return $this->getRepository()->createQueryBuilder($alias);
    }

    /**
     * @return ObjectRepository
     */
    private function getRepository(): ObjectRepository
    {
        return $this->getManager()->getRepository($this->getEntityClass());
    }

    /**
     * @return ObjectManager
     */
    private function getManager(): ObjectManager
    {
        return $this->managerRegistry->getManagerForClass($this->getEntityClass());
    }
}
