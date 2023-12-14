<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class HashService implements IHashService
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function genHash(PasswordAuthenticatedUserInterface $user, string $password): string
    {
        return $this->userPasswordHasher->hashPassword($user, $password);
    }
    
    public function isValid(PasswordAuthenticatedUserInterface $user, string $password): bool
    {
        return $this->userPasswordHasher->isPasswordValid($user, $password);
    }
}