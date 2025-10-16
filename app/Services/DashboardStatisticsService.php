<?php

namespace App\Services;

use App\Models\KasusNarkoba;
use App\Models\DesaGeojson;
use App\Models\DataIndividuTsk;
use App\Models\TkpResidivisIndividu;
use App\Models\Anggaran;
use App\Models\Komposisi;
use App\Models\Galeri;
use App\Models\Pegawai;
use App\Models\Tugas;
use App\Models\Fungsi;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardStatisticsService
{
    /**
     * Get all dashboard statistics
     *
     * @return array
     */
    public function getAllStatistics(): array
    {
        return [
            // Basic counts
            'totalKasus' => $this->getTotalKasus(),
            'totalDesa' => $this->getTotalDesa(),
            'kabupatenCount' => $this->getKabupatenCount(),
            'kecamatanCount' => $this->getKecamatanCount(),

            // Grafik data
            'kasusPerKabupaten' => $this->getKasusPerKabupaten(5),
            'kasusPerKabupatenNik' => $this->getKasusPerKabupatenNik(5),
            'kasusPerKecamatan' => $this->getKasusPerKecamatan(5),
            'kasusPerKecamatanNik' => $this->getKasusPerKecamatanNik(5),

            // Detail data (20 teratas)
            'dataKabupatenTkp' => $this->getDataKabupatenTkp(20),
            'dataKabupatenNik' => $this->getDataKabupatenNik(20),
            'dataKecamatanTkp' => $this->getDataKecamatanTkp(20),
            'dataKecamatanNik' => $this->getDataKecamatanNik(20),

            // Pagination data
            'allKecamatanTkpList' => $this->getAllKecamatanTkpPaginated(15),

            // Residivis data
            'residivisStats' => $this->getResidivisStats(),

            // Anggaran data
            'anggaranStats' => $this->getAnggaranStats(),

            // Organization data
            'organizationData' => $this->getOrganizationData(),

            // Latest berita
            'latestBerita' => $this->getLatestBerita(5),
        ];
    }

    /**
     * Get total kasus count
     */
    public function getTotalKasus(): int
    {
        return TkpResidivisIndividu::count();
    }

    /**
     * Get filtered desa query (exclude area/unknown entries)
     */
    private function getFilteredDesaQuery()
    {
        return DesaGeojson::query()
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%area%'")
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%unknown%'")
            ->where('nama_desa', 'not like', '%/%')
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%unknown%'")
            ->where('kecamatan', 'not like', '%/%')
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%unknown%'")
            ->where('kabupaten', 'not like', '%/%');
    }

    /**
     * Get total desa count
     */
    public function getTotalDesa(): int
    {
        return $this->getFilteredDesaQuery()->count();
    }

    /**
     * Get kabupaten count
     */
    public function getKabupatenCount(): int
    {
        return $this->getFilteredDesaQuery()
            ->distinct('kabupaten')
            ->count('kabupaten');
    }

    /**
     * Get kecamatan count
     */
    public function getKecamatanCount(): int
    {
        return $this->getFilteredDesaQuery()
            ->distinct('kecamatan')
            ->count('kecamatan');
    }

    /**
     * Get kasus per kabupaten (TKP)
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getKasusPerKabupaten(int $limit = 5)
    {
        return TkpResidivisIndividu::select('kabupaten', DB::raw('count(*) as total'))
            ->groupBy('kabupaten')
            ->orderBy('total', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get data kabupaten TKP (untuk tabel detail)
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getDataKabupatenTkp(int $limit = 20)
    {
        return TkpResidivisIndividu::select('kabupaten', DB::raw('count(*) as total_kasus'))
            ->groupBy('kabupaten')
            ->orderBy('total_kasus', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get all kecamatan TKP with pagination
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllKecamatanTkpPaginated(int $perPage = 15)
    {
        return TkpResidivisIndividu::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Get kasus per kabupaten (NIK)
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getKasusPerKabupatenNik(int $limit = 5)
    {
        return DataIndividuTsk::select('kabupaten', DB::raw('count(*) as total'))
            ->groupBy('kabupaten')
            ->orderBy('total', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get data kabupaten NIK (untuk tabel detail)
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getDataKabupatenNik(int $limit = 20)
    {
        return DataIndividuTsk::select('kabupaten', DB::raw('count(*) as total_kasus'))
            ->groupBy('kabupaten')
            ->orderBy('total_kasus', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get kasus per kecamatan (TKP)
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getKasusPerKecamatan(int $limit = 5)
    {
        return TkpResidivisIndividu::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get data kecamatan TKP (untuk tabel detail)
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getDataKecamatanTkp(int $limit = 20)
    {
        return TkpResidivisIndividu::select('kecamatan', 'kabupaten', DB::raw('count(*) as total_kasus'))
            ->groupBy('kecamatan', 'kabupaten')
            ->orderBy('total_kasus', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get kasus per kecamatan (NIK)
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getKasusPerKecamatanNik(int $limit = 5)
    {
        return DataIndividuTsk::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get data kecamatan NIK (untuk tabel detail)
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getDataKecamatanNik(int $limit = 20)
    {
        return DataIndividuTsk::select('kecamatan', 'kabupaten', DB::raw('count(*) as total_kasus'))
            ->groupBy('kecamatan', 'kabupaten')
            ->orderBy('total_kasus', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get residivis statistics
     *
     * @return array
     */
    public function getResidivisStats(): array
    {
        $totalIndividu = DataIndividuTsk::count();
        $residivisCount = DataIndividuTsk::where('residivis', true)->count();
        $nonResidivisCount = DataIndividuTsk::where('residivis', false)->count();

        // Pie chart data
        $residivisPie = [
            'Residivis' => $residivisCount,
            'Non-Residivis' => $nonResidivisCount,
        ];

        // Stats by gender
        $jenisKelaminStats = DataIndividuTsk::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin')
            ->toArray();

        // Stats by age category
        $umurStats = $this->getUmurStats();

        return [
            'totalIndividu' => $totalIndividu,
            'residivisCount' => $residivisCount,
            'nonResidivisCount' => $nonResidivisCount,
            'residivisPie' => $residivisPie,
            'jenisKelaminStats' => $jenisKelaminStats,
            'umurStats' => $umurStats,
        ];
    }

    /**
     * Get age statistics
     *
     * @return array
     */
    private function getUmurStats(): array
    {
        $individuals = DataIndividuTsk::whereNotNull('tgl_lahir')->get();

        $umurStats = [
            '< 20 tahun' => 0,
            '20-30 tahun' => 0,
            '31-40 tahun' => 0,
            '41-50 tahun' => 0,
            '> 50 tahun' => 0,
        ];

        foreach ($individuals as $individu) {
            $umur = Carbon::parse($individu->tgl_lahir)->age;

            if ($umur < 20) {
                $umurStats['< 20 tahun']++;
            } elseif ($umur >= 20 && $umur <= 30) {
                $umurStats['20-30 tahun']++;
            } elseif ($umur >= 31 && $umur <= 40) {
                $umurStats['31-40 tahun']++;
            } elseif ($umur >= 41 && $umur <= 50) {
                $umurStats['41-50 tahun']++;
            } else {
                $umurStats['> 50 tahun']++;
            }
        }

        return $umurStats;
    }

    /**
     * Get anggaran statistics
     *
     * @return array
     */
    public function getAnggaranStats(): array
    {
        $anggaranQuery = Anggaran::query();

        // Total anggaran keseluruhan
        $totalAnggaranSebelum = (clone $anggaranQuery)->sum('anggaran_sebelum');
        $totalBlokir = (clone $anggaranQuery)->sum('blokir');
        $totalAnggaranSetelah = $totalAnggaranSebelum - $totalBlokir;

        // Data untuk pie chart anggaran: setiap kegiatan utama dengan sebelum dan setelah blokir
        $anggaranByKegiatan = (clone $anggaranQuery)
            ->where('is_main_activity', true)
            ->select('kegiatan', DB::raw('SUM(anggaran_sebelum) as total_sebelum'), DB::raw('SUM(blokir) as total_blokir'))
            ->groupBy('kegiatan')
            ->get();

        $anggaranPie = [];
        foreach ($anggaranByKegiatan as $item) {
            $totalSetelah = $item->total_sebelum - $item->total_blokir;
            $anggaranPie[$item->kegiatan . ' (Sebelum Blokir)'] = $item->total_sebelum;
            $anggaranPie[$item->kegiatan . ' (Setelah Blokir)'] = $totalSetelah;
        }

        // Data untuk bar chart
        $anggaranBar = (clone $anggaranQuery)
            ->select('kegiatan', 'anggaran_sebelum', 'blokir')
            ->orderBy('anggaran_sebelum', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'kegiatan' => $item->kegiatan,
                    'sebelum' => $item->anggaran_sebelum,
                    'setelah' => $item->anggaran_sebelum - $item->blokir,
                ];
            });

        return [
            'totalAnggaranSebelum' => $totalAnggaranSebelum,
            'totalBlokir' => $totalBlokir,
            'totalAnggaranSetelah' => $totalAnggaranSetelah,
            'anggaranPie' => $anggaranPie,
            'anggaranBar' => $anggaranBar,
        ];
    }

    /**
     * Get organization data (komposisi, galeri, pegawai, tupoksi)
     *
     * @return array
     */
    public function getOrganizationData(): array
    {
        $komposisi = Komposisi::all();
        $galeri = Galeri::orderBy('created_at', 'desc')->limit(6)->get();
        $pegawai = Pegawai::all();
        $tugas = Tugas::all();
        $fungsi = Fungsi::all();

        return [
            'komposisi' => $komposisi,
            'galeri' => $galeri,
            'pegawai' => $pegawai,
            'tugas' => $tugas,
            'fungsi' => $fungsi,
        ];
    }

    /**
     * Get latest berita
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getLatestBerita(int $limit = 5)
    {
        return Berita::orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get kasus terbaru
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getKasusTerbaru(int $limit = 10)
    {
        return DataIndividuTsk::with(['desaGeojson'])
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}


