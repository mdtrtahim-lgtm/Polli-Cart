<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class LogActivity
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        // Log only admin actions
        if (auth()->check() && auth()->user()->isAdmin()) {
            if (in_array($request->method(), ['POST', 'PUT', 'DELETE'])) {
                ActivityLog::create([
                    'user_id' => auth()->id(),
                    'action' => $request->method() . ' ' . $request->path(),
                    'model_type' => 'Request',
                    'model_id' => 0,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }
        }

        return $response;
    }
}
