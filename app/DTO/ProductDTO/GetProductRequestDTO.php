<?php

namespace App\DTO\ProductDTO;

use Spatie\DataTransferObject\DataTransferObject;

class GetProductRequestDTO extends DataTransferObject
{
    public ?string $uuid;

    public ?string $search;
}
