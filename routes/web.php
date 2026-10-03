<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::view('/', 'frontend.pages.index')->name('home');
Route::view('/about', 'frontend.pages.about')->name('about');
Route::view('/winner-list', 'frontend.pages.winnerlist')->name('winnerlist');
Route::view('/contact', 'frontend.pages.contact')->name('contact');

// Ticket Booking & Payment Workflow
Route::match(['get', 'post'], '/ticket-booking', [BookingController::class, 'ticketBooking'])->name('ticket.booking');
Route::match(['get', 'post'], '/payment-form', [BookingController::class, 'paymentForm'])->name('payment.form');
Route::match(['get', 'post'], '/qr-payment', [BookingController::class, 'qrShow'])->name('qr.show');
Route::match(['get', 'post'], '/qrshow', [BookingController::class, 'qrShow']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

