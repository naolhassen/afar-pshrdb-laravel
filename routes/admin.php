<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsArticleController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\VacancyController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('news', NewsArticleController::class)->except('show');
    Route::resource('pages', PageController::class)->except('show');
    Route::resource('announcements', AnnouncementController::class)->except('show');
    Route::resource('vacancies', VacancyController::class)->except('show');
});
