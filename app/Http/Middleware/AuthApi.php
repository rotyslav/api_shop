<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class AuthApi
{
    public function handle(Request $request, Closure $next)
    {
        if (is_null(auth('api')->user())) {
            throw new HttpResponseException(response()->json('Unauthorized', 401));
        }

        return $next($request);
    }
}
