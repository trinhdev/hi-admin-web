<?php

use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\UsersController;
use Illuminate\Support\Facades\Route;

Route::group([
                'middleware' => 'auth.admin',
                'prefix' => 'admin',
                'as'    => 'admin.',
            ],
    function (){
        Route::get('/user', [UsersController::class, 'index'])->name('user_get');
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/{user}', [UsersController::class, 'show'])->name('user_show');

});
