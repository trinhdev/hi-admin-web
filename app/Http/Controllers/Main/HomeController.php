<?php
namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        echo 'Xin chào User, '. $user->name;
        // // var_dump($user);
        // echo $user->is_admin;
    }
}
