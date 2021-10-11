<?php

use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\PermissionsGroupController;
use App\Http\Controllers\Admin\PermissionController;
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

        Route::get('/role-management', [PermissionsGroupController::class, 'index'])->name('role_management');
        Route::get('/role-management/{groupCode}', [PermissionsGroupController::class, 'show']);
        Route::get('/role-detail/{groupCode}',[PermissionsGroupController::class,'viewRoleDetail'])->name('role_detail');
        Route::post('/role-group-add',[PermissionsGroupController::class,'store'])->name('role_group_add');
        Route::post('/role-edit', [PermissionsGroupController::class, 'update'])->name('role_edit');
        Route::get('/get-all-users-group',[PermissionsGroupController::class,'getAllUsersGroup'])->name('users_group');
        Route::post('/assign-permission-to-group',[PermissionsGroupController::class,'assignPermissionToGroup'])->name('users_group');

        
        Route::get('/role-list',[PermissionController::class,'index'])->name('role_list');
        Route::get('/permission-list',[PermissionController::class,'getAllPermissionsAssigned'])->name('permisson_list');
        Route::get('/get-all-permissions',[PermissionController::class,'getAllPermissions'])->name('permission_all');

    
});
