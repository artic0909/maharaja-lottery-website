<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'frontend.pages.index')->name('home');
Route::view('/about', 'frontend.pages.about')->name('about');
Route::view('/winner-list', 'frontend.pages.winnerlist')->name('winnerlist');
Route::view('/contact', 'frontend.pages.contact')->name('contact');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
