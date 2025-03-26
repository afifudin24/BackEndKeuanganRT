<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class TokenMiddleware
{
     public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken(); // Ambil token dari Authorization header

        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        // Cari token di database Sanctum
        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        // Set user yang sesuai dengan token ke dalam request
        $request->user = $accessToken->tokenable;

        return $next($request);
    }
}
