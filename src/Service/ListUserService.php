<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\IUserRepository;
use Symfony\Component\HttpFoundation\Request;

class ListUserService
{
    public function __construct(
        private IUserRepository $userRepository,
    ) {
    }

    public function __invoke(Request $request): array
    {
        $users = $this->userRepository->getAll();

        return $users;
    }
}