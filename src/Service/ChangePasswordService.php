<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\BadRequestException;
use App\Repository\IUserRepository;
use Symfony\Component\HttpFoundation\Request;

class ChangePasswordService
{
    public function __construct(
        private IHashService $hashService,
        private IUserRepository $userRepository
    ) {
    }

    public function __invoke(Request $request): array
    {
        $id = $request->attributes->get('id');
        $data = \json_decode($request->getContent(), true);
        $user = $this->userRepository->findById($id);
        if (!$this->hashService->isValid($user, $data['current'])) {
            throw BadRequestException::drop('Invalid current password!');
        }
        $user->setPassword($this->hashService->genHash($user, $data['new']));
        $this->userRepository->save($user);
        
        return ['message' => 'Your password has been changed successfully'];
    }
}