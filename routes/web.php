<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

// Frontend Pages
Route::view('/', 'frontend.pages.index')->name('home');
Route::view('/about', 'frontend.pages.about')->name('about');
Route::match(['get', 'post'], '/winner-list', [BookingController::class, 'winnerList'])->name('winnerlist');
Route::match(['get', 'post'], '/check-result', [BookingController::class, 'winnerList'])->name('check.result');
Route::view('/contact', 'frontend.pages.contact')->name('contact');

// Ticket Booking & Payment Workflow
Route::match(['get', 'post'], '/ticket-booking', [BookingController::class, 'ticketBooking'])->name('ticket.booking');
Route::match(['get', 'post'], '/payment-form', [BookingController::class, 'paymentForm'])->name('payment.form');
Route::match(['get', 'post'], '/qr-payment', [BookingController::class, 'qrShow'])->name('qr.show');
Route::match(['get', 'post'], '/qrshow', [BookingController::class, 'qrShow']);
Route::post('/confirm-booking', [BookingController::class, 'confirmBooking'])->name('booking.confirm');

// General Auth aliases (redirect to admin)
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');

require __DIR__.'/settings.php';
