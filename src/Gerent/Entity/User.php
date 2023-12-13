<?php

declare(strict_types=1);

namespace Gerent\Entity;

class User
{
    public function __construct(
        private readonly string $id,
        private ?string $name,
        private ?string $password,
    ) {
    }

    public static function create(string $id, string $name, string $password): self
    {
        return new static($id, $name, $password);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
