<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MarklistController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/student-management');
});
Auth::routes(['register' => false]);
Route::get('/login', function () {
    return  redirect('/student');
});

Route::get('/student-management', [HomeController::class, 'index'])->name('student.management.system');
Route::post('/student-management', [LoginController::class, 'login'])->name('login.submit');

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin-panel/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::group(['prefix' => 'student-managements'], function () {
        Route::resource('students', 'StudentController')->except(['create', 'show']);
        Route::resource('marklist', 'MarklistController')->except(['create', 'show']);
    });
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
