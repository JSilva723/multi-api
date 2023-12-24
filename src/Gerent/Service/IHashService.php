<?php

declare(strict_types=1);

namespace Gerent\Service;

use Gerent\Entity\User;

interface IHashService
{
    public function genHash(User $user, string $password): string;

    public function isValid(User $user, string $password): bool;
}
