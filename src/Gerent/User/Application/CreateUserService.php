<?php

declare(strict_types=1);

namespace Gerent\User\Application;

use Gerent\User\Domain\Model\User;
use Gerent\User\Domain\Repository\IUserRepository;
use Gerent\User\Domain\Service\IHashService;
use Gerent\User\Domain\ValueObject\Uuid;

class CreateUserService
{
    public function __construct(
        private IUserRepository $userRepository,
        private IHashService $hashService,
    ) {
    }

    public function create(string $username, string $password): array
    {
        $user = User::create(Uuid::random()->value(), $username);
        $user->setPassword($this->hashService->genHash($user, $password));
        $this->userRepository->save($user);

        return $user->toArray();
    }
}
