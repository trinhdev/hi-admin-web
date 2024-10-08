<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('Api')->group(function () {
    Route::post('/log-report', 'LogReportController@saveReport');
    Route::post('/products', 'Api\ProductController@store')->name('products.store');
});

Route::namespace('Api')->group(function () {
    Route::post('/contract/get-info-by-customer-id', 'ContractController@show')->name('contract.show');
});

