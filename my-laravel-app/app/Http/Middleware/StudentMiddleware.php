<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->type === 'student') {
            return $next($request);
        }

        abort(403, 'Toegang geweigerd. Alleen studenten kunnen deze pagina bekijken.');
    }
}
