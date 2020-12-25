<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check() && auth()->user()->role == 'admin'){
            return redirect('/panel/admin-dashboard');
        }

        if (Auth::guard($guard)->check() && auth()->user()->role == 'user'){
            return redirect('/my-account');
        }

        return $next($request);
    }
}
