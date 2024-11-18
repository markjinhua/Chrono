<?php

namespace App\Http\Middleware;

use App\Support\Google2FAAuthenticator;
use Closure;
use Auth;

class LoginSecurityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { if (  Auth::guard('affliate')->check()) {
config(['google2fa.view' => 'affliate.2fa_verify']);
 }

 if ( Auth::guard('admin')->check()) {
 config(['google2fa.view' => 'admin.2fa_verify']);
 };
 if ( Auth::guard('publisher')->check()) {
config(['google2fa.view' => 'auth.2fa_verify']);
 };
        $authenticator = app(Google2FAAuthenticator::class)->boot($request);
 
        // if ($authenticator->verifyGoogle2FA(Auth::guard('publisher')->user()->LoginSecurity->google2fa_secret,$request->one_time_password)) {
          
        // }

        if ($authenticator->isAuthenticated()) {
            
            return $next($request);
        }

        return $authenticator->makeRequestOneTimePasswordResponse();
    }
}