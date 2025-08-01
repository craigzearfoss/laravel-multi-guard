<?php

use App\Http\Controllers\User\IndexController;
use App\Models\User;

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');
});
