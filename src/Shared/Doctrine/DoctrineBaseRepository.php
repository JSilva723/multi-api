<?php

declare(strict_types=1);

namespace Shared\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

abstract class DoctrineBaseRepository
{
    protected ObjectRepository $objectRepository;

    public function __construct(
        private ManagerRegistry $managerRegistry,
        public Connection $connection
    ) {
        $this->objectRepository = $this->getEntityManager()->getRepository($this->entityClass());
    }

    protected function getEntityManager(string $name=''): EntityManager | ObjectManager
    {
        $emn = $name != '' ? $name : $_SERVER['ENTITY_MANAGER_NAME'];
        
        return $this->managerRegistry->getManager($emn);
    }

    abstract protected static function entityClass(): string;

    protected function saveEntity(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    protected function removeEntity(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }
}