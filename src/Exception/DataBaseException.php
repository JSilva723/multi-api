<?php

namespace App\Exception;

class DataBaseException extends \DomainException
{
    public static function drop(string $message): self
    {
        return new self(\sprintf('Database error. Message: %s', $message));
    }
}
