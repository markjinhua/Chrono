<?php

namespace App\Http\Middleware;

use App\Support\GoogleAffliate;
use Closure;
use Auth;

class AffliateSecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  
config(['google2fa.view' => 'affliate.2fa_verify']);
 
        $authenticator = app(GoogleAffliate::class)->boot($request);
 
   
        if ($authenticator->isAuthenticated()) {
            
            return $next($request);
        } 
        return $authenticator->makeRequestOneTimePasswordResponse();
    }
}