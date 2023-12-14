<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;

interface IUserRepository
{
    public function save(User $user): void;

    public function findById(string $id): ?User;

    public function getAll(): array;
}
