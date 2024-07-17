<?php

namespace App\DTO\Interfaces;

use Spatie\DataTransferObject\DataTransferObject;

interface DTORequestInterface
{
    public function getDto(): DataTransferObject;
}
