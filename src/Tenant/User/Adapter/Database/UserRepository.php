<?php

declare(strict_types=1);

namespace Tenant\User\Adapter\Database;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\ResultSetMapping;
use Tenant\User\Domain\Model\User;
use Tenant\User\Domain\Repository\IUserRepository;
use Shared\Exception\DataBaseException;
use Shared\Exception\NotFoundException;

class UserRepository implements IUserRepository
{
    private readonly ServiceEntityRepository $repository;
    private readonly ObjectManager $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repository = new ServiceEntityRepository($managerRegistry, User::class);
        $this->manager = $managerRegistry->getManager('tenant_em');
    }

    public function save(User $user): void
    {
        try {
            $this->manager->persist($user);
            $this->manager->flush();
        } catch (\Exception $e) {
            throw DataBaseException::drop($e->getMessage());
        }
    }

    public function findById(string $id): ?User
    {
        if (null === $user = $this->manager->getRepository(User::class)->find($id)) {
            throw NotFoundException::drop(['ID', $id]);
        }

        return $user;
    }

    public function getAll(): array
    {
        // $query = $this->manager->createQuery('SELECT u.id, u.username FROM App\Entity\User u');
        // $users = $query->getResult(Query::HYDRATE_ARRAY);
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(User::class, 'u');
        $rsm->addFieldResult('u', 'id', 'id');
        $rsm->addFieldResult('u', 'username', 'username');
        $query = $this->repository->createNativeQuery('SELECT id, username FROM users', $rsm);
        $users = $query->getResult(Query::HYDRATE_ARRAY);

        return $users;
    }
}
