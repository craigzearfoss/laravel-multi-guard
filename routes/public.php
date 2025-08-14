<?php

use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\User\IndexController as UserIndexController;

use Illuminate\Support\Facades\Route;

Route::name('front.')->group(function () {
    Route::get('/', [UserIndexController::class, 'index'])->name('homepage');
    Route::get('/about', [IndexController::class, 'about'])->name('about');
    Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
    Route::get('/privacy-policy', [IndexController::class, 'privacy_policy'])->name('privacy_policy');
    Route::get('/terms-and-conditions', [IndexController::class, 'terms_and_conditions'])->name('terms_and_conditions');
});
