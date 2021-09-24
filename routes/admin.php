<?php

use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::group([
                'middleware' => 'auth.admin',
                'prefix' => 'admin',
                'as'    => 'admin.',
            ],
    function (){
        Route::get('/users', [UsersController::class, 'index'])->name('user_get');

        Route::get('/user', [UsersController::class, 'create'])->name('user_create');
        Route::post('/user', [UsersController::class, 'store'])->name('user_store');
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/user-edit/{user}', [UsersController::class, 'edit'])->name('user_edit');
        Route::put('/user-edit/{user}', [UsersController::class, 'update'])->name('user_update');
 
});
