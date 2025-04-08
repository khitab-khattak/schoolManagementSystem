<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[AuthController::class, 'login']);
Route::post('/login',[AuthController::class, 'auth_login']);
Route::get('/forgot',[AuthController::class, 'forgot']);
Route::get('/logout',[AuthController::class, 'logout']);

Route::group(['middleware'=>'common'],function(){
    Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);
});

