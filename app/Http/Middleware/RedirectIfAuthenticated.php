<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        if ($guards == "admin" && Auth::guard($guards)->check()) {
            return redirect('/admin');
        }

        if ($guards == "client" && Auth::guard($guards)->check()) {
            return redirect('/client');
        }

        
        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {
                // print_r('here'); die;
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
