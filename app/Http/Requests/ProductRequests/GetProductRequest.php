<?php

namespace App\Http\Requests\ProductRequests;

use App\DTO\Interfaces\DTORequestInterface;
use App\DTO\ProductDTO\GetProductRequestDTO;
use App\Http\Requests\BaseApiRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetProductRequest extends BaseApiRequest implements DTORequestInterface
{
    public function rules(): array
    {
        return [
            'uuid' => ['nullable', 'uuid'],
            'search' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws UnknownProperties
     */
    public function getDto(): GetProductRequestDTO
    {
        return new GetProductRequestDTO($this->validated());
    }
}
