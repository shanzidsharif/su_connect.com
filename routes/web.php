<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

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
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');
    Route::get('admin/list', [AdminController::class, 'adminList']);
    Route::get('admin/list-add', [AdminController::class, 'addAdmin'])->name('add');
    Route::post('admin/list-add', [AdminController::class, 'postAddAdmin'])->name('admin.add');
    Route::get('admin/list-edit/{id}', [AdminController::class, 'adminEdit'])->name('edit.admin');
    Route::post('admin/list-update/{id}', [AdminController::class, 'updateAdmin'])->name('update.admin');
    Route::get('admin/list-delete/{id}', [AdminController::class, 'adminDelete'])->name('delete.admin');
    Route::get('admin/list/search', [AdminController::class, 'search'])->name('search');
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
