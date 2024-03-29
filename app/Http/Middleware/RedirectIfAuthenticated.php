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

        foreach ($guards as $guard) {
            // dd(Auth::guard($guard)->check());
            
            if (Auth::guard($guard)->check()) {
                if($guard === 'admin'){
                    return redirect()->route('admin.show');
                }
            
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
