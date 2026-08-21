<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizeAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Admin access only');
        }

        return $next($request);
    }
}
