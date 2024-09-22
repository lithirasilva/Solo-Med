<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Use the Auth facade to check authentication and user role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        // Redirect to the home page or show a 403 error
        return redirect('/'); // You could also use abort(403); if you prefer
    }

}
