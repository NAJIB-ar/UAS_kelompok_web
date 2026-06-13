<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
   Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');
    Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show');
    Route::post('/event/{id}/book', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/my-tickets', [BookingController::class, 'index'])->name('booking.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';