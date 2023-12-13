<?php

declare(strict_types=1);

namespace Gerent\Service;

use Gerent\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ChangePasswordService
{
    public function __construct(
        private HashServiceInterface $hashService,
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(Request $request): array
    {
        $id = $request->attributes->get('id');
        $user = $this->userRepository->findById($id);
        $data = \json_decode($request->getContent(), true);
        if (!$this->hashService->isValid($user, $data['current'])) {
            throw new BadRequestHttpException('Invalid current password!');
        }
        $user->setPassword($this->hashService->genHash($user, $data['new']));

        $this->userRepository->save($user);
        
        return ['message' => 'Your password has been changed successfully'];
    }
}