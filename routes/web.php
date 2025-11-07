<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');

// Admin access route
Route::get('/admin', function () {
    if (auth()->check() && auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return view('admin.login');
})->name('admin');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Room routes
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

    // Booking routes
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::get('/create', [BookingController::class, 'create'])->name('create');
        Route::post('/', [BookingController::class, 'store'])->name('store');
        Route::get('/{booking}', [BookingController::class, 'show'])->name('show');
        Route::patch('/{booking}/cancel', [BookingController::class, 'cancel'])->name('cancel');
        Route::get('/api/available-slots', [BookingController::class, 'getAvailableSlots'])->name('api.available-slots');
    });
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Bookings management
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::patch('/bookings/{booking}/cancel', [AdminController::class, 'cancelBooking'])->name('bookings.cancel');
    
    // Blocks management
    Route::get('/blocks', [AdminController::class, 'blocks'])->name('blocks');
    Route::get('/blocks/create', [AdminController::class, 'createBlock'])->name('blocks.create');
    Route::post('/blocks', [AdminController::class, 'storeBlock'])->name('blocks.store');
    Route::delete('/blocks/{block}', [AdminController::class, 'destroyBlock'])->name('blocks.destroy');
    
    // Room management
    Route::resource('rooms', \App\Http\Controllers\Admin\RoomManagementController::class);
    Route::patch('/rooms/{room}/toggle-status', [\App\Http\Controllers\Admin\RoomManagementController::class, 'toggleStatus'])->name('rooms.toggle-status');
    
    // Statistics
    Route::get('/statistics', [AdminController::class, 'roomStatistics'])->name('statistics');
});
