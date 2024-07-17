<?php

namespace App\Http\Requests\Auth;

use App\DTO\AuthDTO\RegisterUserDTO;
use App\DTO\Interfaces\DTORequestInterface;
use App\Http\Requests\BaseApiRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RegisterRequest extends BaseApiRequest implements DTORequestInterface
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws UnknownProperties
     */
    public function getDto(): RegisterUserDTO
    {
        return new RegisterUserDTO($this->validated());
    }
}
