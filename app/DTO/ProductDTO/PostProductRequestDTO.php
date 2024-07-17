<?php

namespace App\DTO\ProductDTO;

use Spatie\DataTransferObject\DataTransferObject;

class PostProductRequestDTO extends DataTransferObject
{
    public string $name;

    public string $description;

    public float $price;

    public string $category_uuid;

}
