<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\UserController;

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/login', [IndexController::class, 'login'])->name('login');
    Route::post('/login', [IndexController::class, 'login'])->name('login_submit');
    Route::get('/logout', [IndexController::class, 'logout'])->name('logout');
    Route::get('/forgot-password', [IndexController::class, 'forgot_password'])->name('forgot_password');
    Route::post('/forgot-password', [IndexController::class, 'forgot_password'])->name('forgot_password_submit');
    Route::get('/reset-password/{token}/{email}', [IndexController::class, 'reset_password'])->name('reset_password');
    Route::post('/reset-password/{token}/{email}', [IndexController::class, 'reset_password_submit'])->name('reset_password_submit');
});

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');
    Route::resource('admin', AdminController::class);
    Route::get('/profile/change-password', [ProfileController::class, 'change_password'])->name('change_password');
    Route::post('/profile/change-password', [ProfileController::class, 'change_password_submit'])->name('change_password_submit');
    Route::get('/profile', [ProfileController::class, 'show'])->name('show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('update');
    Route::resource('resource', ResourceController::class);
    Route::resource('user', UserController::class);
    Route::get('/user/{user}/change-password', [UserController::class, 'change_password'])->name('user.change_password');
    Route::post('/user/{user}/change-password', [UserController::class, 'change_password_submit'])->name('user.change_password_submit');
    Route::resource('video', PortfolioVideoController::class);
});
