<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // nếu gọi bằng phương thức get trả về view login
        if ($request->getMethod() == 'GET') {
            return view('login');
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->group_id == 2){
                return redirect()->route('admin.dashboard');
            }
            else{
                return redirect()->route('user.dashboard');
            }
        } else {
            return back()->withInput();
        }
    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('index');
        }
        return back();
    }
}
