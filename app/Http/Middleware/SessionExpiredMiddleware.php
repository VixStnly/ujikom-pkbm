<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionExpiredMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the session has expired
            if (!session()->has('last_activity')) {
                // Logout and redirect to login with an alert
                Auth::logout();
                return redirect()->route('login')->with('session_expired', 'Session expired. Please log in again.');
            }
            // Update the last activity timestamp
            session()->put('last_activity', now());
        }
        return $next($request);
    }
}
