<?php

declare(strict_types=1);

namespace Gerent\Service;

use Gerent\Entity\User;
use Gerent\Repository\UserRepository;
use Symfony\Component\Uid\Uuid;

class CreateUserService
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function create(string $name, string $password): array
    {
        $user = User::create(Uuid::v4()->toRfc4122(), $name, $password);
        $this->userRepository->save($user);

        return $user->toArray();
    }
}
