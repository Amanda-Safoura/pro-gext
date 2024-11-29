<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {

    Route::get('/password-reset', [PasswordResetController::class, 'showResetRequestForm'])->name('password.request');
    Route::post('/password-reset', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/password-reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password-reset/{token}', [PasswordResetController::class, 'resetPassword'])->name('password.update');

    Route::view('/register', 'site.pages.auth.register_page')->name('register_page');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::view('/login', 'site.pages.auth.login_page')->name('login_page');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/verify_email/{token}', [AuthController::class, 'verify_email'])->name('verify-email');
    Route::get('/change-pasword/{origin_hashed}', [AuthController::class, 'change_password_page'])->name('change_password-page');
    Route::post('/change-pasword', [AuthController::class, 'change_password'])->name('change_password');
});



Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [HomeController::class, 'overview'])->name('overview');

    // Gestion des notifications
    Route::name('notifs.')->group(function () {
        Route::get('/notifs', [NotifController::class, 'showNotifs'])->name('index');
        Route::get('/notifs/datas', [NotifController::class, 'getNotifsData'])->name('datas');
        Route::post('/notifs/change_read_status', [NotifController::class, 'bulkUpdate'])->name('change-read-status');
    });

    Route::resource('/projects', ProjectController::class);
    Route::resource('/tasks', TaskController::class);


    // Gestion des comptes utilisateurs
    Route::name('admin.')->middleware('admin')->group(function () {
        Route::get('/user_accounts', [UserController::class, 'index'])->name('user_accounts.index');
        Route::get('/user_accounts/fetch_all', [UserController::class, 'fetch_all'])->name('user_accounts.fetch_all');
        Route::post('/user_accounts/change-role', [UserController::class, 'change_role'])->name('user_accounts.change_role');
    });
});
