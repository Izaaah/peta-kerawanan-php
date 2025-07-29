<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\operator\OperatorDashboardController;
use App\Http\Controllers\PenyalahgunaanController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\DataDesaController;
use App\Http\Controllers\DataIndividuTskController;
use App\Http\Controllers\admin\DataIndividuTskAdminController;
use App\Http\Controllers\operator\DataIndividuTskOperatorController;
use App\Http\Controllers\LsmController;
use App\Http\Controllers\admin\LsmAdminController;
use App\Http\Controllers\operator\LsmOperatorController;
use App\Http\Controllers\MedsosController;
use App\Http\Controllers\admin\MedsosAdminController;
use App\Http\Controllers\operator\MedsosOperatorController;
use App\Http\Controllers\PenjualVapeController;
use App\Http\Controllers\admin\PenjualVapeAdminController;
use App\Http\Controllers\operator\PenjualVapeOperatorController;
use App\Http\Controllers\PerusahaanFarmasiPrekursorController;
use App\Http\Controllers\admin\PerusahaanFarmasiPrekursorAdminController;
use App\Http\Controllers\operator\PerusahaanFarmasiPrekursorOperatorController;
use App\Http\Controllers\TransportasiController;
use App\Http\Controllers\admin\TransportasiAdminController;
use App\Http\Controllers\operator\TransportasiOperatorController;
use App\Http\Controllers\ObjekVitalController;
use App\Http\Controllers\admin\ObjekVitalAdminController;
use App\Http\Controllers\operator\ObjekVitalOperatorController;
use App\Http\Controllers\PenginapanController;
use App\Http\Controllers\admin\PenginapanAdminController;
use App\Http\Controllers\operator\PenginapanOperatorController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\admin\EkspedisiAdminController;
use App\Http\Controllers\operator\EkspedisiOperatorController;
use App\Http\Controllers\LembagaRehabilitasiController;
use App\Http\Controllers\admin\LembagaRehabilitasiAdminController;
use App\Http\Controllers\operator\LembagaRehabilitasiOperatorController;
use App\Http\Controllers\JaringanRutanLapasController;
use App\Http\Controllers\admin\JaringanRutanLapasAdminController;
use App\Http\Controllers\operator\JaringanRutanLapasOperatorController;
use App\Http\Controllers\PenggiatNarkotikaController;
use App\Http\Controllers\admin\PenggiatNarkotikaAdminController;
use App\Http\Controllers\operator\PenggiatNarkotikaOperatorController;
use App\Http\Controllers\ThmController;
use App\Http\Controllers\admin\ThmAdminController;
use App\Http\Controllers\operator\ThmOperatorController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



// Route::get('/', function () {
//     return view('welcome');
// });

// routes/web.php

