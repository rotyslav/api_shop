<?php

namespace App\DTO\ProductDTO;

use Spatie\DataTransferObject\DataTransferObject;

class PutProductRequestDTO extends DataTransferObject
{
    public string $uuid;

    public ?string $name;

    public ?string $description;

    public ?string $price;

}
