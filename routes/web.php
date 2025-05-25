<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\ImageController as AdminImageController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\NotificationController as AdminNotificationController;

// Halaman utama (Redirect ke login)
Route::get('/', function () {
    return view('login');
});

// Routes untuk User
Route::prefix('account')->group(function () {
    // Guest Middleware (User yang belum login)
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('process-register', [LoginController::class, 'processregister'])->name('account.processregister');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    });

    // Auth Middleware (User yang sudah login)
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');

        // Route Pemesanan
        Route::get('memesan', [OrderController::class, 'index'])->name('account.memesan.index');
        Route::post('memesan', [OrderController::class, 'store'])->name('account.memesan.store');
    });
});

// Routes untuk Admin
Route::prefix('admin')->group(function () {
    // Guest Middleware (Admin yang belum login)
    Route::middleware('admin.guest')->group(function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    // Auth Middleware (Admin yang sudah login)
    Route::middleware('admin.auth')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        // CRUD Gambar Admin
        Route::resource('images', AdminImageController::class)->names([
            'index'   => 'admin.images.index',
            'create'  => 'admin.images.create',
            'store'   => 'admin.images.store',
            'edit'    => 'admin.images.edit',
            'update'  => 'admin.images.update',
            'destroy' => 'admin.images.destroy',
            'show'    => 'admin.images.show',
        ]);

        // CRUD Notifikasi Admin
        Route::resource('notif', AdminNotificationController::class)->names([
            'index'   => 'admin.notif.index',
            'create'  => 'admin.notif.create',
            'store'   => 'admin.notif.store',
            'edit'    => 'admin.notif.edit',
            'update'  => 'admin.notif.update',
            'destroy' => 'admin.notif.destroy',
            'show'    => 'admin.notif.show',
        ]);
    });
});
