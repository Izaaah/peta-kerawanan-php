<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\PenyalahgunaanController;
use App\Http\Controllers\PetaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Default dashboard route - will redirect based on role
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role.redirect'])->name('dashboard');

// Super Admin Routes
Route::middleware(['auth', 'verified'])->prefix('super-admin')->name('super-admin.')->group(function () {
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/chart-jaringan', function () {
        return view('super-admin.chart-jaringan');
    })->name('chart-jaringan');

    // User Management Routes
    Route::resource('user-management', UserManagementController::class)->parameters([
        'user-management' => 'user'
    ]);

    Route::get('/user-management/export', [UserManagementController::class, 'export'])->name('user-management.export');

    // Data Routes
    Route::get('/data', function () {
        return view('super-admin.data.index');
    })->name('data.index');

    Route::get('/data-individu', function () {
        return view('super-admin.data.individu');
    })->name('data.individu');

    Route::get('/data-pendukung', function () {
        return view('super-admin.data.pendukung');
    })->name('data.pendukung');

    Route::get('/data-lanjutan', function () {
        return view('super-admin.data.lanjutan');
    })->name('data.lanjutan');

    Route::get('/data-kasus', function () {
        return view('super-admin.data.kasus');
    })->name('data.kasus');

    Route::get('/data-desa', function () {
        return view('super-admin.data.desa');
    })->name('data.desa');
});

// Administrator Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

// Operator Routes
Route::middleware(['auth', 'verified'])->prefix('operator')->name('operator.')->group(function () {
    Route::get('/dashboard', function () {
        return view('operator.dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Peta Routes
Route::get('/peta-penyalahgunaan/domisili', function () {
    return view('map');
})->name('peta-penyalahgunaan.domisili');

// GeoJSON API Route
Route::get('/peta-kerawanan', [PetaController::class, 'geojson'])->name('peta.kerawanan');

require __DIR__ . '/auth.php';
