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
        if(!Auth::check()){
            return $next($request);
        }
        else{
            if(Auth::user()->group_id == 1){
                return redirect()->route('user.dashboard');
            }
            return redirect()->route('admin.dashboard');
        }
            
    }
}
