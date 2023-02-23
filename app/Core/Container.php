<?php

declare(strict_types=1);

namespace App\Core;

final class Container
{
    public function __construct(private readonly array $objects = [])
    {
    }

    public function has(string $id): bool
    {
        return isset($this->objects[$id]) || class_exists($id);
    }

    public function get(string $id): mixed
    {
        return isset($this->objects[$id])
            ? $this->objects[$id]($this)
            : new $id;
    }
}