<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TicketPriceChartController;
use App\Http\Controllers\Admin\BookingManagementController;

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

    // Bookings & Payment Verification Management
    Route::get('/bookings', [BookingManagementController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/bulk-delete', [BookingManagementController::class, 'bulkDelete'])->name('bookings.bulk_delete');
    Route::post('/bookings/bulk-approve', [BookingManagementController::class, 'bulkApprove'])->name('bookings.bulk_approve');
    Route::post('/bookings/{ref}/approve', [BookingManagementController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{ref}/reject', [BookingManagementController::class, 'reject'])->name('bookings.reject');
    Route::post('/bookings/{ref}/third-prize', [BookingManagementController::class, 'awardThirdPrize'])->name('bookings.award_third_prize');
    Route::post('/bookings/{ref}/update-result', [BookingManagementController::class, 'updateResult'])->name('bookings.update_result');
    Route::delete('/bookings/{ref}', [BookingManagementController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings/delete/{ref}', [BookingManagementController::class, 'destroy'])->name('bookings.delete');

    // Ticket Management & Price Chart Schemes
    Route::get('/tickets', [TicketPriceChartController::class, 'index'])->name('tickets.index');
    Route::post('/tickets', [TicketPriceChartController::class, 'store'])->name('tickets.store');
    Route::delete('/tickets/{id}', [TicketPriceChartController::class, 'destroy'])->name('tickets.destroy');
    Route::post('/tickets/delete/{id}', [TicketPriceChartController::class, 'destroy'])->name('tickets.delete');

    // Admin Settings, UPI Gateways & Profile
    Route::get('/upi-gateways', [SettingController::class, 'upiIndex'])->name('upi.index');
    Route::post('/settings/upi', [SettingController::class, 'updateUpiSettings'])->name('settings.upi');
    Route::post('/settings/upi/reset-qr', [SettingController::class, 'resetUpiQrImage'])->name('settings.upi.reset_qr');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [SettingController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/hero-banner', [SettingController::class, 'updateHeroBanner'])->name('settings.hero');
    Route::post('/settings/hero-banner/reset', [SettingController::class, 'resetHeroBannerImage'])->name('settings.hero.reset');
    Route::post('/settings/footer-contact', [SettingController::class, 'updateFooterContact'])->name('settings.footer');
    Route::post('/settings/social-links', [SettingController::class, 'updateSocialLinks'])->name('settings.social');
});
