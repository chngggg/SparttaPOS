<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\CategoryController;

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Rute yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {

    // Profile routes
    Route::get('/profile', [UserManagementController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserManagementController::class, 'updateProfile'])->name('profile.update');

    // User management routes (hanya admin)
    Route::middleware(['role:super_admin,admin'])->prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index');
        Route::get('/create', [UserManagementController::class, 'create'])->name('create');
        Route::post('/', [UserManagementController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserManagementController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserManagementController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/toggle-active', [UserManagementController::class, 'toggleActive'])->name('toggle-active');
    });


    // Sparepart Management
    Route::middleware(['role:super_admin,admin'])->prefix('spareparts')->name('spareparts.')->group(function () {
        Route::get('/', [SparepartController::class, 'index'])->name('index');
        Route::get('/create', [SparepartController::class, 'create'])->name('create');
        Route::post('/', [SparepartController::class, 'store'])->name('store');
        Route::get('/{sparepart:slug}', [SparepartController::class, 'show'])->name('show');
        Route::get('/{sparepart}/edit', [SparepartController::class, 'edit'])->name('edit');
        Route::put('/{sparepart}', [SparepartController::class, 'update'])->name('update');
        Route::delete('/{sparepart}', [SparepartController::class, 'destroy'])->name('destroy');
        Route::get('/{sparepart}/barcode', [SparepartController::class, 'generateBarcode'])->name('barcode');
    });

    // Category Management
    Route::middleware(['role:super_admin,admin'])->prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

// Sparepart routes
Route::middleware(['role:super_admin,admin'])->prefix('spareparts')->name('spareparts.')->group(function () {
    Route::get('/', [SparepartController::class, 'index'])->name('index');
    Route::get('/create', [SparepartController::class, 'create'])->name('create');
    Route::post('/', [SparepartController::class, 'store'])->name('store');
    Route::get('/{sparepart:slug}', [SparepartController::class, 'show'])->name('show'); // <-- PASTIKAN INI ADA
    Route::get('/{sparepart}/edit', [SparepartController::class, 'edit'])->name('edit');
    Route::put('/{sparepart}', [SparepartController::class, 'update'])->name('update');
    Route::delete('/{sparepart}', [SparepartController::class, 'destroy'])->name('destroy');
    Route::get('/{sparepart}/barcode', [SparepartController::class, 'generateBarcode'])->name('barcode');
});

// Category routes
Route::middleware(['role:super_admin,admin'])->prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit'); // <-- PASTIKAN INI ADA
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
});

//generate code
Route::middleware(['auth', 'role:super_admin,admin'])->prefix('spareparts')->name('spareparts.')->group(function () {
    Route::get('/', [SparepartController::class, 'index'])->name('index');
    Route::get('/create', [SparepartController::class, 'create'])->name('create');
    Route::post('/', [SparepartController::class, 'store'])->name('store');
    Route::get('/generate-code', [SparepartController::class, 'generateCode'])->name('generate-code'); // <-- TAMBAHKAN INI
    Route::get('/{sparepart:slug}', [SparepartController::class, 'show'])->name('show');
    Route::get('/{sparepart}/edit', [SparepartController::class, 'edit'])->name('edit');
    Route::put('/{sparepart}', [SparepartController::class, 'update'])->name('update');
    Route::delete('/{sparepart}', [SparepartController::class, 'destroy'])->name('destroy');
    Route::get('/{sparepart}/barcode', [SparepartController::class, 'generateBarcode'])->name('barcode');
});

require __DIR__ . '/auth.php';
