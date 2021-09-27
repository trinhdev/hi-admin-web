<?php

use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\CheckOTPController;
use App\Http\Controllers\Admin\MembersController;
use Illuminate\Support\Facades\Route;

Route::group([
                'middleware' => 'auth.admin',
                'prefix' => 'admin',
                'as'    => 'admin.',
            ],
    function (){
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::get('/user-list', [MembersController::class, 'index'])->name('user_list');
        Route::match(['get', 'post'], '/user-create', [MembersController::class, 'create'])->name('user_create');
        Route::get('/user-edit/{user}', [MembersController::class, 'edit'])->name('user_edit');
        Route::put('/user-edit/{user}', [MembersController::class, 'update'])->name('user_update');

        Route::match(['get', 'post'], '/check-otp', [CheckOTPController::class, 'index'])->name('check_otp');
});
