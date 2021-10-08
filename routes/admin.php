<?php

use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\PermissionsGroupController;
use App\Http\Controllers\Admin\UsersGroupController;
use Illuminate\Support\Facades\Route;

Route::group([
                'middleware' => ['auth.admin','throttle:10'],
                'prefix'     => 'admin',
                'as'         => 'admin.'
            ],
    function (){
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::get('/user-list', [MembersController::class, 'index'])->name('user_list');
        Route::match(['get', 'post'], '/user-create', [MembersController::class, 'create'])->name('user_create');
        Route::get('/user-profile/{user}', [MembersController::class, 'show'])->name('user_profile');
        Route::put('/user-edit/{user}', [MembersController::class, 'update'])->name('user_update');

        Route::get('/role-management', [UsersGroupController::class, 'index'])->name('role_management');
        Route::post('/role-edit', [PermissionsGroupController::class, 'update'])->name('role_edit');
        Route::get('/role-management/{groupCode}', [PermissionsGroupController::class, 'show'])->name('role_edit');

});
