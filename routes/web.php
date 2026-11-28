<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\JourneyCardController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Protected Panel Routes (Requires Auth & Admin Flag)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard (Redirects to active section manager)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Services Manager
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::post('/services/{service}/toggle', [ServiceController::class, 'toggleStatus'])->name('services.toggle');

    // Hero Slides Manager
    Route::get('/hero-slides', [HeroSlideController::class, 'index'])->name('hero-slides.index');
    Route::post('/hero-slides', [HeroSlideController::class, 'store'])->name('hero-slides.store');
    Route::put('/hero-slides/{heroSlide}', [HeroSlideController::class, 'update'])->name('hero-slides.update');
    Route::delete('/hero-slides/{heroSlide}', [HeroSlideController::class, 'destroy'])->name('hero-slides.destroy');
    Route::post('/hero-slides/{heroSlide}/toggle', [HeroSlideController::class, 'toggleStatus'])->name('hero-slides.toggle');

    // News, Events & Notices Manager
    Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
    Route::post('/notices', [NoticeController::class, 'store'])->name('notices.store');
    Route::put('/notices/{notice}', [NoticeController::class, 'update'])->name('notices.update');
    Route::delete('/notices/{notice}', [NoticeController::class, 'destroy'])->name('notices.destroy');
    Route::post('/notices/{notice}/toggle', [NoticeController::class, 'toggleStatus'])->name('notices.toggle');

    // Capturing Our Journey Bento Cards Manager
    Route::get('/journey-cards', [JourneyCardController::class, 'index'])->name('journey-cards.index');
    Route::post('/journey-cards', [JourneyCardController::class, 'store'])->name('journey-cards.store');
    Route::put('/journey-cards/{journeyCard}', [JourneyCardController::class, 'update'])->name('journey-cards.update');
    Route::delete('/journey-cards/{journeyCard}', [JourneyCardController::class, 'destroy'])->name('journey-cards.destroy');
    Route::post('/journey-cards/{journeyCard}/toggle', [JourneyCardController::class, 'toggleStatus'])->name('journey-cards.toggle');
});
