<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('auth.login');
//});
Route::get('/', [AuthController::class, 'login']);
Route::post('/dashboard', [AuthController::class, 'authLogin'])->name('login');
Route::get('/forgot-password', [AuthController::class, 'forget'])->name('forget.password');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset/{token}', [AuthController::class, 'resetPassword']);
Route::post('/reset/{token}', [AuthController::class, 'postResetPassword'])->name('reset.password');


// Admin Middleware
Route::group(['middleware' => 'admin'], function ()
{
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
//    Admin Controller
    Route::get('admin/list', [AdminController::class, 'adminList']);
    Route::get('admin/list-add', [AdminController::class, 'addAdmin'])->name('add');
    Route::post('admin/list-add', [AdminController::class, 'postAddAdmin'])->name('admin.add');
    Route::get('admin/list-edit/{id}', [AdminController::class, 'adminEdit'])->name('edit.admin');
    Route::post('admin/list-update/{id}', [AdminController::class, 'updateAdmin'])->name('update.admin');
    Route::get('admin/list-delete/{id}', [AdminController::class, 'adminDelete'])->name('delete.admin');
    Route::get('admin/list/search', [AdminController::class, 'search'])->name('search');

// Class Controller
    Route::get('admin/class/list', [ClassController::class, 'classList']);
    Route::get('admin/class/list-add', [ClassController::class, 'add'])->name('add.class');
    Route::post('admin/class/list-add', [ClassController::class, 'insert'])->name('insert.class');
    Route::get('admin/class/list-edit/{id}', [ClassController::class, 'edit'])->name('edit.class');
    Route::get('admin/class/list-status/{id}', [ClassController::class, 'status'])->name('status.class');
    Route::post('admin/class/list-update', [ClassController::class, 'update'])->name('update.class');
    Route::get('admin/class/list-delete/{id}', [ClassController::class, 'delete'])->name('delete.class');
    Route::get('admin/class/list/search', [ClassController::class, 'search'])->name('search.class');

// Subject Controller
    Route::get('admin/subject/list', [SubjectController::class, 'subjectList']);
    Route::get('admin/subject/list-add', [SubjectController::class, 'add'])->name('add.subject');
    Route::post('admin/subject/list-add', [SubjectController::class, 'insert'])->name('insert.subject');
    Route::get('admin/subject/list-edit/{id}', [SubjectController::class, 'edit'])->name('edit.subject');
    Route::post('admin/subject/list-update', [SubjectController::class, 'update'])->name('update.subject');
    Route::get('admin/subject/list-delete/{id}', [SubjectController::class, 'delete'])->name('delete.subject');
    Route::get('admin/subject/list/search', [SubjectController::class, 'search'])->name('search.subject');

// Assign Subject Controller
    Route::get('admin/subject-assign/list', [ClassSubjectController::class, 'subjectList']);
    Route::get('admin/subject-assign/list-add', [ClassSubjectController::class, 'add'])->name('add.subject.class');
    Route::post('admin/subject-assign/list-add', [ClassSubjectController::class, 'insert'])->name('insert.subject.class');
    Route::get('admin/subject-assign/list-edit/{id}', [ClassSubjectController::class, 'edit'])->name('edit.subject.class');
    Route::get('admin/subject-assign/list-status/{id}', [ClassSubjectController::class, 'status'])->name('status.subject.class');
    Route::post('admin/subject-assign/list-update', [ClassSubjectController::class, 'update'])->name('update.subject.class');
    Route::get('admin/subject-assign/list-delete/{id}', [ClassSubjectController::class, 'delete'])->name('delete.subject.class');
    Route::get('admin/subject-assign/list/search', [ClassSubjectController::class, 'search'])->name('search.subject.class');

// Student-->Admin
    Route::get('admin/student/list', [StudentController::class, 'adminStudentList']);
    Route::get('admin/student/list-add', [StudentController::class, 'add'])->name('add.admin.student');
    Route::post('admin/student/list-add', [StudentController::class, 'insert'])->name('insert.admin.student');
    Route::get('admin/student/list-status/{id}', [StudentController::class, 'status'])->name('status.admin.student');;
    Route::get('admin/student/list-details/{id}', [StudentController::class, 'details'])->name('details.admin.student');
    Route::get('admin/student/list-edit/{id}', [StudentController::class, 'edit'])->name('edit.admin.student');
    Route::post('admin/student/list-update', [StudentController::class, 'update'])->name('update.admin.student');
    Route::get('admin/student/list-delete/{id}', [StudentController::class, 'delete'])->name('delete.admin.student');
    Route::get('admin/student/list-search', [StudentController::class, 'search'])->name('search.admin.student');

// Lecturer--->Admin
    Route::get('admin/lecturer/list', [LecturerController::class, 'adminLecturerList']);
    Route::get('admin/lecturer/list-add', [LecturerController::class, 'add'])->name('add.admin.lecturer');
    Route::post('admin/lecturer/list-add', [LecturerController::class, 'insert'])->name('insert.admin.lecturer');
    Route::get('admin/lecturer/list-status/{id}', [LecturerController::class, 'status'])->name('status.admin.lecturer');;
    Route::get('admin/lecturer/list-details/{id}', [LecturerController::class, 'details'])->name('details.admin.lecturer');
    Route::get('admin/lecturer/list-edit/{id}', [LecturerController::class, 'edit'])->name('edit.admin.lecturer');
    Route::post('admin/lecturer/list-update', [LecturerController::class, 'update'])->name('update.admin.lecturer');
    Route::get('admin/lecturer/list-delete/{id}', [LecturerController::class, 'delete'])->name('delete.admin.lecturer');
    Route::get('admin/lecturer/list-search', [LecturerController::class, 'search'])->name('search.admin.lecturer');

});

// Lecturer Middleware
Route::group(['middleware' => 'lecturer'], function ()
{
    Route::get('lecturer/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

});

// Student Middleware
Route::group(['middleware' => 'student'], function ()
{
    Route::get('student/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');
});
