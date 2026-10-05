<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
| These routes are loaded by bootstrap/app.php with prefix 'admin'
| and name prefix 'admin.'.
|
*/

// Guest Admin Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Authenticated Admin Dashboard & Operations
Route::middleware('auth')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Settings & Profile
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [SettingController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/hero-banner', [SettingController::class, 'updateHeroBanner'])->name('settings.hero');
    Route::post('/settings/hero-banner/reset', [SettingController::class, 'resetHeroBannerImage'])->name('settings.hero.reset');
    Route::post('/settings/footer-contact', [SettingController::class, 'updateFooterContact'])->name('settings.footer');
    Route::post('/settings/social-links', [SettingController::class, 'updateSocialLinks'])->name('settings.social');
});
