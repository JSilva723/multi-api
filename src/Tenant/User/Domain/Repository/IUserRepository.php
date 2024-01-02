<?php

declare(strict_types=1);

namespace Tenant\User\Domain\Repository;

use Tenant\User\Domain\Model\User;

interface IUserRepository
{
    public function save(User $user): void;

    public function findById(string $id): ?User;

    public function getAll(): array;
}
