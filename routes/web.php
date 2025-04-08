<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[AuthController::class, 'login']);
Route::get('/forgot',[AuthController::class, 'forgot']);


Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);