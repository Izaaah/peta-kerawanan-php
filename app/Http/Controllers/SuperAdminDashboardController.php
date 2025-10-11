<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        // Data untuk statistik dashboard
        $totalKasus = TkpResidivisIndividu::count();

        // Filter desa data to exclude entries with "/", "area", and "unknown"
        $filteredDesaQuery = DesaGeojson::query()
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%area%'")
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%unknown%'")
            ->where('nama_desa', 'not like', '%/%')
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%unknown%'")
            ->where('kecamatan', 'not like', '%/%')
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%unknown%'")
            ->where('kabupaten', 'not like', '%/%');

        $totalDesa = $filteredDesaQuery->count();
        $kabupatenCount = $filteredDesaQuery->distinct('kabupaten')->count('kabupaten');
        $kecamatanCount = $filteredDesaQuery->distinct('kecamatan')->count('kecamatan');

        // Data untuk grafik kasus per kabupaten
        $kasusPerKabupaten = TkpResidivisIndividu::select('kabupaten', DB::raw('count(*) as total'))
            ->groupBy('kabupaten')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Data untuk tabel detail kabupaten TKP (20 data teratas)
        $dataKabupatenTkp = TkpResidivisIndividu::select('kabupaten', DB::raw('count(*) as total_kasus'))
            ->groupBy('kabupaten')
            ->orderBy('total_kasus', 'desc')
            ->limit(20)
            ->get();

        // Data untuk grafik kasus per kabupaten
        $allKecamatanTkpList = TkpResidivisIndividu::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->paginate(15)->withQueryString();

        // Data untuk grafik kasus per kabupaten nik
        $kasusPerKabupatenNik = DataIndividuTsk::select('kabupaten', DB::raw('count(*) as total'))
            ->groupBy('kabupaten')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Data untuk tabel detail kabupaten NIK (20 data teratas)
        $dataKabupatenNik = DataIndividuTsk::select('kabupaten', DB::raw('count(*) as total_kasus'))
            ->groupBy('kabupaten')
            ->orderBy('total_kasus', 'desc')
            ->limit(20)
            ->get();

        // Data untuk grafik kasus per kecamatan
        $kasusPerKecamatan = TkpResidivisIndividu::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Data untuk tabel detail kecamatan TKP (20 data teratas)
        $dataKecamatanTkp = TkpResidivisIndividu::select('kecamatan', 'kabupaten', DB::raw('count(*) as total_kasus'))
            ->groupBy('kecamatan', 'kabupaten')
            ->orderBy('total_kasus', 'desc')
            ->limit(20)
            ->get();

        // Data untuk grafik kasus per kecamatan nik
        $kasusPerKecamatanNik = DataIndividuTsk::select('kecamatan', DB::raw('count(*) as total'))
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Data untuk tabel detail kecamatan NIK (20 data teratas)
        $dataKecamatanNik = DataIndividuTsk::select('kecamatan', 'kabupaten', DB::raw('count(*) as total_kasus'))
            ->groupBy('kecamatan', 'kabupaten')
            ->orderBy('total_kasus', 'desc')
            ->limit(20)
            ->get();

        // Data terbaru
        $kasusTerbaru = TkpResidivisIndividu::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Data terbaru
        // $kasusTerbaruIndividu = KasusNarkoba::with('desa')
        //     ->orderBy('created_at', 'desc')
        //     ->limit(5)
        //     ->get();

        // Data untuk grafik trend bulanan
        $trendBulanan = KasusNarkoba::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('count(*) as total')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Data untuk pie chart status individu (Napi/Non napi)
        $statusPie = [
            'Napi' => \App\Models\DataIndividuTsk::where('status', 'Napi')->count(),
            'Non napi' => \App\Models\DataIndividuTsk::where('status', 'Non napi')->count(),
        ];

        // Data untuk pie chart residivis (Residivis/Non Residivis)
        $residivisPie = [
            'Residivis' => \App\Models\DataIndividuTsk::where('residivis', true)->count(),
            'Non Residivis' => \App\Models\DataIndividuTsk::where('residivis', false)->count(),
        ];

        // Data untuk statistik jenis kelamin
        $jenisKelaminStats = [
            'Laki-laki' => \App\Models\DataIndividuTsk::where('jenis_kelamin', 'L')->count(),
            'Perempuan' => \App\Models\DataIndividuTsk::where('jenis_kelamin', 'P')->count(),
        ];

        // Data untuk statistik umur (berdasarkan tanggal lahir)
        $totalIndividu = \App\Models\DataIndividuTsk::whereNotNull('tgl_lahir')->count();
        $anakAnak = 0;
        $dewasa = 0;

        if ($totalIndividu > 0) {
            $individuData = \App\Models\DataIndividuTsk::whereNotNull('tgl_lahir')->get();

            foreach ($individuData as $individu) {
                $umur = Carbon::parse($individu->tgl_lahir)->age;

                if ($umur >= 1 && $umur < 18) {
                    $anakAnak++;
                } elseif ($umur >= 18) {
                    $dewasa++;
                }
            }
        }

        $umurStats = [
            'Anak-anak (1-17 tahun)' => $anakAnak,
            'Dewasa (18+ tahun)' => $dewasa,
        ];

        // Ambil data anggaran berdasarkan role user
        $user = auth()->user();
        $anggaranQuery = Anggaran::query();
        if ($user && !$user->isSuperAdmin()) {
            $anggaranQuery->where('created_by', $user->id);
        }

        // Ambil data anggaran dengan struktur hierarkis
        $anggaranList = (clone $anggaranQuery)
            ->with('children')
            ->where('is_main_activity', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung total dari semua data (termasuk sub activities)
        $totalAnggaranSebelum = (clone $anggaranQuery)->sum('anggaran_sebelum');
        $totalBlokir = (clone $anggaranQuery)->sum('blokir');
        $totalSetelah = $totalAnggaranSebelum - $totalBlokir;

        // Data untuk statistik anggaran
        $anggaranStats = [
            'Total Anggaran Sebelum' => $totalAnggaranSebelum,
            'Total Blokir' => $totalBlokir,
            'Total Anggaran Setelah' => $totalSetelah,
            'Jumlah Kegiatan' => $anggaranQuery->count(),
        ];

        // Data untuk pie chart anggaran berdasarkan akun (seperti gambar)
        $anggaranByAkun = (clone $anggaranQuery)
            ->select('akun', DB::raw('SUM(anggaran_sebelum) as total_anggaran'), DB::raw('SUM(blokir) as total_blokir'))
            ->groupBy('akun')
            ->get();

        $anggaranPie = [];
        foreach ($anggaranByAkun as $item) {
            // Tambahkan anggaran normal
            $anggaranPie[$item->akun] = $item->total_anggaran;
            // Tambahkan anggaran blokir jika ada
            if ($item->total_blokir > 0) {
                $anggaranPie[$item->akun . ' (Blokir)'] = $item->total_blokir;
            }
        }

        // Data untuk pie chart jenis kegiatan (main vs sub activities)
        $kegiatanPie = [
            'Kegiatan Utama' => $anggaranQuery->where('is_main_activity', true)->count(),
            'Sub Kegiatan' => $anggaranQuery->where('is_main_activity', false)->count(),
        ];

        $totalPersonil = Komposisi::sum('jumlah_personil');
        $totalDspJumlah = Komposisi::sum('dsp_jumlah');
        $totalDspKosong = Komposisi::sum('dsp_kosong');
        $totalDspTerisi = Komposisi::sum('dsp_terisi');

        // Ambil data komposisi
        $komposisiList = Komposisi::all();

        $galeri = Galeri::all();

        // Ambil data tugas dan fungsi
        $tugas = Tugas::all();
        $fungsi = Fungsi::all();

        // Ambil data berita
        // Fetch berita with position ordering (with fallback if position column doesn't exist)
        try {
            $berita = Berita::orderByRaw("
                CASE
                    WHEN position = 'utama' THEN 1
                    WHEN position = 'pinggir' THEN 2
                    WHEN position = 'bawah' THEN 3
                    ELSE 4
                END
            ")->orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            // Fallback if position column doesn't exist yet
            $berita = Berita::orderBy('created_at', 'desc')->get();
        }

        // Kalau $pegawai belum ada, ambil dari DB
        if (!isset($pegawai)) {
            $pegawai = Pegawai::orderBy('jabatan')->orderBy('nama')->get();
        }

        $jabatanList = $jabatanList ?? [
            'Kepala',
            'Kabid Pemberantasan',
            'Kabag Umum',
            'Kasi Intelijen',
            'Analisis Intelijen',
            'Penyidik Sie Intelijen',
            'Petugas Pengejaran',
            'Petugas Penindakan',
            'Pengolah Data Sie Intelijen',
            'Kasi Wastahti',
            'Penjaga Tahanan',
            'Pengadministrasian Umum',
            'Pengolahan Data',
        ];

        return view('super-admin.dashboard', compact(
            'totalKasus',
            'totalDesa',
            'kabupatenCount',
            'kecamatanCount',
            'kasusPerKabupaten',
            'kasusPerKecamatan',
            'kasusPerKabupatenNik',
            'kasusPerKecamatanNik',
            'dataKabupatenTkp',
            'dataKecamatanTkp',
            'dataKabupatenNik',
            'dataKecamatanNik',
            'trendBulanan',
            'kasusTerbaru',
            'statusPie',
            'residivisPie',
            'jenisKelaminStats',
            'umurStats',
            'anggaranStats',
            'anggaranPie',
            'kegiatanPie',
            'anggaranList',
            'totalAnggaranSebelum',
            'totalBlokir',
            'totalSetelah',
            'totalPersonil',
            'totalDspJumlah',
            'totalDspKosong',
            'totalDspTerisi',
            'komposisiList',
            'allKecamatanTkpList',
            'galeri',
            'jabatanList',
            'pegawai',
            'tugas',
            'fungsi',
            'berita'
        ));
    }

    public function getIndividuCount(Request $request)
    {
        $kabupaten = $request->kabupaten;
        $kecamatan = $request->kecamatan;
        $desa = $request->desa;

        $count = \App\Models\DataIndividuTsk::whereRaw('LOWER(TRIM(kabupaten)) = ?', [strtolower(trim($kabupaten))])
            ->whereRaw('LOWER(TRIM(kecamatan)) = ?', [strtolower(trim($kecamatan))])
            ->whereRaw('LOWER(TRIM(kelurahan)) = ?', [strtolower(trim($desa))])
            ->count();

        return response()->json(['count' => $count]);
    }
}
