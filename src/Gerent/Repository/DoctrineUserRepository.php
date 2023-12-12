<?php

declare(strict_types=1);

namespace Gerent\Repository;

use App\Exception\DataBaseException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Gerent\Entity\User;

class DoctrineUserRepository implements UserRepository
{
    private readonly ObjectManager $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->manager = $managerRegistry->getManager('gerent_em');
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
}
