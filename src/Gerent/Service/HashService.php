<?php

declare(strict_types=1);

namespace Gerent\Service;

// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// use Symfony\Component\Security\Core\User\UserInterface;
use Gerent\Entity\User;

class HashService implements HashServiceInterface
{
    // public function __construct(private UserPasswordEncoderInterface $userPasswordEncoder)
    // {
    // }

    public function genHash(User $user, string $password): string
    {
        return $password;
        // return $this->userPasswordEncoder->encodePassword($user, $password);
    }
    
    public function isValid(User $user, string $password): bool
    {
        return true;
        //return $this->userPasswordEncoder->isPasswordValid($user, $password);
    }
}