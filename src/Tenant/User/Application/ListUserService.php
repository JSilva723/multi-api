<?php

declare(strict_types=1);

namespace Tenant\User\Application;

use Tenant\User\Domain\Repository\IUserRepository;

class ListUserService
{
    public function __construct(
        private IUserRepository $userRepository,
    ) {
    }

    public function __invoke(): array
    {
        $users = $this->userRepository->getAll();

        return $users;
    }
}
