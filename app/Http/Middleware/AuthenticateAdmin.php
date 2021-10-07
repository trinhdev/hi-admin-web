<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\UsersGroup;

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
        if(Auth::check()){
            $user = new UsersGroup();
            $userGroup = $user->getCurrentUserGroup();
            if($userGroup->group_code == "ADMIN"){
                return $next($request);

            }
            return back()->withInput(['error'=>'You dont have permission to access this resource']);
        }

        return redirect(RouteServiceProvider::LOGIN);
    }
}
