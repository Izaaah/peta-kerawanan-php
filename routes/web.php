<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\PenyalahgunaanController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\DataIndividuTskController;
use App\Http\Controllers\LsmController;
use App\Http\Controllers\MedsosController;
use App\Http\Controllers\PenjualVapeController;
use App\Http\Controllers\PerusahaanFarmasiPrekursorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

    Route::get('/lsm', [LsmController::class, 'index'])->name('data.lsm.index');
    Route::get('/lsm/create', [LsmController::class, 'create'])->name('data.lsm.create');
    Route::get('/lsm/{id}', [LsmController::class, 'show'])->name('data.lsm.show');
    Route::post('/lsm/store', [LsmController::class, 'store'])->name('data.lsm.store');

    Route::get('/data-desa', [DataDesaController::class, 'index'])->name('data.desa');
    Route::get('/api/desa-data', [DataDesaController::class, 'getData'])->name('api.desa.data');
    Route::get('/api/desa-detail/{id}', [DataDesaController::class, 'detail'])->name('api.desa.detail');
    Route::get('/api/desa-export', [DataDesaController::class, 'export'])->name('api.desa.export');
    Route::get('/api/kabupaten-list', [DataDesaController::class, 'getKabupatenList'])->name('api.kabupaten.list');
    Route::get('/api/kecamatan-list', [DataDesaController::class, 'getKecamatanList'])->name('api.kecamatan.list');

    Route::get('/medsos', [MedsosController::class, 'index'])->name('data.medsos.index');
    Route::get('/medsos/create', [MedsosController::class, 'create'])->name('data.medsos.create');
    Route::post('/medsos', [MedsosController::class, 'store'])->name('data.medsos.store');
    Route::get('/medsos/{id}', [MedsosController::class, 'show'])->name('data.medsos.show');
    Route::get('/medsos/{id}/edit', [MedsosController::class, 'edit'])->name('data.medsos.edit');
    Route::put('/medsos/{id}', [MedsosController::class, 'update'])->name('data.medsos.update');
    Route::delete('/medsos/{id}', [MedsosController::class, 'destroy'])->name('data.medsos.destroy');

    Route::get('/vape', [PenjualVapeController::class, 'index'])->name('data.vape.index');
    Route::get('/vape/create', [PenjualVapeController::class, 'create'])->name('data.vape.create');
    Route::post('/vape', [PenjualVapeController::class, 'store'])->name('data.vape.store');
    Route::get('/vape/{id}', [PenjualVapeController::class, 'show'])->name('data.vape.show');
    Route::get('/vape/{id}/edit', [PenjualVapeController::class, 'edit'])->name('data.vape.edit');
    Route::put('/vape/{id}', [PenjualVapeController::class, 'update'])->name('data.vape.update');
    Route::delete('/vape/{id}', [PenjualVapeController::class, 'destroy'])->name('data.vape.destroy');

    Route::get('/farmasi', [PerusahaanFarmasiPrekursorController::class, 'index'])->name('data.farmasi.index');
    Route::get('/farmasi/create', [PerusahaanFarmasiPrekursorController::class, 'create'])->name('data.farmasi.create');
    Route::post('/farmasi', [PerusahaanFarmasiPrekursorController::class, 'store'])->name('data.farmasi.store');
    Route::get('/farmasi/{id}', [PerusahaanFarmasiPrekursorController::class, 'show'])->name('data.farmasi.show');
    Route::get('/farmasi/{id}/edit', [PerusahaanFarmasiPrekursorController::class, 'edit'])->name('data.farmasi.edit');
    Route::put('/farmasi/{id}', [PerusahaanFarmasiPrekursorController::class, 'update'])->name('data.farmasi.update');
    Route::delete('/farmasi/{id}', [PerusahaanFarmasiPrekursorController::class, 'destroy'])->name('data.farmasi.destroy');


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

Route::get('/api/kecamatan-list', function (Request $request) {
    $kabupaten = $request->kabupaten;
    $kecamatanList = \App\Models\DesaGeojson::query()
        ->where('kabupaten', $kabupaten)
        ->where('kecamatan', 'not like', '%/%')
        ->where('kecamatan', 'not like', '%area%')
        ->where('kecamatan', 'not like', '%unknown%')
        ->distinct()
        ->pluck('kecamatan')
        ->sort()
        ->values();
    return response()->json($kecamatanList);
});

Route::get('/api/desa-list', function (Request $request) {
    $kabupaten = $request->kabupaten;
    $kecamatan = $request->kecamatan;
    // console.log('Fetch desa-list', kabupaten, kecamatan);
    $desaList = \App\Models\DesaGeojson::query()
        ->where('kabupaten', $kabupaten)
        ->where('kecamatan', $kecamatan)
        ->where('nama_desa', 'not like', '%/%')
        ->where('nama_desa', 'not like', '%area%')
        ->where('nama_desa', 'not like', '%unknown%')
        ->distinct()
        ->pluck('nama_desa')
        ->sort()
        ->values();
    return response()->json($desaList);
});

Route::get('/api/kabupaten-list', function (Request $request) {
    $kabupatenList = \App\Models\DesaGeojson::query()
        ->where('kabupaten', 'not like', '%/%')
        ->where('kabupaten', 'not like', '%area%')
        ->where('kabupaten', 'not like', '%unknown%')
        ->distinct()
        ->pluck('kabupaten')
        ->sort()
        ->values();
    return response()->json($kabupatenList);
});

require __DIR__ . '/auth.php';
