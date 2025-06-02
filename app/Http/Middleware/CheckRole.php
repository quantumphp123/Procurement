<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user() || $request->user()->role !== $role) {
            // Redirect to appropriate dashboard or show unauthorized error
            return redirect('/')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
