<?php

declare(strict_types=1);

namespace Gerent\Repository;

use Gerent\Entity\User;

interface UserRepository
{
    public function save(User $user): void;
}
