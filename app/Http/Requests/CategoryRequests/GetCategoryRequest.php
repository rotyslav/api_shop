<?php

namespace App\Http\Requests\CategoryRequests;

use App\DTO\CategoryDTO\CategoryRequestDTO;
use App\DTO\Interfaces\DTORequestInterface;
use App\Http\Requests\BaseApiRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class GetCategoryRequest extends BaseApiRequest implements DTORequestInterface
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
    public function getDto(): CategoryRequestDTO
    {
        return new CategoryRequestDTO($this->validated());
    }
}
