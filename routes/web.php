<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubdomainController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Wildcard Subdomain Routing for Showcase Platform
| - Main domain (showcase.test): Landing page & admin
| - Subdomain (*.showcase.test): Application detail pages
|
*/

$domain = env('APP_DOMAIN', 'showcase.test');

// =====================================================
// SUBDOMAIN ROUTES - *.showcase.test
// =====================================================
Route::domain('{subdomain}.' . $domain)
    ->middleware(['web', 'subdomain'])
    ->group(function () {
        Route::get('/', [SubdomainController::class, 'show'])->name('subdomain.show');
    });

// =====================================================
// MAIN DOMAIN ROUTES - showcase.test
// =====================================================

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/apps/{slug}', [HomeController::class, 'show'])->name('app.show');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')
    ->middleware('auth');

// =====================================================
// ADMIN ROUTES (authenticated + admin role)
// =====================================================
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Applications CRUD
        Route::resource('applications', ApplicationController::class)->except(['show']);
        Route::post('applications/{application}/toggle-featured', [ApplicationController::class, 'toggleFeatured'])
            ->name('applications.toggle-featured');
        Route::delete('screenshots/{id}', [ApplicationController::class, 'deleteScreenshot'])
            ->name('screenshots.destroy');

        // Categories CRUD
        Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);
    });