Route::get('/', function (Request $request) {
    DB::table('page_views')->insert([
        'ip_address' => $request->ip(),
        'user_agent' => $request->userAgent(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    return response()->file(resource_path('views/index.blade.php'));
});

Route::get('/tentang', function () {
    return response()->file(resource_path('views/loginpage/tentang.html'));
});

Route::get('/peta', function () {
    return response()->file(resource_path('views/loginpage/peta.html'));
});

Route::get('/statistik', function () {
    return response()->file(resource_path('views/loginpage/statistik.html'));
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

    Route::get('/input-transportasi', function () {
        return view('super-admin.input.transportasi');
    })->name('input.transportasi');

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
    Route::put('/lsm/{id}', [LsmController::class, 'update'])->name('data.lsm.update');
    Route::delete('/lsm/{id}', [LsmController::class, 'destroy'])->name('data.lsm.destroy');
    Route::get('/lsm/{id}/edit', [LsmController::class, 'edit'])->name('data.lsm.edit');

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

    Route::get('/transportasi', [TransportasiController::class, 'index'])->name('data.transportasi.index');
    Route::get('/transportasi/create', [TransportasiController::class, 'create'])->name('data.transportasi.create');
    Route::post('/transportasi', [TransportasiController::class, 'store'])->name('data.transportasi.store');
    Route::get('/transportasi/{id}', [TransportasiController::class, 'show'])->name('data.transportasi.show');
    Route::get('/transportasi/{id}/edit', [TransportasiController::class, 'edit'])->name('data.transportasi.edit');
    Route::put('/transportasi/{id}', [TransportasiController::class, 'update'])->name('data.transportasi.update');
    Route::delete('/transportasi/{id}', [TransportasiController::class, 'destroy'])->name('data.transportasi.destroy');

    Route::get('/penginapan', [PenginapanController::class, 'index'])->name('data.penginapan.index');
    Route::get('/penginapan/create', [PenginapanController::class, 'create'])->name('data.penginapan.create');
    Route::post('/penginapan', [PenginapanController::class, 'store'])->name('data.penginapan.store');
    Route::get('/penginapan/{id}', [PenginapanController::class, 'show'])->name('data.penginapan.show');
    Route::get('/penginapan/{id}/edit', [PenginapanController::class, 'edit'])->name('data.penginapan.edit');
    Route::put('/penginapan/{id}', [PenginapanController::class, 'update'])->name('data.penginapan.update');
    Route::delete('/penginapan/{id}', [PenginapanController::class, 'destroy'])->name('data.penginapan.destroy');

    Route::get('/ekspedisi', [EkspedisiAdminController::class, 'index'])->name('data.ekspedisi.index');
    Route::get('/ekspedisi/create', [EkspedisiAdminController::class, 'create'])->name('data.ekspedisi.create');
    Route::post('/ekspedisi', [EkspedisiAdminController::class, 'store'])->name('data.ekspedisi.store');
    Route::get('/ekspedisi/{id}', [EkspedisiAdminController::class, 'show'])->name('data.ekspedisi.show');
    Route::get('/ekspedisi/{id}/edit', [EkspedisiAdminController::class, 'edit'])->name('data.ekspedisi.edit');
    Route::put('/ekspedisi/{id}', [EkspedisiAdminController::class, 'update'])->name('data.ekspedisi.update');
    Route::delete('/ekspedisi/{id}', [EkspedisiAdminController::class, 'destroy'])->name('data.ekspedisi.destroy');

    Route::get('/objekvital', [objekvitalController::class, 'index'])->name('data.objekvital.index');
    Route::get('/objekvital/create', [objekvitalController::class, 'create'])->name('data.objekvital.create');
    Route::post('/objekvital', [objekvitalController::class, 'store'])->name('data.objekvital.store');
    Route::get('/objekvital/{id}', [objekvitalController::class, 'show'])->name('data.objekvital.show');
    Route::get('/objekvital/{id}/edit', [objekvitalController::class, 'edit'])->name('data.objekvital.edit');
    Route::put('/objekvital/{id}', [objekvitalController::class, 'update'])->name('data.objekvital.update');
    Route::delete('/objekvital/{id}', [objekvitalController::class, 'destroy'])->name('data.objekvital.destroy');

    Route::get('/lrehab', [LembagaRehabilitasiController::class, 'index'])->name('data.lrehab.index');
    Route::get('/lrehab/create', [LembagaRehabilitasiController::class, 'create'])->name('data.lrehab.create');
    Route::post('/lrehab', [LembagaRehabilitasiController::class, 'store'])->name('data.lrehab.store');
    Route::get('/lrehab/{id}', [LembagaRehabilitasiController::class, 'show'])->name('data.lrehab.show');
    Route::get('/lrehab/{id}/edit', [LembagaRehabilitasiController::class, 'edit'])->name('data.lrehab.edit');
    Route::put('/lrehab/{id}', [LembagaRehabilitasiController::class, 'update'])->name('data.lrehab.update');
    Route::delete('/lrehab/{id}', [LembagaRehabilitasiController::class, 'destroy'])->name('data.lrehab.destroy');

    Route::get('/rutanlapas', [JaringanRutanLapasController::class, 'index'])->name('data.rutanlapas.index');
    Route::get('/rutanlapas/create', [JaringanRutanLapasController::class, 'create'])->name('data.rutanlapas.create');
    Route::post('/rutanlapas', [JaringanRutanLapasController::class, 'store'])->name('data.rutanlapas.store');
    Route::get('/rutanlapas/{id}', [JaringanRutanLapasController::class, 'show'])->name('data.rutanlapas.show');
    Route::get('/rutanlapas/{id}/edit', [JaringanRutanLapasController::class, 'edit'])->name('data.rutanlapas.edit');
    Route::put('/rutanlapas/{id}', [JaringanRutanLapasController::class, 'update'])->name('data.rutanlapas.update');
    Route::delete('/rutanlapas/{id}', [JaringanRutanLapasController::class, 'destroy'])->name('data.rutanlapas.destroy');

    Route::get('penggiat/', [PenggiatNarkotikaController::class, 'index'])->name('data.penggiat.index');
    Route::get('penggiat/create', [PenggiatNarkotikaController::class, 'create'])->name('data.penggiat.create');
    Route::post('penggiat/', [PenggiatNarkotikaController::class, 'store'])->name('data.penggiat.store');
    Route::get('penggiat/{id}', [PenggiatNarkotikaController::class, 'show'])->name('data.penggiat.show');
    Route::get('penggiat/{id}/edit', [PenggiatNarkotikaController::class, 'edit'])->name('data.penggiat.edit');
    Route::put('penggiat/{id}', [PenggiatNarkotikaController::class, 'update'])->name('data.penggiat.update');
    Route::delete('/penggiat/{id}', [PenggiatNarkotikaController::class, 'destroy'])->name('data.penggiat.destroy');

    Route::get('thm/', [ThmController::class, 'index'])->name('data.thm.index');
    Route::get('thm/create', [ThmController::class, 'create'])->name('data.thm.create');
    Route::post('thm/', [ThmController::class, 'store'])->name('data.thm.store');
    Route::get('thm/{id}', [ThmController::class, 'show'])->name('data.thm.show');
    Route::get('thm/{id}/edit', [ThmController::class, 'edit'])->name('data.thm.edit');
    Route::put('thm/{id}', [ThmController::class, 'update'])->name('data.thm.update');
    Route::delete('/thm/{id}', [ThmController::class, 'destroy'])->name('data.thm.destroy');

    // Route untuk verifikasi perubahan data
    Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
    Route::get('/verification/{id}', [VerificationController::class, 'show'])->name('verification.show');
    Route::post('/verification/{id}/approve', [VerificationController::class, 'approve'])->name('verification.approve');
    Route::post('/verification/{id}/reject', [VerificationController::class, 'reject'])->name('verification.reject');

});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/chart-jaringan', function () {
        return view('admin.chart-jaringan');
    })->name('chart-jaringan');

    Route::get('/peta', function () {
        return view('admin.peta');
    })->name('peta');

    // User Management Routes
    Route::resource('user-management', UserManagementController::class)->parameters([
        'user-management' => 'user'
    ]);

    // Data Routes
    Route::get('/data', function () {
        return view('admin.data.index');
    })->name('data.index');

    Route::get('/data-individu', [DataIndividuTskAdminController::class, 'index'])->name('data.individu');
    Route::get('/data-individu/create', [DataIndividuTskAdminController::class, 'create'])->name('data.individu.create');
    Route::post('/data-individu', [DataIndividuTskAdminController::class, 'store'])->name('data.individu.store');
    Route::get('/data-individu/{id}', [DataIndividuTskAdminController::class, 'show'])->name('data.individu.show');
    Route::get('/data-individu/{id}/edit', [DataIndividuTskAdminController::class, 'edit'])->name('data.individu.edit');
    Route::put('/data-individu/{id}', [DataIndividuTskAdminController::class, 'update'])->name('data.individu.update');
    Route::delete('/data-individu/{id}', [DataIndividuTskAdminController::class, 'destroy'])->name('data.individu.destroy');
    Route::get('/api/individu-data', [DataIndividuTskAdminController::class, 'getData'])->name('api.individu.data');
    Route::get('/api/individu-export', [DataIndividuTskAdminController::class, 'export'])->name('api.individu.export');

    Route::get('/data-desa', [DataDesaController::class, 'index'])->name('data.desa');
    Route::get('/api/desa-data', [DataDesaController::class, 'getData'])->name('api.desa.data');
    Route::get('/api/desa-detail/{id}', [DataDesaController::class, 'detail'])->name('api.desa.detail');
    Route::get('/api/desa-export', [DataDesaController::class, 'export'])->name('api.desa.export');
    Route::get('/api/kabupaten-list', [DataDesaController::class, 'getKabupatenList'])->name('api.kabupaten.list');
    Route::get('/api/kecamatan-list', [DataDesaController::class, 'getKecamatanList'])->name('api.kecamatan.list');

    Route::get('/lsm', [LsmAdminController::class, 'index'])->name('data.lsm.index');
    Route::get('/lsm/create', [LsmAdminController::class, 'create'])->name('data.lsm.create');
    Route::get('/lsm/{id}', [LsmAdminController::class, 'show'])->name('data.lsm.show');
    Route::post('/lsm/store', [LsmAdminController::class, 'store'])->name('data.lsm.store');
    Route::put('/lsm/{id}', [LsmAdminController::class, 'update'])->name('data.lsm.update');
    Route::delete('/lsm/{id}', [LsmAdminController::class, 'destroy'])->name('data.lsm.destroy');
    Route::get('/lsm/{id}/edit', [LsmAdminController::class, 'edit'])->name('data.lsm.edit');
    Route::post('/lsm/import', [LsmAdminController::class, 'import'])->name('data.lsm.import');

    Route::get('/medsos', [MedsosAdminController::class, 'index'])->name('data.medsos.index');
    Route::get('/medsos/create', [MedsosAdminController::class, 'create'])->name('data.medsos.create');
    Route::post('/medsos', [MedsosAdminController::class, 'store'])->name('data.medsos.store');
    Route::get('/medsos/{id}', [MedsosAdminController::class, 'show'])->name('data.medsos.show');
    Route::get('/medsos/{id}/edit', [MedsosAdminController::class, 'edit'])->name('data.medsos.edit');
    Route::put('/medsos/{id}', [MedsosAdminController::class, 'update'])->name('data.medsos.update');
    Route::delete('/medsos/{id}', [MedsosAdminController::class, 'destroy'])->name('data.medsos.destroy');

    Route::get('/vape', [PenjualVapeAdminController::class, 'index'])->name('data.vape.index');
    Route::get('/vape/create', [PenjualVapeAdminController::class, 'create'])->name('data.vape.create');
    Route::post('/vape', [PenjualVapeAdminController::class, 'store'])->name('data.vape.store');
    Route::get('/vape/{id}', [PenjualVapeAdminController::class, 'show'])->name('data.vape.show');
    Route::get('/vape/{id}/edit', [PenjualVapeAdminController::class, 'edit'])->name('data.vape.edit');
    Route::put('/vape/{id}', [PenjualVapeAdminController::class, 'update'])->name('data.vape.update');
    Route::delete('/vape/{id}', [PenjualVapeAdminController::class, 'destroy'])->name('data.vape.destroy');

    Route::get('/farmasi', [PerusahaanFarmasiPrekursorAdminController::class, 'index'])->name('data.farmasi.index');
    Route::get('/farmasi/create', [PerusahaanFarmasiPrekursorAdminController::class, 'create'])->name('data.farmasi.create');
    Route::post('/farmasi', [PerusahaanFarmasiPrekursorAdminController::class, 'store'])->name('data.farmasi.store');
    Route::get('/farmasi/{id}', [PerusahaanFarmasiPrekursorAdminController::class, 'show'])->name('data.farmasi.show');
    Route::get('/farmasi/{id}/edit', [PerusahaanFarmasiPrekursorAdminController::class, 'edit'])->name('data.farmasi.edit');
    Route::put('/farmasi/{id}', [PerusahaanFarmasiPrekursorAdminController::class, 'update'])->name('data.farmasi.update');
    Route::delete('/farmasi/{id}', [PerusahaanFarmasiPrekursorAdminController::class, 'destroy'])->name('data.farmasi.destroy');

    Route::get('/objekvital', [objekvitalAdminController::class, 'index'])->name('data.objekvital.index');
    Route::get('/objekvital/create', [objekvitalAdminController::class, 'create'])->name('data.objekvital.create');
    Route::post('/objekvital', [objekvitalAdminController::class, 'store'])->name('data.objekvital.store');
    Route::get('/objekvital/{id}', [objekvitalAdminController::class, 'show'])->name('data.objekvital.show');
    Route::get('/objekvital/{id}/edit', [objekvitalAdminController::class, 'edit'])->name('data.objekvital.edit');
    Route::put('/objekvital/{id}', [objekvitalAdminController::class, 'update'])->name('data.objekvital.update');
    Route::delete('/objekvital/{id}', [objekvitalAdminController::class, 'destroy'])->name('data.objekvital.destroy');

    Route::get('penggiat/', [PenggiatNarkotikaAdminController::class, 'index'])->name('data.penggiat.index');
    Route::get('penggiat/create', [PenggiatNarkotikaAdminController::class, 'create'])->name('data.penggiat.create');
    Route::post('penggiat/', [PenggiatNarkotikaAdminController::class, 'store'])->name('data.penggiat.store');
    Route::get('penggiat/{id}', [PenggiatNarkotikaAdminController::class, 'show'])->name('data.penggiat.show');
    Route::get('penggiat/{id}/edit', [PenggiatNarkotikaAdminController::class, 'edit'])->name('data.penggiat.edit');
    Route::put('penggiat/{id}', [PenggiatNarkotikaAdminController::class, 'update'])->name('data.penggiat.update');
    Route::delete('/penggiat/{id}', [PenggiatNarkotikaAdminController::class, 'destroy'])->name('data.penggiat.destroy');

    Route::get('/lrehab', [LembagaRehabilitasiAdminController::class, 'index'])->name('data.lrehab.index');
    Route::get('/lrehab/create', [LembagaRehabilitasiAdminController::class, 'create'])->name('data.lrehab.create');
    Route::post('/lrehab', [LembagaRehabilitasiAdminController::class, 'store'])->name('data.lrehab.store');
    Route::get('/lrehab/{id}', [LembagaRehabilitasiAdminController::class, 'show'])->name('data.lrehab.show');
    Route::get('/lrehab/{id}/edit', [LembagaRehabilitasiAdminController::class, 'edit'])->name('data.lrehab.edit');
    Route::put('/lrehab/{id}', [LembagaRehabilitasiAdminController::class, 'update'])->name('data.lrehab.update');
    Route::delete('/lrehab/{id}', [LembagaRehabilitasiAdminController::class, 'destroy'])->name('data.lrehab.destroy');

    Route::get('/ekspedisi', [EkspedisiAdminController::class, 'index'])->name('data.ekspedisi.index');
    Route::get('/ekspedisi/create', [EkspedisiAdminController::class, 'create'])->name('data.ekspedisi.create');
    Route::post('/ekspedisi', [EkspedisiAdminController::class, 'store'])->name('data.ekspedisi.store');
    Route::get('/ekspedisi/{id}', [EkspedisiAdminController::class, 'show'])->name('data.ekspedisi.show');
    Route::get('/ekspedisi/{id}/edit', [EkspedisiAdminController::class, 'edit'])->name('data.ekspedisi.edit');
    Route::put('/ekspedisi/{id}', [EkspedisiAdminController::class, 'update'])->name('data.ekspedisi.update');
    Route::delete('/ekspedisi/{id}', [EkspedisiAdminController::class, 'destroy'])->name('data.ekspedisi.destroy');

    Route::get('/transportasi', [TransportasiAdminController::class, 'index'])->name('data.transportasi.index');
    Route::get('/transportasi/create', [TransportasiAdminController::class, 'create'])->name('data.transportasi.create');
    Route::post('/transportasi', [TransportasiAdminController::class, 'store'])->name('data.transportasi.store');
    Route::get('/transportasi/{id}', [TransportasiAdminController::class, 'show'])->name('data.transportasi.show');
    Route::get('/transportasi/{id}/edit', [TransportasiAdminController::class, 'edit'])->name('data.transportasi.edit');
    Route::put('/transportasi/{id}', [TransportasiAdminController::class, 'update'])->name('data.transportasi.update');
    Route::delete('/transportasi/{id}', [TransportasiAdminController::class, 'destroy'])->name('data.transportasi.destroy');

    Route::get('/penginapan', [PenginapanAdminController::class, 'index'])->name('data.penginapan.index');
    Route::get('/penginapan/create', [PenginapanAdminController::class, 'create'])->name('data.penginapan.create');
    Route::post('/penginapan', [PenginapanAdminController::class, 'store'])->name('data.penginapan.store');
    Route::get('/penginapan/{id}', [PenginapanAdminController::class, 'show'])->name('data.penginapan.show');
    Route::get('/penginapan/{id}/edit', [PenginapanAdminController::class, 'edit'])->name('data.penginapan.edit');
    Route::put('/penginapan/{id}', [PenginapanAdminController::class, 'update'])->name('data.penginapan.update');
    Route::delete('/penginapan/{id}', [PenginapanAdminController::class, 'destroy'])->name('data.penginapan.destroy');

    Route::get('/rutanlapas', [JaringanRutanLapasAdminController::class, 'index'])->name('data.rutanlapas.index');
    Route::get('/rutanlapas/create', [JaringanRutanLapasAdminController::class, 'create'])->name('data.rutanlapas.create');
    Route::post('/rutanlapas', [JaringanRutanLapasAdminController::class, 'store'])->name('data.rutanlapas.store');
    Route::get('/rutanlapas/{id}', [JaringanRutanLapasAdminController::class, 'show'])->name('data.rutanlapas.show');
    Route::get('/rutanlapas/{id}/edit', [JaringanRutanLapasAdminController::class, 'edit'])->name('data.rutanlapas.edit');
    Route::put('/rutanlapas/{id}', [JaringanRutanLapasAdminController::class, 'update'])->name('data.rutanlapas.update');
    Route::delete('/rutanlapas/{id}', [JaringanRutanLapasAdminController::class, 'destroy'])->name('data.rutanlapas.destroy');

    Route::get('thm/', [ThmAdminController::class, 'index'])->name('data.thm.index');
    Route::get('thm/create', [ThmAdminController::class, 'create'])->name('data.thm.create');
    Route::post('thm/', [ThmAdminController::class, 'store'])->name('data.thm.store');
    Route::get('thm/{id}', [ThmAdminController::class, 'show'])->name('data.thm.show');
    Route::get('thm/{id}/edit', [ThmAdminController::class, 'edit'])->name('data.thm.edit');
    Route::put('thm/{id}', [ThmAdminController::class, 'update'])->name('data.thm.update');
    Route::delete('/thm/{id}', [ThmAdminController::class, 'destroy'])->name('data.thm.destroy');

    // Data Pendukung Routes
    Route::get('/data-pendukung', function () {
        return view('admin.data.pendukung');
    })->name('data.pendukung');
    Route::get('/data-lanjutan', function () {
        return view('admin.data.lanjutan');
    })->name('data.lanjutan');
    Route::get('/data-kasus', function () {
        return view('admin.data.kasus');
    })->name('data.kasus');

    // Input Routes
    Route::get('/input', function () {
        return view('admin.input.index');
    })->name('input.index');
    Route::get('/input-individu', [DataIndividuTskController::class, 'create'])->name('input.individu');
    Route::get('/input-pendukung', function () {
        return view('admin.input.pendukung');
    })->name('input.pendukung');
    Route::get('/input-lanjutan', function () {
        return view('admin.input.lanjutan');
    })->name('input.lanjutan');
    Route::get('/input-kasus', function () {
        return view('admin.input.kasus');
    })->name('input.kasus');
    Route::get('/input-desa', function () {
        return view('admin.input.desa');
    })->name('input.desa');
    // Tambahkan route lain sesuai kebutuhan admin
});

