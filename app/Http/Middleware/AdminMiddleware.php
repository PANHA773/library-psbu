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

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->user_type === 'department') {
            if ($request->routeIs('dashboard') || $request->routeIs('profile.*') || $request->routeIs('books.*')) {
                return $next($request);
            }

            return redirect()->route('dashboard')
                ->with('error', 'Department users can only access the dashboard, profile, and book management pages.');
        }

        if ($user->user_type === 'admin') {
            return $next($request);
        }

        if (method_exists($user, 'hasAnyRole') && $user->hasAnyRole(['Owner', 'Admin', 'Teacher'])) {
            return $next($request);
        }

        abort(403, 'You are not allowed to access this page.');

    }
}
