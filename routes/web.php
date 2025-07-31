<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\PeminjamanController;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.post'); // Tambahkan ini
// Atau bisa juga:
// Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Mobil Routes
    Route::resource('mobil', MobilController::class);

    // Bidang Routes
    Route::resource('bidang', BidangController::class);

    // Peminjaman Routes
    Route::resource('peminjaman', PeminjamanController::class);
});