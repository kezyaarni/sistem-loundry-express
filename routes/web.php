<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// ===== HALAMAN PUBLIK (PELANGGAN) =====
Route::get('/', [OrderController::class, 'index'])->name('home');
Route::post('/pesan', [OrderController::class, 'store'])
    ->middleware('throttle:10,1') // maksimal 10 pesanan per menit per pengunjung
    ->name('orders.store');

// ===== HALAMAN ADMIN (WAJIB LOGIN) =====
Route::middleware('auth')->group(function () {
    // nama 'dashboard' dipakai Breeze untuk mengarahkan admin setelah login
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::patch('orders/{order}/status', [OrderStatusController::class, 'update'])->name('orders.status');
    });
});

require __DIR__.'/auth.php'; 
