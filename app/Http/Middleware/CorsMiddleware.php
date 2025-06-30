<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        // Cek jika metode OPTIONS (preflight)
        if ($request->getMethod() === 'OPTIONS') {
            return response()->json('{"method":"OPTIONS"}', 200, [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, PATCH, DELETE, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
            ]);
        }

        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    }
}
