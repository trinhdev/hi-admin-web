<?php
namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user->group_id == 2){
            return view('admin.dashboard');
        }
        return view('user.dashboard');
    }
}