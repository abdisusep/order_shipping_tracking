<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::resource('/users', UserController::class);
    });

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    
    Route::get('/tracking', [OrderController::class, 'tracking'])->name('tracking');
    Route::post('/tracking', [OrderController::class, 'trackOrder'])->name('tracking.track');
});