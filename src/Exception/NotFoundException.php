<?php

declare(strict_types=1);

namespace App\Exception;

class NotFoundException extends \DomainException
{
    public static function drop(array $args): self
    {
        throw new self(\sprintf('The %s [%s] not found', $args[0], $args[1]));
    }
}