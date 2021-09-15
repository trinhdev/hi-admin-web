<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::group([
                'middleware' => 'auth.admin',
                'prefix' => 'admin',
                'as'    => 'admin.',
            ],
    function (){
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
});