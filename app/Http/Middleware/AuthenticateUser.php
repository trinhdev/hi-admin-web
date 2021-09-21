<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Closure;

class AuthenticateUser
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
        // Redirect user by role
        // Role: 2 is admin, 1 is user

        if(Auth::check()){
            if(Auth::user()->group_id != 2){
                return $next($request);
            }
            return back()->withInput();
        }
        return redirect(RouteServiceProvider::LOGIN);
    }
}
