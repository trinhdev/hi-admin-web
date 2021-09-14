<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->middleware('guest')->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth.basic')->name('logout');

Route::prefix('user')->middleware('auth.user')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('user.dashboard');
});
