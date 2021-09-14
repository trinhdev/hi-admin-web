<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth.admin')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
});