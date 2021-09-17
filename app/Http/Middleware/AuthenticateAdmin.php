<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
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
            if(Auth::user()->group_id == 2){
                return $next($request);

            }
            return back()->withInput(['error'=>'You dont have permission to access this resource']);
        }
        
        return redirect(RouteServiceProvider::LOGIN);
    }
}
