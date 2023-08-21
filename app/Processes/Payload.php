<?php

namespace App\Processes;

class Payload
{
    public function __set(string $name, mixed $value): void
    {
        $this->{$name} = $value;
    }

    public function __get(string $name): mixed
    {
        return $this->{$name} ?? null;
    }

    public function toArray(): array
    {
        return [];
    }
}
