<?php

declare(strict_types=1);

namespace Gerent\User\Application;

use Gerent\User\Domain\Repository\IUserRepository;
use Gerent\User\Domain\Service\IHashService;
use Shared\Exception\BadRequestException;

class ChangePasswordService
{
    public function __construct(
        private IHashService $hashService,
        private IUserRepository $userRepository
    ) {
    }

    public function __invoke(string $id, array $data): array
    {
        $user = $this->userRepository->findById($id);
        if (!$this->hashService->isValid($user, $data['current'])) {
            throw BadRequestException::drop('Invalid current password!');
        }
        $user->setPassword($this->hashService->genHash($user, $data['new']));
        $this->userRepository->save($user);

        return ['message' => 'Your password has been changed successfully'];
    }
}
