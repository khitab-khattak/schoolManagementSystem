<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\SchoolController;
use App\Http\Controllers\backend\SchoolAdminController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\ClassController;
use App\Http\Controllers\backend\StudentController;
use App\Http\Controllers\backend\SubjectController;
use App\Http\Controllers\backend\TeacherController;
use App\Http\Controllers\backend\ParentsController;
use App\Http\Controllers\backend\UserController;


Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('/login',[AuthController::class, 'auth_login'])->name('auth.login');
Route::get('/forgot',[AuthController::class, 'forgot']);
Route::get('/logout',[AuthController::class, 'logout']);
Route::group(['middleware' => 'common'], function () {
    Route::get('panel/change-password',[UserController::class, 'ChangePassword']);
    Route::post('panel/change-password',[UserController::class, 'UpdatePassword']);
    Route::get('panel/my-account',[UserController::class, 'MyAccount']);
    Route::post('panel/my-account/{id}',[UserController::class, 'UpdateAccount']);

});



Route::group(['middleware'=>'admin'],function(){
    //adminH
    Route::get('panel/admin/list',[AdminController::class, 'admin_list']);
    Route::get('panel/admin/create',[AdminController::class, 'create_admin']);
    Route::post('panel/admin/create', [AdminController::class, 'insert_admin']);
    Route::get('panel/admin/edit/{id}', [AdminController::class, 'edit_admin']);
    Route::post('panel/admin/edit/{id}', [AdminController::class, 'update_admin']);
    Route::get('panel/admin/delete/{id}', [AdminController::class, 'delete_admin'])->name('admin.delete');

//school
    Route::get('panel/school/list',[SchoolController::class, 'school_list']);
    Route::get('panel/school/create',[SchoolController::class, 'create_school']);
    Route::post('panel/school/create', [SchoolController::class, 'insert_school']);
    Route::get('panel/school/edit/{id}', [SchoolController::class, 'edit_school']);
    Route::post('panel/school/edit/{id}', [SchoolController::class, 'update_school']);
    Route::get('panel/school/delete/{id}', [SchoolController::class, 'delete_school'])->name('school.delete');

});


    //teachers
    Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);
    Route::get('panel/teacher/list',[TeacherController::class, 'teacher_list']);
    Route::get('panel/teacher/create',[TeacherController::class, 'create_teacher']);
    Route::post('panel/teacher/create', [TeacherController::class, 'insert_teacher']);
    Route::get('panel/teacher/edit/{id}', [TeacherController::class, 'edit_teacher']);
    Route::post('panel/teacher/edit/{id}', [TeacherController::class, 'update_teacher']);
    Route::get('panel/teacher/delete/{id}', [TeacherController::class, 'delete_teacher'])->name('teacher.delete');
//school admin
    Route::get('panel/school_admin/list',[SchoolAdminController::class, 'school_admin_list']);
    Route::get('panel/school_admin/create',[SchoolAdminController::class, 'create_school_admin']);
    Route::post('panel/school_admin/create', [SchoolAdminController::class, 'insert_school_admin']);
    Route::get('panel/school_admin/edit/{id}', [SchoolAdminController::class, 'edit_school_admin']);
    Route::post('panel/school_admin/edit/{id}', [SchoolAdminController::class, 'update_school_admin']);
    Route::get('panel/school_admin/delete/{id}', [SchoolAdminController::class, 'delete_school_admin'])->name('school_school_admin.delete');


    //class
    Route::get('panel/class/list',[ClassController::class, 'class_list']);
    Route::get('panel/class/create',[ClassController::class, 'create_class']);
    Route::post('panel/class/create', [ClassController::class, 'insert_class']);
    Route::get('panel/class/edit/{id}', [ClassController::class, 'edit_class']);
    Route::post('panel/class/edit/{id}', [ClassController::class, 'update_class']);
    Route::get('panel/class/delete/{id}', [ClassController::class, 'delete_class'])->name('class.delete');

    //subjects
    Route::get('panel/subject/list',[SubjectController::class, 'subject_list']);
    Route::get('panel/subject/create',[SubjectController::class, 'create_subject']);
    Route::post('panel/subject/create', [SubjectController::class, 'insert_subject']);
    Route::get('panel/subject/edit/{id}', [SubjectController::class, 'edit_subject']);
    Route::post('panel/subject/edit/{id}', [SubjectController::class, 'update_subject']);
    Route::get('panel/subject/delete/{id}', [SubjectController::class, 'delete_subject'])->name('subject.delete');

