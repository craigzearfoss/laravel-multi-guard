<?php

use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\Front\CertificateController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\LinkController;
use App\Http\Controllers\Front\ProjectController;
use App\Http\Controllers\Front\ReadingController;
use App\Http\Controllers\Front\VideoController;
use App\Http\Controllers\User\IndexController as UserIndexController;
use App\Models\User;

use Illuminate\Support\Facades\Route;

Route::get('/register', [IndexController::class, 'register'])->name('register');
Route::post('/register', [IndexController::class, 'register'])->name('register_submit');
Route::get('/verify-email/{token}/{email}', [IndexController::class, 'email_verification'])->name('email_verification');
Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::post('/login', [IndexController::class, 'login'])->name('login_submit');
Route::get('/logout', [IndexController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [IndexController::class, 'forgot_password'])->name('forgot_password');
Route::post('/forgot-password', [IndexController::class, 'forgot_password'])->name('forgot_password_submit');
Route::get('/reset-password/{token}/{email}', [IndexController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}/{email}', [IndexController::class, 'reset_password_submit'])->name('reset_password_submit');

Route::get('/', [UserIndexController::class, 'index'])->name('homepage');
Route::get('/certificate', [CertificateController::class, 'index'])->name('certificate.index');
Route::get('/link', [LinkController::class, 'index'])->name('link.index');
Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
Route::get('/reading', [ReadingController::class, 'index'])->name('reading.index');
Route::get('/video', [VideoController::class, 'index'])->name('video.index');
