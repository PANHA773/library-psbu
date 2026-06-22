<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;

class ApiKeyMiddleware
{
    
    public function handle($request, Closure $next, $requiredScope = null)
    {
        $key = $request->header('X-API-Key');

        if (!$key) {
            return response()->json(['message' => 'Missing API Key'], 401);
        }

        $apiKey = ApiKey::where('key', $key)->where('active', true)->first();

        if (!$apiKey) {
            return response()->json(['message' => 'Invalid API Key'], 401);
        }

        $scopes = json_decode($apiKey->scopes, true) ?? [];

        if ($requiredScope && !in_array($requiredScope, $scopes)) {
            return response()->json(['message' => 'Unauthorized scope'], 403);
        }

        return $next($request);
    }

}
