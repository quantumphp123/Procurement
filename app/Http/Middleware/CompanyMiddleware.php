<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_company) {
            return $next($request);
        }

        return redirect()->route('company.login')->with('error', 'Please login as a company to access this page.');
    }
}
