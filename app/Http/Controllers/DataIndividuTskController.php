<?php

namespace App\Http\Controllers;

use App\Models\DataIndividuTsk;
use App\Models\DesaGeojson;
use App\Models\KasusNarkoba;
use App\Models\TkpResidivisIndividu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataIndividuTskController extends Controller
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
            ->limit(10)
            ->get();

        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();

        return view('super-admin.data.individu', compact('stats', 'sampleData', 'kabupatenList', 'kecamatanList'));
    }

    public function getIndividuCount(Request $request)
    {
        $kabupaten = $request->kabupaten;
        $kecamatan = $request->kecamatan;
        $desa = $request->desa;

        $count = TkpResidivisIndividu::whereRaw('LOWER(TRIM(kabupaten)) = ?', [strtolower(trim($kabupaten))])
            ->whereRaw('LOWER(TRIM(kecamatan)) = ?', [strtolower(trim($kecamatan))])
            ->whereRaw('LOWER(TRIM(desa)) = ?', [strtolower(trim($desa))])
            ->count();

        return response()->json(['count' => $count]);
    }

    public function create()
    {
        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();
        $desaList = DesaGeojson::all();

        return view('super-admin.data.individu-create', compact('kabupatenList', 'kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:data_individu_tsk,nik',
            'nkk' => 'required|string|max:20',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'nama_ayah' => 'nullable|string|max:255',
            'nik_ayah' => 'nullable|string|max:20',
            'nama_ibu' => 'nullable|string|max:255',
            'nik_ibu' => 'nullable|string|max:20',
            'peran_jaringan' => 'required|in:koordinator informan,informan,kurir,gudang,broker,bandar,beking,tidak tahu',
            'modus_operasi' => 'nullable|string',
            'jenis_narkotika' => 'nullable', // array/string
            'skala_kelas' => 'required|in:dibawah 10gr,dibawah1ons,dibawah1kg,diatas1kg,tidak tahu',
            'status' => 'required|in:Napi,Non napi',
            'residivis' => 'nullable|boolean',
            'sumber_informasi' => 'nullable|in:informan,analisa sosmed,analisa aliran dana',
            // relasi
            'telepon' => 'nullable|array',
            'rekening' => 'nullable|array',
            'ewallet' => 'nullable|array',
            'nama_keluarga_lain' => 'nullable|array',
            'nik_keluarga_lain' => 'nullable|array',
            // residivis detail
            'aph_menangani' => 'nullable|array',
            'pasal_disangkakan' => 'nullable|array',
            'vonis' => 'nullable|array',
            'lapas_akhir' => 'nullable|array',
            // foto
            'keterangan_foto' => 'nullable|array',
            'foto' => 'nullable|array',
            'foto.*' => 'nullable|file|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // Simpan data utama
            $individu = DataIndividuTsk::create([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'nkk' => $request->nkk,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'alamat' => $request->alamat,
                'nama_ayah' => $request->nama_ayah,
                'nik_ayah' => $request->nik_ayah,
                'nama_ibu' => $request->nama_ibu,
                'nik_ibu' => $request->nik_ibu,
                'peran_jaringan' => $request->peran_jaringan,
                'modus_operasi' => $request->modus_operasi,
                'jenis_narkotika' => is_array($request->jenis_narkotika) ? implode(',', $request->jenis_narkotika) : $request->jenis_narkotika,
                'skala_kelas' => $request->skala_kelas,
                'status' => $request->status,
                'residivis' => $request->has('residivis'),
                'sumber_informasi' => $request->sumber_informasi,
            ]);

            // Telepon
            if ($request->filled('telepon')) {
                foreach ($request->telepon as $telp) {
                    if ($telp) {
                        $individu->telepon()->create(['nomor_telepon' => $telp]);
                    }
                }
            }
            // Rekening
            if ($request->filled('rekening')) {
                foreach ($request->rekening as $rek) {
                    if ($rek) {
                        $individu->rekening()->create(['no_rekening' => $rek]);
                    }
                }
            }
            // Ewallet
            if ($request->filled('ewallet')) {
                foreach ($request->ewallet as $ew) {
                    if ($ew) {
                        $individu->ewallet()->create(['no_ewallet' => $ew]);
                    }
                }
            }
            // Keluarga Lain
            if ($request->filled('nama_keluarga_lain') && $request->filled('nik_keluarga_lain')) {
                foreach ($request->nama_keluarga_lain as $i => $nama) {
                    $nik = $request->nik_keluarga_lain[$i] ?? null;
                    if ($nama || $nik) {
                        $individu->keluargaLain()->create([
                            'nama_keluarga' => $nama,
                            'nik' => $nik,
                        ]);
                    }
                }
            }
            // Residivis Detail
            if ($request->has('residivis') && $request->residivis) {
                $aph = $request->aph_menangani ?? [];
                $pasal = $request->pasal_disangkakan ?? [];
                $vonis = $request->vonis ?? [];
                $lapas = $request->lapas_akhir ?? [];
                $max = max(count($aph), count($pasal), count($vonis), count($lapas));
                for ($i = 0; $i < $max; $i++) {
                    if (($aph[$i] ?? null) || ($pasal[$i] ?? null) || ($vonis[$i] ?? null) || ($lapas[$i] ?? null)) {
                        $individu->residivisDetail()->create([
                            'aph' => $aph[$i] ?? null,
                            'pasal' => $pasal[$i] ?? null,
                            'vonis' => $vonis[$i] ?? null,
                            'lapas_akhir' => $lapas[$i] ?? null,
                        ]);
                    }
                }
            }
            // TKP Residivis
            if ($request->has('tkp_provinsi')) {
                $prov = $request->tkp_provinsi ?? [];
                $kab = $request->tkp_kabupaten ?? [];
                $kec = $request->tkp_kecamatan ?? [];
                $desa = $request->tkp_desa ?? [];
                $lokasi = $request->tkp_lokasi ?? [];
                $max = max(count($prov), count($kab), count($kec), count($desa), count($lokasi));
                for ($i = 0; $i < $max; $i++) {
                    if (($prov[$i] ?? null) || ($kab[$i] ?? null) || ($kec[$i] ?? null) || ($desa[$i] ?? null) || ($lokasi[$i] ?? null)) {
                        DB::table('tkp_residivis_individu')->insert([
                            'individu_id' => $individu->id,
                            'provinsi' => $prov[$i] ?? null,
                            'kabupaten' => $kab[$i] ?? null,
                            'kecamatan' => $kec[$i] ?? null,
                            'desa' => $desa[$i] ?? null,
                            'lokasi' => $lokasi[$i] ?? null,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
            // Foto
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $i => $file) {
                    if ($file) {
                        $path = $file->store('foto-individu', 'public');
                        $keterangan = $request->keterangan_foto[$i] ?? null;
                        $individu->foto()->create([
                            'file_foto' => $path,
                            'keterangan' => $keterangan,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('super-admin.data.individu')->with('success', 'Data individu TSK berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

    public function edit($id)
    {
        $individu = DataIndividuTsk::findOrFail($id);
        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();
        $desaList = DesaGeojson::all();

        return view('super-admin.data.individu-edit', compact('individu', 'kabupatenList', 'kecamatanList', 'desaList'));
    }

    public function update(Request $request, $id)
    {
        $individu = DataIndividuTsk::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:data_individu_tsk,nik,' . $id,
            'nkk' => 'required|string|max:20',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'nama_ayah' => 'nullable|string|max:255',
            'nik_ayah' => 'nullable|string|max:20',
            'nama_ibu' => 'nullable|string|max:255',
            'nik_ibu' => 'nullable|string|max:20',
            'peran_jaringan' => 'required|in:koordinator informan,informan,kurir,gudang,broker,bandar,beking,tidak tahu',
            'modus_operasi' => 'nullable|string',
            'jenis_narkotika' => 'nullable|string',
            'skala_kelas' => 'required|in:dibawah 10gr,dibawah1ons,dibawah1kg,diatas1kg,tidak tahu',
            'status' => 'required|in:Napi,Non napi',
            'residivis' => 'boolean',
            'sumber_informasi' => 'nullable|in:informan,analisa sosmed,analisa aliran dana',
            'desa_geojson_id' => 'nullable|exists:desa_geojson,id'
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();
            $data['residivis'] = $request->has('residivis');

            // Find desa based on kelurahan
            if ($request->filled('kelurahan')) {
                $desa = DesaGeojson::where('nama_desa', 'like', '%' . $request->kelurahan . '%')
                    ->where('kecamatan', $request->kecamatan)
                    ->where('kabupaten', $request->kabupaten)
                    ->first();

                if ($desa) {
                    $data['desa_geojson_id'] = $desa->id;
                }
            }

            $individu->update($data);

            // Update kasus narkoba if status changed
            if ($request->status === 'Napi') {
                KasusNarkoba::updateOrCreate(
                    ['nik' => $request->nik],
                    [
                        'nama_desa' => $request->kelurahan,
                        'kecamatan' => $request->kecamatan,
                        'kabupaten' => $request->kabupaten,
                        'nama_tsk' => $request->nama,
                        'jenis_narkotika' => $request->jenis_narkotika,
                        'skala_kelas' => $request->skala_kelas,
                        'status' => $request->status,
                        'residivis' => $data['residivis'],
                        'peran_jaringan' => $request->peran_jaringan,
                        'modus_operasi' => $request->modus_operasi,
                        'sumber_informasi' => $request->sumber_informasi
                    ]
                );
            }

            DB::commit();

            return redirect()->route('super-admin.data.individu')
                ->with('success', 'Data individu TSK berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $individu = DataIndividuTsk::findOrFail($id);
            $individu->delete();

            return redirect()->route('super-admin.data.individu')
                ->with('success', 'Data individu TSK berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getData(Request $request)
    {
        $query = DataIndividuTsk::with('desaGeojson');

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
