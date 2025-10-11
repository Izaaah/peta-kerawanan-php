<?php

namespace App\Http\Controllers\admin;

use App\Models\KasusNarkoba;
use App\Models\DesaGeojson;
use App\Models\TkpResidivisIndividu;
use App\Models\Anggaran;
use App\Models\Komposisi;
use App\Models\Pegawai;
use App\Models\Tugas;
use App\Models\Fungsi;
use App\Models\Galeri;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $userKabupaten = $user->name; // diasumsikan nama user = kabupaten/kota
        $userId = $user->id;

        // Data untuk statistik dashboard (hanya data yang diinput user ini)
        // Filter berdasarkan created_by jika ada, atau berdasarkan kabupaten jika tidak ada created_by
        $totalKasus = TkpResidivisIndividu::where(function ($query) use ($userId, $userKabupaten) {
            $query->where('created_by', $userId)
                ->orWhere(function ($q) use ($userKabupaten) {
                    $q->whereNull('created_by')
                        ->where('kabupaten', $userKabupaten);
                });
        })->count();

        // Filter desa data hanya untuk kabupaten user
        $filteredDesaQuery = DesaGeojson::query()
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%area%'")
            ->whereRaw("LOWER(nama_desa) NOT LIKE '%unknown%'")
            ->where('nama_desa', 'not like', '%/%')
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kecamatan) NOT LIKE '%unknown%'")
            ->where('kecamatan', 'not like', '%/%')
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%area%'")
            ->whereRaw("LOWER(kabupaten) NOT LIKE '%unknown%'")
            ->where('kabupaten', 'not like', '%/%')
            ->where('kabupaten', $userKabupaten);

        $totalDesa = $filteredDesaQuery->count();
        $kabupatenCount = 1; // hanya kabupaten user
        $kecamatanCount = $filteredDesaQuery->distinct('kecamatan')->count('kecamatan');

        // Data untuk grafik kasus per kecamatan berdasarkan TKP (hanya kabupaten user, hanya data user ini)
        $kasusPerKecamatanTkp = TkpResidivisIndividu::select('kecamatan', DB::raw('count(*) as total'))
            ->where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            })
            ->where('kabupaten', $userKabupaten)
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->get();

        // Data untuk grafik kasus per desa berdasarkan TKP (hanya kabupaten user, hanya data user ini)
        $kasusPerDesaTkp = TkpResidivisIndividu::select('desa', 'kecamatan', DB::raw('count(*) as total'))
            ->where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            })
            ->where('kabupaten', $userKabupaten)
            ->groupBy('desa', 'kecamatan')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Data untuk grafik kasus per kecamatan berdasarkan NIK (hanya kabupaten user, hanya data user ini)
        $kasusPerKecamatanNik = \App\Models\DataIndividuTsk::select('kecamatan', DB::raw('count(*) as total'))
            ->where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            })
            ->where('kabupaten', $userKabupaten)
            ->groupBy('kecamatan')
            ->orderBy('total', 'desc')
            ->get();

        // Data untuk grafik kasus per desa berdasarkan NIK (hanya kabupaten user, hanya data user ini)
        $kasusPerDesaNik = \App\Models\DataIndividuTsk::select('kelurahan', 'kecamatan', DB::raw('count(*) as total'))
            ->where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            })
            ->where('kabupaten', $userKabupaten)
            ->groupBy('kelurahan', 'kecamatan')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Data untuk pie chart status individu (hanya data user ini)
        $statusPie = [
            'Napi' => \App\Models\DataIndividuTsk::where('status', 'Napi')
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
            'Non napi' => \App\Models\DataIndividuTsk::where('status', 'Non napi')
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
        ];

        // Data untuk pie chart residivis (hanya data user ini)
        $residivisPie = [
            'Residivis' => \App\Models\DataIndividuTsk::where('residivis', true)
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
            'Non Residivis' => \App\Models\DataIndividuTsk::where('residivis', false)
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
        ];

        // Data untuk grafik kasus per desa (top 10, hanya kabupaten user, hanya data user ini)
        $kasusPerDesa = TkpResidivisIndividu::select('desa', 'kecamatan', DB::raw('count(*) as total'))
            ->where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            })
            ->where('kabupaten', $userKabupaten)
            ->groupBy('desa', 'kecamatan')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // Data terbaru (hanya data user ini)
        $kasusTerbaru = TkpResidivisIndividu::where(function ($query) use ($userId, $userKabupaten) {
            $query->where('created_by', $userId)
                ->orWhere(function ($q) use ($userKabupaten) {
                    $q->whereNull('created_by')
                        ->where('kabupaten', $userKabupaten);
                });
        })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Data untuk grafik trend bulanan (hanya data user ini)
        $trendBulanan = TkpResidivisIndividu::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('count(*) as total')
        )
            ->where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            })
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Data untuk pie chart jenis kelamin (hanya data user ini)
        $jenisKelaminStats = [
            'Laki-laki' => \App\Models\DataIndividuTsk::where('jenis_kelamin', 'L')
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
            'Perempuan' => \App\Models\DataIndividuTsk::where('jenis_kelamin', 'P')
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
        ];

        // Data untuk pie chart kategori umur (hanya data user ini)
        $umurStats = [
            'Anak-anak (1-17 tahun)' => \App\Models\DataIndividuTsk::whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) < 18')
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
            'Dewasa (18+ tahun)' => \App\Models\DataIndividuTsk::whereRaw('TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) >= 18')
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
        ];

        // Ambil data anggaran berdasarkan role user
        $anggaranQuery = Anggaran::query();
        if ($user && !$user->isAdministrator()) {
            $anggaranQuery->where('created_by', $user->id);
        }

        $anggaranList = (clone $anggaranQuery)
            ->orderBy('created_at', 'desc')
            ->get();

        $totalAnggaranSebelum = (clone $anggaranQuery)->sum('anggaran_sebelum');
        $totalBlokir = (clone $anggaranQuery)->sum('blokir');
        $totalSetelah = $totalAnggaranSebelum - $totalBlokir;

        $totalPersonil = Komposisi::sum('jumlah_personil');
        $totalDspJumlah = Komposisi::sum('dsp_jumlah');
        $totalDspKosong = Komposisi::sum('dsp_kosong');
        $totalDspTerisi = Komposisi::sum('dsp_terisi');

        // Ambil data komposisi
        $komposisiList = Komposisi::all();

        // Ambil data pegawai untuk struktur organisasi
        $pegawai = Pegawai::all();

        // Ambil data tugas dan fungsi
        $tugas = Tugas::all();
        $fungsi = Fungsi::all();

        // Ambil data galeri
        $galeri = Galeri::all();

        // Ambil data berita
        $berita = Berita::orderBy('created_at', 'desc')->limit(4)->get();

        // Ambil daftar jabatan untuk dropdown
        $jabatanList = [
            'Ketua',
            'Kabid Pemberantasan',
            'Kabag Umum',
            'Kasi Intelijen',
            'Kasi Wastahti',
            'Analisis Intelijen',
            'Penyidik Sie Intelijen',
            'Petugas Pengejaran',
            'Petugas Penindakan Sie Intelijen',
            'Pengolah Data Sie Intelijen',
            'Penjaga Tahanan',
            'Pengadministrasian Umum',
        ];

        return view('admin.dashboard', compact(
            'totalKasus',
            'totalDesa',
            'kabupatenCount',
            'kecamatanCount',
            'kasusPerKecamatanTkp',
            'kasusPerDesaTkp',
            'kasusPerKecamatanNik',
            'kasusPerDesaNik',
            'kasusTerbaru',
            'statusPie',
            'residivisPie',
            'kasusPerDesa',
            'trendBulanan',
            'jenisKelaminStats',
            'umurStats',
            'anggaranList',
            'totalAnggaranSebelum',
            'totalBlokir',
            'totalSetelah',
            'komposisiList',
            'totalPersonil',
            'totalDspJumlah',
            'totalDspKosong',
            'totalDspTerisi',
            'pegawai',
            'tugas',
            'fungsi',
            'galeri',
            'berita',
            'jabatanList'
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
