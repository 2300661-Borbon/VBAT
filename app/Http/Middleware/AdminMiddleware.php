<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated AND has the admin role
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Boot non-admins back to the user dashboard
        return redirect()->route('user.dashboard')->with('error', 'Unauthorized access.');
    }
}