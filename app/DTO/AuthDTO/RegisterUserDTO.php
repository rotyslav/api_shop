<?php

namespace App\DTO\AuthDTO;

use Spatie\DataTransferObject\DataTransferObject;

class RegisterUserDTO extends DataTransferObject
{
    public string $name;

    public string $email;

    public string $password;

    public ?string $phone;
}
