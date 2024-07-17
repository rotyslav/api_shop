<?php

namespace App\Http\Requests\ProductRequests;

use App\DTO\Interfaces\DTORequestInterface;
use App\DTO\ProductDTO\PutProductRequestDTO;
use App\Http\Requests\BaseApiRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class PutProductRequest extends BaseApiRequest implements DTORequestInterface
{
    public function rules(): array
    {
        return [
            'uuid'        => ['required', 'uuid'],
            'name'        => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'price'       => ['nullable', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws UnknownProperties
     */
    public function getDto(): PutProductRequestDTO
    {
        return new PutProductRequestDTO($this->validated());
    }
}
