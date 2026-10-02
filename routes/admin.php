<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" and "auth" middleware groups.
|
*/

Route::get('/dashboard', function () {
    return view('dashboard'); // Change this to your actual admin dashboard view
})->name('dashboard');

// Example route for lottery management
// Route::resource('lotteries', App\Http\Controllers\Admin\LotteryController::class);
