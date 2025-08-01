<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\HomeController;

// Home Route (untuk visitor, menampilkan peminjaman hari ini, semua, dan riwayat)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('mobil', MobilController::class);
    Route::resource('bidang', BidangController::class);
    Route::resource('peminjaman', PeminjamanController::class);
});
