<?php

use App\Http\Controllers\HalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HalController::class, 'showLogin'])->name('login');
Route::post('/login', [HalController::class, 'processLogin'])->name('login.process');
Route::get('/logout', [HalController::class, 'logout'])->name('logout');

Route::get('/dashboard', [HalController::class, 'showDashboard'])->name('dashboard');
Route::get('/pengelolaan', [HalController::class, 'showPengelolaan'])->name('pengelolaan');
Route::get('/profile', [HalController::class, 'showProfile'])->name('profile');
