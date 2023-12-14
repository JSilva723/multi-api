<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\IUserRepository;
use Symfony\Component\Uid\Uuid;

class CreateUserService
{
    public function __construct(
        private IUserRepository $userRepository,
        private IHashService $hashService,
    ) {
    }

    public function create(string $username, string $password): array
    {
        $user = User::create(Uuid::v4()->toRfc4122(), $username);
        $user->setPassword($this->hashService->genHash($user, $password));
        $this->userRepository->save($user);

        return $user->toArray();
    }
}
