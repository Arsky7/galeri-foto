<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            return redirect('/dashboard'); // Sudah login → ke dashboard
        }

        return $next($request);
    }
}
