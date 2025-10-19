<?php

namespace App\Http\Controllers;

use App\Services\DashboardStatisticsService;
use Illuminate\Http\Request;

/**
 * CONTOH REFACTORED CONTROLLER
 *
 * Bandingkan dengan controller lama yang panjangnya 300+ baris!
 * Sekarang controller jadi CLEAN dan SLIM hanya 30 baris!
 */
class SuperAdminDashboardController_REFACTORED_EXAMPLE extends Controller
{
    /**
     * Constructor dengan Dependency Injection
     * Laravel akan otomatis inject service ini
     */
    public function __construct(
        private DashboardStatisticsService $dashboardService
    ) {}

    /**
     * Display dashboard
     *
     * SEBELUM: 300+ baris logic di controller
     * SETELAH: 3 baris aja! Simple & Clean!
     */
    public function index()
    {
        // Ambil semua statistik dari service (1 line!)
        $stats = $this->dashboardService->getAllStatistics();

        // Extract data untuk view
        extract($stats);

        // Return view dengan data
        return view('super-admin.dashboard', compact(
            'totalKasus',
            'totalDesa',
            'kabupatenCount',
            'kecamatanCount',
            'kasusPerKabupaten',
            'kasusPerKabupatenNik',
            'kasusPerKecamatan',
            'kasusPerKecamatanNik',
            'dataKabupatenTkp',
            'dataKabupatenNik',
            'dataKecamatanTkp',
            'dataKecamatanNik',
            'allKecamatanTkpList',
            'residivisStats',
            'anggaranStats',
            'organizationData',
            'latestBerita'
        ));
    }

    /**
     * Contoh method lain yang juga jadi simple
     * Misalnya untuk export atau API endpoint
     */
    public function getStatisticsApi()
    {
        return response()->json(
            $this->dashboardService->getAllStatistics()
        );
    }

    /**
     * Get specific statistics
     */
    public function getResidivisStats()
    {
        return response()->json(
            $this->dashboardService->getResidivisStats()
        );
    }

    /**
     * Get anggaran statistics
     */
    public function getAnggaranStats()
    {
        return response()->json(
            $this->dashboardService->getAnggaranStats()
        );
    }
}











