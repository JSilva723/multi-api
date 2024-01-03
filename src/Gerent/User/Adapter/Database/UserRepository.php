<?php

declare(strict_types=1);

namespace Gerent\User\Adapter\Database;

use Gerent\User\Domain\Model\User;
use Gerent\User\Domain\Repository\IUserRepository;
use Shared\Doctrine\DoctrineBaseRepository;

class UserRepository extends DoctrineBaseRepository implements IUserRepository
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findById(string $id): array
    {
        $params = [
            ':id' => $this->getEntityManager()->getConnection()->quote($id),
        ];
        $query = 'SELECT * FROM user WHERE id = :id';

        return $this->getEntityManager()->getConnection()->executeQuery(\strtr($query, $params))->fetchAllAssociative();
    }

    public function getAll(): array
    {
        $query = 'SELECT id, username FROM users';

        return $this->getEntityManager()->getConnection()->executeQuery($query)->fetchAllAssociative();
    }

    public function save(User $user): void
    {
        $this->saveEntity($user);
    }
}
