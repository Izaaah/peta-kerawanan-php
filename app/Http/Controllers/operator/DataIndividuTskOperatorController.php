<?php

namespace App\Http\Controllers\operator;

use App\Models\DataIndividuTsk;
use App\Models\DesaGeojson;
use App\Models\KasusNarkoba;
use App\Models\TkpResidivisIndividu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DataIndividuTskOperatorController extends Controller
{
    public function index()
    {
        $stats = [
            'total_individu' => DataIndividuTsk::count(),
            'total_kasus' => KasusNarkoba::count(),
            'residivis_count' => DataIndividuTsk::where('residivis', true)->count(),
            'non_residivis_count' => DataIndividuTsk::where('residivis', false)->count(),
        ];

        $sampleData = DataIndividuTsk::with('desaGeojson')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();

        return view('operator.data.individu', compact('stats', 'sampleData', 'kabupatenList', 'kecamatanList'));
    }

    public function getIndividuCount(Request $request)
    {
        $kabupaten = $request->kabupaten;
        $kecamatan = $request->kecamatan;
        $desa = $request->desa;

        $count = DataIndividuTsk::whereRaw('LOWER(TRIM(kabupaten)) = ?', [strtolower(trim($kabupaten))])
            ->whereRaw('LOWER(TRIM(kecamatan)) = ?', [strtolower(trim($kecamatan))])
            ->whereRaw('LOWER(TRIM(kelurahan)) = ?', [strtolower(trim($desa))])
            ->count();

        return response()->json(['count' => $count]);
    }

    public function show($id)
    {
        $individu = DataIndividuTsk::with(['desaGeojson', 'telepon', 'rekening', 'ewallet', 'keluargaLain', 'residivisDetail', 'foto'])
            ->findOrFail($id);

        $kasusCount = KasusNarkoba::where('nama_desa', $individu->kelurahan)
            ->where('kecamatan', $individu->kecamatan)
            ->where('kabupaten', $individu->kabupaten)
            ->count();

        return view('super-admin.data.individu-show', compact('individu', 'kasusCount'));
    }

    public function getData(Request $request)
    {
        $query = DataIndividuTsk::with(['desaGeojson', 'createdBy']);

        // Apply filters
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kabupaten')) {
            $query->where('kabupaten', $request->kabupaten);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('peran_jaringan')) {
            $query->where('peran_jaringan', $request->peran_jaringan);
        }

        if ($request->filled('residivis')) {
            $query->where('residivis', $request->residivis);
        }

        $perPage = $request->get('per_page', 15);
        $data = $query->paginate($perPage);

        return response()->json($data);
    }

    public function export(Request $request)
    {
        $query = DataIndividuTsk::with('desaGeojson');

        // Apply same filters as getData
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                ->orWhere('nik', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kabupaten')) {
            $query->where('kabupaten', $request->kabupaten);
        }

        $data = $query->get();

        $filename = 'data_individu_tsk_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Add headers
            fputcsv($file, [
                'ID',
                'Nama',
                'NIK',
                'NKK',
                'Provinsi',
                'Kabupaten',
                'Kecamatan',
                'Kelurahan',
                'Alamat',
                'Status',
                'Peran Jaringan',
                'Residivis',
                'Jenis Narkotika',
                'Skala Kelas',
                'Sumber Informasi'
            ]);

            // Add data
            foreach ($data as $individu) {
                fputcsv($file, [
                    $individu->id,
                    $individu->nama,
                    $individu->nik,
                    $individu->nkk,
                    $individu->provinsi,
                    $individu->kabupaten,
                    $individu->kecamatan,
                    $individu->kelurahan,
                    $individu->alamat,
                    $individu->status,
                    $individu->peran_jaringan,
                    $individu->residivis ? 'Ya' : 'Tidak',
                    $individu->jenis_narkotika,
                    $individu->skala_kelas,
                    $individu->sumber_informasi
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
