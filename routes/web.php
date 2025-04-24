<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\SchoolController;
use App\Http\Controllers\backend\SchoolAdminController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\TeacherController;

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

Route::group(['middleware'=>'admin'],function(){
    Route::get('panel/admin/list',[AdminController::class, 'admin_list']);
    Route::get('panel/admin/create',[AdminController::class, 'create_admin']);
    Route::post('panel/admin/create', [AdminController::class, 'insert_admin']);
    Route::get('panel/admin/edit/{id}', [AdminController::class, 'edit_admin']);
    Route::post('panel/admin/edit/{id}', [AdminController::class, 'update_admin']);
    Route::get('panel/admin/delete/{id}', [AdminController::class, 'delete_admin'])->name('admin.delete');


    Route::get('panel/school/list',[SchoolController::class, 'school_list']);
    Route::get('panel/school/create',[SchoolController::class, 'create_school']);
    Route::post('panel/school/create', [SchoolController::class, 'insert_school']);
    Route::get('panel/school/edit/{id}', [SchoolController::class, 'edit_school']);
    Route::post('panel/school/edit/{id}', [SchoolController::class, 'update_school']);
    Route::get('panel/school/delete/{id}', [SchoolController::class, 'delete_school'])->name('school.delete');

});

Route::group(['middleware'=>'school'],function(){
    Route::get('panel/teacher/list',[TeacherController::class, 'teacher_list']);
    Route::get('panel/teacher/create',[TeacherController::class, 'create_teacher']);
    Route::post('panel/teacher/create', [TeacherController::class, 'insert_teacher']);
    Route::get('panel/teacher/edit/{id}', [TeacherController::class, 'edit_teacher']);
    Route::post('panel/teacher/edit/{id}', [TeacherController::class, 'update_teacher']);
    Route::get('panel/teacher/delete/{id}', [TeacherController::class, 'delete_teacher'])->name('teacher.delete');

    Route::get('panel/school_admin/list',[SchoolAdminController::class, 'school_admin_list']);
    Route::get('panel/school_admin/create',[SchoolAdminController::class, 'create_school_admin']);
    Route::post('panel/school_admin/create', [SchoolAdminController::class, 'insert_school_admin']);
    Route::get('panel/school_admin/edit/{id}', [SchoolAdminController::class, 'edit_school_admin']);
    Route::post('panel/school_admin/edit/{id}', [SchoolAdminController::class, 'update_school_admin']);
    Route::get('panel/school_admin/delete/{id}', [SchoolAdminController::class, 'delete_school_admin'])->name('school_school_admin.delete');
});