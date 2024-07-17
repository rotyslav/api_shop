<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Config;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthController extends Controller
{
    /**
     * @throws UnknownProperties
     * @throws HttpResponseException
     */
    public function register(RegisterRequest $request, UserService $userService)
    {
        $data = $request->getDto();
        $userService->createUser($data);

        return $this->loginLogic($request->getDto()->only('email', 'password')->toArray());
    }

    /**
     * @throws UnknownProperties
     */
    public function login(LoginRequest $request)
    {
        return $this->loginLogic($request->getDto()->toArray());
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Config::get('jwt.ttl'),
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function loginLogic(array $credentials)
    {
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
}
