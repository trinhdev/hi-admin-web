<?php

use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Main\LoginController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

Route::any('/', [IndexController::class, 'index'])->middleware('guest')->name('index');

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth.basic')->name('logout');

Route::group([
                'middleware'=>'auth.user',
                'prefix' => 'user',
                'as' => 'user.'
            ],
    function (){
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');

});