//assign subject
    Route::get('panel/assign-subject/list',[SubjectController::class, 'assign_subject_list']);
    Route::get('panel/assign-subject/create',[SubjectController::class, 'create_assign_subject']);
    Route::post('panel/assign-subject/create', [SubjectController::class, 'insert_assign_subject']);
    Route::get('panel/assign-subject/edit/{id}', [SubjectController::class, 'edit_assign_subject']);
    Route::post('panel/assign-subject/edit/{id}', [SubjectController::class, 'update_assign_subject']);
    Route::get('panel/assign-subject/delete/{id}', [SubjectController::class, 'delete_assign_subject']);


    //classtimetable
    Route::get('panel/class-timetable/list',[SubjectController::class, 'class_timetable']);
    Route::post('panel/class-timetable/list',[SubjectController::class, 'submit_class_timetable']);
    Route::post('panel/get-assign-subject-class', [SubjectController::class, 'get_assign_subject_class']);

//students
    Route::get('panel/student/list',[StudentController::class, 'student_list']);
    Route::get('panel/student/create',[StudentController::class, 'create_student']);
    Route::post('panel/student/create', [StudentController::class, 'insert_student']);
    Route::get('panel/student/edit/{id}', [StudentController::class, 'edit_student']);
    Route::post('panel/student/edit/{id}', [StudentController::class, 'update_student']);
    Route::get('panel/student/delete/{id}', [StudentController::class, 'delete_student'])->name('student.delete');
    Route::post('panel/student/getclass', [StudentController::class, 'getClass']);

    //parents
    Route::get('panel/parents/list',[ParentsController::class, 'parents_list']);
    Route::get('panel/parents/create',[ParentsController::class, 'create_parents']);
    Route::post('panel/parents/create', [ParentsController::class, 'insert_parents']);
    Route::get('panel/parents/edit/{id}', [ParentsController::class, 'edit_parents']);
    Route::post('panel/parents/edit/{id}', [ParentsController::class, 'update_parents']);
    Route::get('panel/parents/delete/{id}', [ParentsController::class, 'delete_parents'])->name('parents.delete');
    Route::get('panel/parents/my_student/{id}', [ParentsController::class, 'my_student']);
    Route::get('panel/parents/add_student/{student_id}/{parent_id}', [ParentsController::class, 'add_student']);
    Route::get('panel/parents/mystudent_delete/{student_id}', [ParentsController::class, 'mystudent_delete']);

   

Route::group(['middleware'=>'teacher'], function(){
    Route::get('teacher/dashboard',[DashboardController::class, 'dashboard']);
    Route::get('teacher/change-password',[TeacherController::class, 'ChangePassword']);
    Route::post('teacher/change-password',[TeacherController::class, 'UpdatePassword']);
    Route::get('teacher/my-account',[UserController::class, 'MyAccount']);

    Route::get('teacher/my-account',[TeacherController::class, 'MyAccount']);
    Route::post('teacher/my-account/{id}',[TeacherController::class, 'UpdateAccount']);
});
Route::group(['middleware'=>'student'], function(){
    Route::get('student/dashboard',[DashboardController::class, 'dashboard']);
    Route::get('student/change-password', [StudentController::class, 'ChangePassword']);
    Route::post('student/change-password', [StudentController::class, 'UpdatePassword']);
    Route::get('student/my-account', [StudentController::class, 'myAccount']);
    Route::post('student/my-account/{id}',[StudentController::class, 'UpdateAccount']);
});
Route::group(['middleware'=>'parent'], function(){
    Route::get('parent/dashboard',[DashboardController::class, 'dashboard']);
    Route::get('parent/change-password',[ParentsController::class, 'ChangePassword']);
    Route::post('parent/change-password',[ParentsController::class, 'UpdatePassword']);

    Route::get('parent/my-account',[ParentsController::class, 'MyAccount']);
    Route::post('parent/my-account/{id}',[ParentsController::class, 'UpdateAccount']);
});
