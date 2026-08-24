<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\VacancyController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/'.SetLocale::DEFAULT_LOCALE);

Route::prefix('{locale}')->middleware('setlocale')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/about/af-pshrdb', fn (string $locale) => app(PageController::class)
        ->staticPage($locale, 'about-af-pshrdb', 'site.nav.about_bureau'))->name('about.bureau');
    Route::get('/about/staff', fn (string $locale) => app(PageController::class)
        ->staticPage($locale, 'about-staff', 'site.nav.about_staff'))->name('about.staff');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

    Route::get('/announcements/{typeSlug}', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{typeSlug}/{slug}', [AnnouncementController::class, 'show'])->name('announcements.show');

    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/services/main', fn (string $locale) => app(PageController::class)
        ->staticPage($locale, 'services-main', 'site.nav.main_services'))->name('services.main');
    Route::get('/services/request', fn (string $locale) => app(PageController::class)
        ->staticPage($locale, 'services-request', 'site.nav.request_service'))->name('services.request');

    Route::get('/vacancies', [VacancyController::class, 'index'])->name('vacancies');
    Route::get('/vacancies/{slug}', [VacancyController::class, 'show'])->name('vacancies.show');

    Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('/documents/{document}/read', [DocumentController::class, 'read'])->name('documents.read');

    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
});