// Operator Routes
Route::middleware(['auth', 'verified'])->prefix('operator')->name('operator.')->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('operator.dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [OperatorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/data', function () {
        return view('operator.data.index');
    })->name('data.index');
    Route::get('/chart-jaringan', function () {
        return view('operator.chart-jaringan');
    })->name('chart-jaringan');

    Route::get('/data-individu', [DataIndividuTskOperatorController::class, 'index'])->name('data.individu');
    Route::get('/data-individu', [DataIndividuTskOperatorController::class, 'index'])->name('data.individu');
    Route::get('/lsm', [LsmOperatorController::class, 'index'])->name('data.lsm.index');
    Route::get('/lsm/{id}', [LsmOperatorController::class, 'show'])->name('data.lsm.show');

    Route::get('/medsos', [MedsosOperatorController::class, 'index'])->name('data.medsos.index');
    Route::get('/medsos/{id}', [MedsosOperatorController::class, 'show'])->name('data.medsos.show');

    Route::get('/vape', [PenjualVapeOperatorController::class, 'index'])->name('data.vape.index');
    Route::get('/vape/{id}', [PenjualVapeOperatorController::class, 'show'])->name('data.vape.show');
    Route::get('/farmasi', [PerusahaanFarmasiPrekursorOperatorController::class, 'index'])->name('data.farmasi.index');
    Route::get('/farmasi/{id}', [PerusahaanFarmasiPrekursorOperatorController::class, 'show'])->name('data.farmasi.show');

    Route::get('/objekvital', [ObjekVitalOperatorController::class, 'index'])->name('data.objekvital.index');
    Route::get('/objekvital/{id}', [ObjekVitalOperatorController::class, 'show'])->name('data.objekvital.show');
    Route::get('/penggiat', [PenggiatNarkotikaOperatorController::class, 'index'])->name('data.penggiat.index');
    Route::get('/penggiat/{id}', [PenggiatNarkotikaOperatorController::class, 'show'])->name('data.penggiat.show');
    Route::get('/lrehab', [LembagaRehabilitasiOperatorController::class, 'index'])->name('data.lrehab.index');
    Route::get('/lrehab/{id}', [LembagaRehabilitasiOperatorController::class, 'show'])->name('data.lrehab.show');
    Route::get('/ekspedisi', [EkspedisiOperatorController::class, 'index'])->name('data.ekspedisi.index');
    Route::get('/ekspedisi/{id}', [EkspedisiOperatorController::class, 'show'])->name('data.ekspedisi.show');

    Route::get('/transportasi', [TransportasiOperatorController::class, 'index'])->name('data.transportasi.index');
    Route::get('/transportasi/{id}', [TransportasiOperatorController::class, 'show'])->name('data.transportasi.show');
    Route::get('/penginapan', [PenginapanOperatorController::class, 'index'])->name('data.penginapan.index');
    Route::get('/penginapan/{id}', [PenginapanOperatorController::class, 'show'])->name('data.penginapan.show');

    Route::get('/rutanlapas', [JaringanRutanLapasOperatorController::class, 'index'])->name('data.rutanlapas.index');
    Route::get('/rutanlapas/{id}', [JaringanRutanLapasOperatorController::class, 'show'])->name('data.rutanlapas.show');
    Route::get('/thm', [ThmOperatorController::class, 'index'])->name('data.thm.index');
    Route::get('/thm/{id}', [ThmOperatorController::class, 'show'])->name('data.thm.show');
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
Route::get('/peta-penyalahgunaan/tkp', function () {
    return view('map_tkp');
})->name('peta-penyalahgunaan.tkp');

// GeoJSON API Route
Route::get('/peta-kerawanan', [PetaController::class, 'geojson'])->name('peta.kerawanan');

// Desa API Routes
Route::get('/api/desa/stats', [PetaController::class, 'getDesaStats'])->name('api.desa.stats');
Route::get('/api/desa/kabupaten/{kabupaten}', [PetaController::class, 'getDesaByKabupaten'])->name('api.desa.by-kabupaten');
Route::get('/api/desa/{id}', [PetaController::class, 'getDesaDetail'])->name('api.desa.detail');
Route::get('/api/kerawanan-stats', [PetaController::class, 'getKerawananStats'])->name('api.kerawanan.stats');

Route::get('/peta-tkp-residivis', function () {
    return view('map-tkp-residivis');
})->name('peta-tkp-residivis');

Route::get('/api/individu-count', [DataIndividuTskController::class, 'getIndividuCount'])->name('api.individu.count');

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

// Route untuk menampilkan halaman learning_pm
Route::get('/learning_pm', function () {
    return view('learning_pm.index');
})->name('learning_pm.index');

require __DIR__ . '/auth.php';
