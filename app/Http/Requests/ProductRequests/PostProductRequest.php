<?php

namespace App\Http\Requests\ProductRequests;

use App\DTO\Interfaces\DTORequestInterface;
use App\DTO\ProductDTO\PostProductRequestDTO;
use App\Http\Requests\BaseApiRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class PostProductRequest extends BaseApiRequest implements DTORequestInterface
{
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string'],
            'description'   => ['required', 'string'],
            'price'         => ['required', 'numeric'],
            'category_uuid' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws UnknownProperties
     */
    public function getDto(): PostProductRequestDTO
    {
        return new PostProductRequestDTO($this->validated());
    }
}
