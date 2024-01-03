<?php

declare(strict_types=1);

namespace Gerent\User\Domain\Repository;

use Gerent\User\Domain\Model\User;

interface IUserRepository
{
    public function save(User $user): void;

    public function findById(string $id): array;

    public function getAll(): array;
}
