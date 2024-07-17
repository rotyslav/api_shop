<?php

namespace App\DTO\AuthDTO;

use Spatie\DataTransferObject\DataTransferObject;

class LoginDTO extends DataTransferObject
{
    public string $email;

    public string $password;
}
