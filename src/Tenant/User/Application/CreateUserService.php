<?php

declare(strict_types=1);

namespace Tenant\User\Application;

use Tenant\User\Domain\Model\User;
use Tenant\User\Domain\Repository\IUserRepository;
use Tenant\User\Domain\Service\IHashService;
use Tenant\User\Domain\ValueObject\Uuid;

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
