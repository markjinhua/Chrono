<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
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
    {   if ($guard == "affliate" && Auth::guard($guard)->check()) {
            return redirect()->route('beforelogin');
        }

           if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect()->route('admin.dashboard');
        }

    if ($guard == "publisher" && Auth::guard($guard)->check() && Auth::guard('publisher')->user()->role=='publisher') {
            return redirect()->route('publisher.dashboard');
        }


        if (Auth::guard($guard)->check()) {
            return redirect()->route('admin');
        }


        return $next($request);
    }
}
