<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SendMailController;

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
Route::get('/reset', [AuthController::class, 'resetPassword']);


// Admin Middleware
Route::group(['middleware' => 'admin'], function ()
{
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');
    Route::get('admin/list', [DashboardController::class, 'adminList']);

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
