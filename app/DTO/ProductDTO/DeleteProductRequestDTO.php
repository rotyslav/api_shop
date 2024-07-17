<?php

namespace App\DTO\ProductDTO;

use Spatie\DataTransferObject\DataTransferObject;

class DeleteProductRequestDTO extends DataTransferObject
{
    public string $uuid;
}
