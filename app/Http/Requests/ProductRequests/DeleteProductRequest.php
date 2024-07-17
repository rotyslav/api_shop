<?php

namespace App\Http\Requests\ProductRequests;

use App\DTO\Interfaces\DTORequestInterface;
use App\DTO\ProductDTO\DeleteProductRequestDTO;
use App\Http\Requests\BaseApiRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class DeleteProductRequest extends BaseApiRequest implements DTORequestInterface
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'uuid'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws UnknownProperties
     */
    public function getDto(): DeleteProductRequestDTO
    {
        return new DeleteProductRequestDTO($this->validated());
    }
}
