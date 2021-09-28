<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Main\LoginController;
use App\Http\Controllers\Main\HomeController;

use App\Http\Controllers\User\ManageOTPController;
use App\Http\Controllers\User\UserController;


Route::any('/', [HomeController::class, 'landing'])->middleware('guest')->name('landing');
Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->middleware('guest')->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth.basic')->name('logout');

Route::group([
                'middleware'=>'auth.user',
                'prefix' => 'user',
                'as' => 'user.'
            ],function (){
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::get('/profile/{user?}', [UserController::class, 'show'])->name('profile');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');

        Route::match(['get', 'post'],'/check-otp', [ManageOTPController::class, 'checkOTP'])->name('check_otp');
        Route::get('/manage-otp', [ManageOTPController::class, 'manageOTP'])->name('manage_otp');
});
