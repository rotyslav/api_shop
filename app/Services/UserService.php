<?php

namespace App\Services;

use App\DTO\AuthDTO\RegisterUserDTO;
use App\Models\User;
use App\Models\User\ValueObjects\Phone;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class UserService
{
    public function createUser(RegisterUserDTO $userDTO): void
    {
        try {
            User::create([
                'name'     => $userDTO->name,
                'email'    => $userDTO->email,
                'password' => Hash::make($userDTO->password),
                'phone'    => Phone::fromString($userDTO->phone),
            ]);
        } catch (InvalidArgumentException $e) {
            throw new HttpResponseException(response()->json($e->getMessage(), 422));
        }
    }

}
