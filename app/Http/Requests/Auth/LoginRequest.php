<?php

namespace App\Http\Requests\Auth;

use App\DTO\AuthDTO\LoginDTO;
use App\DTO\Interfaces\DTORequestInterface;
use App\Http\Requests\BaseApiRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoginRequest extends BaseApiRequest implements DTORequestInterface
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws UnknownProperties
     */
    public function getDto(): LoginDTO
    {
        return new LoginDTO($this->validated());
    }
}
