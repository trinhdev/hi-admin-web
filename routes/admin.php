<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::group([
                'middleware' => 'auth.admin',
                'prefix' => 'admin',
                'as'    => 'admin.',
            ],
    function (){
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/{user}', [UsersController::class, 'show'])->name('users.show');

});