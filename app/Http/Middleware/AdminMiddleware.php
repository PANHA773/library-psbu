<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // If no user is logged in, block access
        if (!$user) {
            abort(403, 'You are not allowed to access this page.');
        }

        // Ensure the user model has the roles relationship
        if (!method_exists($user, 'hasAnyRole')) {
            abort(403, 'User roles are not configured properly.');
        }

        // Check roles safely
        if (!$user->hasAnyRole(['Owner','Admin','Teacher'])) {
            abort(403, 'You are not allowed to access this page.');
        }

        return $next($request);
    }
}
