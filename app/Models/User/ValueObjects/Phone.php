<?php

namespace App\Models\User\ValueObjects;

use InvalidArgumentException;

class Phone
{
    private function __construct(private readonly string $phone) {}

    public static function fromString(string $phone): Phone
    {
        if (! preg_match('/^\+?3?8?(0\d{9})$/', $phone)) {
            throw new InvalidArgumentException('It is not valid phone value');
        }

        return new self($phone);
    }

    public function toString(): string
    {
        return $this->phone;
    }
}
