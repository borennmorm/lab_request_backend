<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        // If the request doesn't expect JSON, return null to prevent redirect
        if (!$request->expectsJson()) {
            return null;  // Prevent redirection and let Laravel handle 401 Unauthorized for API
        }
    }
}
