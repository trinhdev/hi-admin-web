<?php

use App\Http\Controllers\HomeController;
use App\Models\Roles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\AclRoleController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::group([
    'middleware' => ['auth','can:role-permission'],
    ],
    function (){      
        // $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
        // $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        // $url_base = $protocol . $_SERVER['HTTP_HOST'];
        $action = 'index';
        $controller = 'Index';
        // dd(Auth::user() );
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = $_SERVER['REQUEST_URI'];
            $segments = request()->segments();
            $action = 'index';
            $controller = 'Home';
            if (!empty($segments[0])) {
                    $controller = explode('?', ucfirst($segments[0]))[0];
                if (!empty($segments[1])) {
                    $action = explode('?', $segments[1])[0];
                }
            }
            if(!in_array($controller, ['Login', 'Logout'])) {
                Route::any("/" . strtolower($controller), 'App\\Http\\Controllers\\' . $controller . 'Controller@index');
                Route::any("/" . strtolower($controller) . "/$action", 'App\\Http\\Controllers\\' . $controller . 'Controller@' . $action);
                Route::any("/" . strtolower($controller) . "/$action/{param}", 'App\\Http\\Controllers\\' . $controller . 'Controller@' . $action);
                Route::get('/', [HomeController::class, 'index'])->name('home');
                Route::get('/home', [HomeController::class, 'index'])->name('home');
            }
        }
});
