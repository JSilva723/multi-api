<?php

declare(strict_types=1);

namespace Gerent\Repository;

use App\Exception\DataBaseException;
use App\Exception\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Gerent\Entity\User;

class UserRepository implements IUserRepository
{
    public function __construct(
        private EntityManagerInterface $manager
    ) {
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
}
