<?php

declare(strict_types=1);

namespace Gerent\User\Domain\Service;

use Gerent\User\Domain\Model\User;

interface IHashService
{
    public function genHash(User $user, string $password): string;

    public function isValid(User $user, string $password): bool;
}
