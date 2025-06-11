<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $type)
    {

        \Log::info('User in middleware:', ['user' => Auth::user()]);
        
        if (!Auth::check() || Auth::user()->type !== $type) {

            abort(403); // Geen toegang
        }

        return $next($request);
    }
}
