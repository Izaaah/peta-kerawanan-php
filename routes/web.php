<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\PenyalahgunaanController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\DataIndividuTskController;
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

    Route::get('/peta', function () {
        return view('super-admin.peta');
    })->name('peta');

    // User Management Routes
    Route::resource('user-management', UserManagementController::class)->parameters([
        'user-management' => 'user'
    ]);

    Route::get('/user-management/export', [UserManagementController::class, 'export'])->name('user-management.export');

    // Data Routes
    Route::get('/data', function () {
        return view('super-admin.data.index');
    })->name('data.index');

    Route::get('/data-individu', [DataIndividuTskController::class, 'index'])->name('data.individu');
    Route::get('/data-individu/create', [DataIndividuTskController::class, 'create'])->name('data.individu.create');
    Route::post('/data-individu', [DataIndividuTskController::class, 'store'])->name('data.individu.store');
    Route::get('/data-individu/{id}', [DataIndividuTskController::class, 'show'])->name('data.individu.show');
    Route::get('/data-individu/{id}/edit', [DataIndividuTskController::class, 'edit'])->name('data.individu.edit');
    Route::put('/data-individu/{id}', [DataIndividuTskController::class, 'update'])->name('data.individu.update');
    Route::delete('/data-individu/{id}', [DataIndividuTskController::class, 'destroy'])->name('data.individu.destroy');
    Route::get('/api/individu-data', [DataIndividuTskController::class, 'getData'])->name('api.individu.data');
    Route::get('/api/individu-export', [DataIndividuTskController::class, 'export'])->name('api.individu.export');

    // Input Routes
    Route::get('/input', function () {
        return view('super-admin.input.index');
    })->name('input.index');

    Route::get('/input-individu', [DataIndividuTskController::class, 'create'])->name('input.individu');

    Route::get('/input-pendukung', function () {
        return view('super-admin.input.pendukung');
    })->name('input.pendukung');

    Route::get('/input-lanjutan', function () {
        return view('super-admin.input.lanjutan');
    })->name('input.lanjutan');

    Route::get('/input-kasus', function () {
        return view('super-admin.input.kasus');
    })->name('input.kasus');

    Route::get('/input-desa', function () {
        return view('super-admin.input.desa');
    })->name('input.desa');

    Route::get('/data-pendukung', function () {
        return view('super-admin.data.pendukung');
    })->name('data.pendukung');

    Route::get('/data-lanjutan', function () {
        return view('super-admin.data.lanjutan');
    })->name('data.lanjutan');

    Route::get('/data-kasus', function () {
        return view('super-admin.data.kasus');
    })->name('data.kasus');

    Route::get('/data-desa', [DataDesaController::class, 'index'])->name('data.desa');
    Route::get('/api/desa-data', [DataDesaController::class, 'getData'])->name('api.desa.data');
    Route::get('/api/desa-detail/{id}', [DataDesaController::class, 'detail'])->name('api.desa.detail');
    Route::get('/api/desa-export', [DataDesaController::class, 'export'])->name('api.desa.export');
    Route::get('/api/kabupaten-list', [DataDesaController::class, 'getKabupatenList'])->name('api.kabupaten.list');
    Route::get('/api/kecamatan-list', [DataDesaController::class, 'getKecamatanList'])->name('api.kecamatan.list');
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

// Desa API Routes
Route::get('/api/desa/stats', [PetaController::class, 'getDesaStats'])->name('api.desa.stats');
Route::get('/api/desa/kabupaten/{kabupaten}', [PetaController::class, 'getDesaByKabupaten'])->name('api.desa.by-kabupaten');
Route::get('/api/desa/{id}', [PetaController::class, 'getDesaDetail'])->name('api.desa.detail');

require __DIR__ . '/auth.php';
