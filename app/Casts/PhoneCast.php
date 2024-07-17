<?php

namespace App\Casts;

use App\Models\User\ValueObjects\Phone;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class PhoneCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): Phone
    {
        return Phone::fromString($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        if (! $value instanceof Phone) {
            throw new InvalidArgumentException('The given value is not an PhoneCast instance.');
        }

        return $value->toString();
    }
}
