<?php

namespace App\Http\Controllers\admin;

use App\Models\DataIndividuTsk;
use App\Models\DesaGeojson;
use App\Models\KasusNarkoba;
use App\Models\TkpResidivisIndividu;
use App\Models\StatusHukum;
use App\Models\ResidivisDetail;
use App\Models\LembagaRehabilitasi;
use App\Models\CompulsaryStatus;
use App\Models\ProsesHukumStatus;
use App\Models\NarapidanaStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class DataIndividuTskAdminController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $userKabupaten = $user->name; // diasumsikan nama user = kabupaten/kota
        $userId = $user->id;

        $stats = [
            'total_individu' => DataIndividuTsk::where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            })->count(),
            'total_kasus' => KasusNarkoba::where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            })->count(),
            'residivis_count' => DataIndividuTsk::where('residivis', true)
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
            'non_residivis_count' => DataIndividuTsk::where('residivis', false)
                ->where(function ($query) use ($userId, $userKabupaten) {
                    $query->where('created_by', $userId)
                        ->orWhere(function ($q) use ($userKabupaten) {
                            $q->whereNull('created_by')
                                ->where('kabupaten', $userKabupaten);
                        });
                })->count(),
        ];

        $sampleData = DataIndividuTsk::with(['desaGeojson', 'createdBy'])
            ->where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();

        return view('admin.data.individu.individu', compact('stats', 'sampleData', 'kabupatenList', 'kecamatanList'));
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

    public function create()
    {
        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();
        $desaList = DesaGeojson::all();

        // Get lembaga rehabilitasi with IPWL certification
        $ipwlList = LembagaRehabilitasi::whereJsonContains('sertifikasi', 'IPWL')->get();

        return view('admin.data.individu.individu-create', compact('kabupatenList', 'kecamatanList', 'desaList', 'ipwlList'));
    }


    public function store(Request $request)
    {
        // Check if this is a verification submission first
        if ($request->has('submit_for_verification')) {
            // Minimal validation for verification submission
            $verificationValidationRules = [
                'nik' => 'required|string|max:20',
                'existing_data' => 'required|string',
                'submit_for_verification' => 'required|string',
            ];

            $request->validate($verificationValidationRules);

            Log::info('Verification submission received', [
                'user_id' => $request->user()->id,
                'csrf_token' => $request->input('_token'),
                'session_token' => session()->token(),
                'existing_data' => $request->input('existing_data')
            ]);

            $existingData = json_decode($request->existing_data, true);

            // Create minimal data for verification
            $data = [
                'nama' => $request->nama ?? '',
                'nik' => $request->nik,
                'nkk' => $request->nkk ?? '',
                'jenis_kelamin' => $request->jenis_kelamin ?? '',
                'tempat_lahir' => $request->tempat_lahir ?? '',
                'tgl_lahir' => $request->tgl_lahir ?? '',
                'provinsi' => $request->provinsi ?? '',
                'kabupaten' => $request->kabupaten ?? '',
                'kecamatan' => $request->kecamatan ?? '',
                'kelurahan' => $request->kelurahan ?? '',
                'alamat' => $request->alamat ?? '',
                'nama_ayah' => $request->nama_ayah ?? '',
                'nik_ayah' => $request->nik_ayah ?? '',
                'nama_ibu' => $request->nama_ibu ?? '',
                'nik_ibu' => $request->nik_ibu ?? '',
                'peran_jaringan' => $request->peran_jaringan ?? '',
                'modus_operasi' => $request->modus_operasi ?? '',
                'jenis_narkotika' => is_array($request->jenis_narkotika) ? implode(',', $request->jenis_narkotika) : ($request->jenis_narkotika ?? ''),
                'jumlah_barang_bukti' => $request->angka ?? '',
                'satuan_barang_bukti' => $request->satuan ?? '',
                'status' => $request->status ?? '',
                'residivis' => $request->has('residivis'),
                'sumber_informasi' => $request->sumber_informasi ?? '',
                'ipwl_id' => $request->ipwl_id ?? '',
                'created_by' => request()->user()->id,
            ];

            $isDuplicate = \App\Services\DuplicateDetectionService::checkAndCreateVerification(
                'data_individu_tsk',
                $data,
                $request->user()->id,
                $existingData['id'] ?? null
            );

            if ($isDuplicate) {
                return response()->json([
                    'success' => true,
                    'message' => 'Permintaan verifikasi edit telah dikirim ke Super Admin. Data akan ditinjau dan diproses.',
                    'redirect' => route('admin.data.individu')
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat permintaan verifikasi.'
            ]);
        }

        // Full validation for normal submission
        $validationRules = [
            'nik' => 'required|string|max:20',
            'nkk' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'alamat' => 'required|string',
            'status' => 'nullable|string|max:50',
            'peran_jaringan' => 'nullable|string|max:50',
            'residivis' => 'nullable|boolean',
            'sumber_informasi' => 'nullable|string|max:50',
            'angka' => 'nullable|string|max:50',
            'satuan' => 'nullable|string|max:50',
            'telepon' => 'nullable|array',
            'rekening' => 'nullable|array',
            'ewallet' => 'nullable|array',
            'nama_keluarga_lain' => 'nullable|array',
            'nik_keluarga_lain' => 'nullable|array',
            'aph_menangani' => 'nullable|array',
            'pasal_disangkakan' => 'nullable|array',
            'vonis' => 'nullable|array',
            'lapas_akhir' => 'nullable|array',
            'foto' => 'nullable|array',
            'foto.*' => 'nullable|file|image|max:2048',
            'ipwl_id' => 'nullable|exists:lembaga_rehabilitasi,id',
            'ipwl_compulsary_id' => 'nullable|exists:lembaga_rehabilitasi,id',
            'rekomendasi' => 'nullable|array',
            'rekomendasi.*' => 'nullable|string|max:255',
            'putusan_pengadilan' => 'nullable|array',
            'putusan_pengadilan.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            // New validation rules for dynamic fields
            'noKasus' => 'nullable|array',
            'noKasus.*' => 'nullable|string|max:255',
            'noKasus_prosesHukum' => 'nullable|array',
            'noKasus_prosesHukum.*' => 'nullable|string|max:255',
            'noKasus_narapidana' => 'nullable|array',
            'noKasus_narapidana.*' => 'nullable|string|max:255',
            'file_residivis' => 'nullable|array',
            'file_residivis.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'vonis_residivis' => 'nullable|array',
            'vonis_residivis.*' => 'nullable|string|max:255',
            'lapas_akhir_residivis' => 'nullable|array',
            'lapas_akhir_residivis.*' => 'nullable|string|max:255',
            // Compulsary fields validation (new format)
            'no_kasus' => 'nullable|array',
            'no_kasus.*' => 'nullable|string|max:255',
            'tanggal_kasus' => 'nullable|date',
            'satuan_kerja' => 'nullable|string|max:255',
            // Support old field names for backward compatibility
            'tgl-kasus' => 'nullable|date',
            'satker' => 'nullable|string|max:255',
        ];

        $request->validate($validationRules);

        $data = [
            'nama' => $request->nama ?? '',
            'nik' => $request->nik,
            'nkk' => $request->nkk ?? '',
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'provinsi' => $request->provinsi ?? '',
            'kabupaten' => $request->kabupaten ?? '',
            'kecamatan' => $request->kecamatan ?? '',
            'kelurahan' => $request->kelurahan ?? '',
            'alamat' => $request->alamat ?? '',
            'nama_ayah' => $request->nama_ayah,
            'nik_ayah' => $request->nik_ayah,
            'nama_ibu' => $request->nama_ibu,
            'nik_ibu' => $request->nik_ibu,
            'peran_jaringan' => $request->peran_jaringan ?? '',
            'modus_operasi' => $request->modus_operasi ?? '',
            'jenis_narkotika' => is_array($request->jenis_narkotika) ? implode(',', $request->jenis_narkotika) : ($request->jenis_narkotika ?? ''),
            'jumlah_barang_bukti' => $request->angka ?? '',
            'satuan_barang_bukti' => $request->satuan ?? '',
            'status' => $request->status ?? '',
            'residivis' => $request->has('residivis'),
            'sumber_informasi' => $request->sumber_informasi,
            'ipwl_id' => $request->ipwl_id,
            'created_by' => request()->user()->id,
        ];

        // Check for duplicates for normal submission
        $isDuplicate = \App\Services\DuplicateDetectionService::checkAndCreateVerification(
            'data_individu_tsk',
            $data,
            $request->user()->id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Data akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Simpan data individu
            $individu = DataIndividuTsk::create($data);

            // Handle status-specific data using separate tables
            if ($request->status == 'Compulsary') {
                // Create Compulsary status
                $compulsaryData = [
                    'individu_id' => $individu->id,
                    'no_kasus' => is_array($request->no_kasus) ? implode(',', array_filter($request->no_kasus)) : ($request->no_kasus ?? ''),
                    'tanggal_kasus' => $request->tanggal_kasus,
                    'satuan_kerja' => $request->satuan_kerja,
                    'aph_menangani' => is_array($request->aph_menangani) ? implode(',', array_filter($request->aph_menangani)) : ($request->aph_menangani ?? ''),
                    'pasal_disangkakan' => is_array($request->pasal_disangkakan) ? implode(',', array_filter($request->pasal_disangkakan)) : ($request->pasal_disangkakan ?? ''),
                    'ipwl_id' => $request->ipwl_compulsary_id,
                    'rekomendasi' => is_array($request->rekomendasi) ? implode(',', array_filter($request->rekomendasi)) : ($request->rekomendasi ?? ''),
                ];

                \App\Models\CompulsaryStatus::create($compulsaryData);
            } elseif ($request->status == 'Proses Hukum Lanjut') {
                // Create Proses Hukum status
                $prosesData = [
                    'individu_id' => $individu->id,
                    'no_kasus' => is_array($request->no_kasus_proses) ? implode(',', array_filter($request->no_kasus_proses)) : ($request->no_kasus_proses ?? ''),
                    'tanggal_kasus' => $request->tanggal_kasus_proses,
                    'satuan_kerja' => $request->satuan_kerja_proses,
                    'aph_menangani' => is_array($request->aph_menangani_proses) ? implode(',', array_filter($request->aph_menangani_proses)) : ($request->aph_menangani_proses ?? ''),
                    'pasal_disangkakan' => is_array($request->pasal_disangkakan_proses) ? implode(',', array_filter($request->pasal_disangkakan_proses)) : ($request->pasal_disangkakan_proses ?? ''),
                    'ipwl_id' => $request->ipwl_proses_id,
                    'rekomendasi' => is_array($request->rekomendasi_proses) ? implode(',', array_filter($request->rekomendasi_proses)) : ($request->rekomendasi_proses ?? ''),
                ];

                \App\Models\ProsesHukumStatus::create($prosesData);
            } elseif ($request->status == 'Narapidana') {
                // Create Narapidana status
                $narapidanaData = [
                    'individu_id' => $individu->id,
                    'no_kasus' => is_array($request->no_kasus_narapidana) ? implode(',', array_filter($request->no_kasus_narapidana)) : ($request->no_kasus_narapidana ?? ''),
                    'tanggal_kasus' => $request->tanggal_kasus_narapidana,
                    'satuan_kerja' => $request->satuan_kerja_narapidana,
                    'aph_menangani' => is_array($request->aph_menangani_narapidana) ? implode(',', array_filter($request->aph_menangani_narapidana)) : ($request->aph_menangani_narapidana ?? ''),
                    'pasal_disangkakan' => is_array($request->pasal_disangkakan_narapidana) ? implode(',', array_filter($request->pasal_disangkakan_narapidana)) : ($request->pasal_disangkakan_narapidana ?? ''),
                    'ipwl_id' => $request->ipwl_narapidana_id,
                    'rekomendasi' => is_array($request->rekomendasi_narapidana) ? implode(',', array_filter($request->rekomendasi_narapidana)) : ($request->rekomendasi_narapidana ?? ''),
                ];

                \App\Models\NarapidanaStatus::create($narapidanaData);
            }

            // Menyimpan data terkait telepon
            if ($request->filled('telepon')) {
                foreach ($request->telepon as $telp) {
                    if ($telp) {
                        $individu->telepon()->create(['nomor_telepon' => $telp]);
                    }
                }
            }

            // Menyimpan data rekening
            if ($request->filled('rekening')) {
                foreach ($request->rekening as $rek) {
                    if ($rek) {
                        $individu->rekening()->create(['no_rekening' => $rek]);
                    }
                }
            }

            // Menyimpan data e-wallet
            if ($request->filled('ewallet')) {
                foreach ($request->ewallet as $ew) {
                    if ($ew) {
                        $individu->ewallet()->create(['no_ewallet' => $ew]);
                    }
                }
            }

            // Menyimpan data keluarga lain
            if ($request->filled('nama_keluarga_lain') && $request->filled('nik_keluarga_lain')) {
                foreach ($request->nama_keluarga_lain as $i => $nama) {
                    $nik = $request->nik_keluarga_lain[$i] ?? null;
                    if ($nama || $nik) {
                        $individu->keluargaLain()->create(['nama' => $nama, 'nik' => $nik]);
                    }
                }
            }

            // Menyimpan detail residivis
            if ($request->filled('aph_menangani') && $request->filled('pasal_disangkakan') && $request->filled('vonis') && $request->filled('lapas_akhir')) {
                foreach ($request->aph_menangani as $i => $aph) {
                    $pasal = $request->pasal_disangkakan[$i] ?? null;
                    $vonis = $request->vonis[$i] ?? null;
                    $lapas = $request->lapas_akhir[$i] ?? null;
                    if ($aph || $pasal || $vonis || $lapas) {
                        $individu->residivisDetail()->create([
                            'aph_menangani' => $aph,
                            'pasal_disangkakan' => $pasal,
                            'vonis' => $vonis,
                            'lapas_akhir' => $lapas,
                        ]);
                    }
                }
            }

            // Menyimpan foto jika ada
            if ($request->filled('foto')) {
                foreach ($request->file('foto') as $i => $foto) {
                    if ($foto && $foto->isValid()) {
                        $keterangan = $request->keterangan_foto[$i] ?? null;
                        $path = $foto->store('foto-individu', 'public');
                        $individu->foto()->create(['path' => $path, 'keterangan' => $keterangan]);
                    }
                }
            }

            // Menyimpan file putusan pengadilan jika ada
            if ($request->filled('putusan_pengadilan')) {
                $putusanPaths = [];
                foreach ($request->file('putusan_pengadilan') as $putusan) {
                    if ($putusan && $putusan->isValid()) {
                        $path = $putusan->store('putusan-pengadilan', 'public');
                        $putusanPaths[] = $path;
                    }
                }
                $individu->update(['putusan_pengadilan' => implode(',', $putusanPaths)]);
            }

            // Menyimpan file residivis jika ada
            if ($request->filled('file_residivis')) {
                $fileResidivisPaths = [];
                foreach ($request->file('file_residivis') as $file) {
                    if ($file && $file->isValid()) {
                        $path = $file->store('file-residivis', 'public');
                        $fileResidivisPaths[] = $path;
                    }
                }
                $individu->update(['file_residivis' => implode(',', $fileResidivisPaths)]);
            }

            // Menyimpan vonis residivis jika ada
            if ($request->filled('vonis_residivis')) {
                $vonisResidivis = array_filter($request->vonis_residivis);
                $individu->update(['vonis_residivis' => implode(',', $vonisResidivis)]);
            }

            // Menyimpan lapas akhir residivis jika ada
            if ($request->filled('lapas_akhir_residivis')) {
                $lapasAkhirResidivis = array_filter($request->lapas_akhir_residivis);
                $individu->update(['lapas_akhir_residivis' => implode(',', $lapasAkhirResidivis)]);
            }

            DB::commit();
            return redirect()->route('admin.data.individu')->with('success', 'Data individu berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $individu = DataIndividuTsk::with(['desaGeojson', 'telepon', 'rekening', 'ewallet', 'keluargaLain', 'residivisDetail', 'foto', 'compulsaryStatus.ipwlLembaga', 'prosesHukumStatus.ipwlLembaga', 'narapidanaStatus.ipwlLembaga'])
            ->findOrFail($id);

        $kasusCount = KasusNarkoba::where('nama_desa', $individu->kelurahan)
            ->where('kecamatan', $individu->kecamatan)
            ->where('kabupaten', $individu->kabupaten)
            ->count();

        return view('admin.data.individu.individu-show', compact('individu', 'kasusCount'));
    }

    public function edit($id)
    {
        $individu = DataIndividuTsk::with([
            'telepon',
            'rekening',
            'ewallet',
            'tkpResidivis',
            'compulsaryStatus',
            'prosesHukumStatus',
            'narapidanaStatus'
        ])->findOrFail($id);

        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();
        $desaList = DesaGeojson::all();

        // Get IPWL list for dropdowns
        $ipwlList = \App\Models\LembagaRehabilitasi::all();

        return view('admin.data.individu.individu-edit', compact('individu', 'kabupatenList', 'kecamatanList', 'desaList', 'ipwlList'));
    }

    public function update(Request $request, $id)
    {
        $individu = DataIndividuTsk::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20|unique:data_individu_tsk,nik,' . $id,
            'nkk' => 'required|string|max:16',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'provinsi' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'nama_ayah' => 'nullable|string|max:255',
            'nik_ayah' => 'nullable|string|max:20',
            'nama_ibu' => 'nullable|string|max:255',
            'nik_ibu' => 'nullable|string|max:20',
            'peran_jaringan' => 'nullable|string|max:50',
            'modus_operasi' => 'nullable|string',
            'jenis_narkotika' => 'nullable|array',
            'jenis_narkotika.*' => 'nullable|string|max:255',
            'jumlah_barang_bukti' => 'nullable|string|max:50',
            'satuan_barang_bukti' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'residivis' => 'boolean',
            'sumber_informasi' => 'nullable|in:informan,analisa sosmed,analisa aliran dana',
            'desa_geojson_id' => 'nullable|exists:desa_geojson,id',
            'telepon' => 'nullable|array',
            'telepon.*' => 'nullable|string|max:20',
            'rekening' => 'nullable|array',
            'rekening.*' => 'nullable|string|max:30',
            'ewallet' => 'nullable|array',
            'ewallet.*' => 'nullable|string|max:30',
            'angka' => 'nullable|string|max:50',
            'satuan' => 'nullable|string|max:50',
            // Compulsary fields
            'no_kasus' => 'nullable|array',
            'no_kasus.*' => 'nullable|string|max:255',
            'tanggal_kasus' => 'nullable|date',
            'satuan_kerja' => 'nullable|string|max:255',
            'aph_menangani' => 'nullable|array',
            'aph_menangani.*' => 'nullable|string|max:255',
            'pasal_disangkakan' => 'nullable|array',
            'pasal_disangkakan.*' => 'nullable|string|max:255',
            'ipwl_compulsary_id' => 'nullable|exists:lembaga_rehabilitasi,id',
            'rekomendasi' => 'nullable|array',
            'rekomendasi.*' => 'nullable|string|max:255',
            // Proses Hukum Lanjut fields
            'no_kasus_proses' => 'nullable|array',
            'no_kasus_proses.*' => 'nullable|string|max:255',
            'tanggal_kasus_proses' => 'nullable|date',
            'satuan_kerja_proses' => 'nullable|string|max:255',
            'aph_menangani_proses' => 'nullable|array',
            'aph_menangani_proses.*' => 'nullable|string|max:255',
            'pasal_disangkakan_proses' => 'nullable|array',
            'pasal_disangkakan_proses.*' => 'nullable|string|max:255',
            'ipwl_proses_id' => 'nullable|exists:lembaga_rehabilitasi,id',
            'rekomendasi_proses' => 'nullable|array',
            'rekomendasi_proses.*' => 'nullable|string|max:255',
            // Narapidana fields
            'no_kasus_narapidana' => 'nullable|array',
            'no_kasus_narapidana.*' => 'nullable|string|max:255',
            'tanggal_kasus_narapidana' => 'nullable|date',
            'satuan_kerja_narapidana' => 'nullable|string|max:255',
            'aph_menangani_narapidana' => 'nullable|array',
            'aph_menangani_narapidana.*' => 'nullable|string|max:255',
            'pasal_disangkakan_narapidana' => 'nullable|array',
            'pasal_disangkakan_narapidana.*' => 'nullable|string|max:255',
            'ipwl_narapidana_id' => 'nullable|exists:lembaga_rehabilitasi,id',
            'rekomendasi_narapidana' => 'nullable|array',
            'rekomendasi_narapidana.*' => 'nullable|string|max:255',
            // TKP fields
            'tkp_provinsi' => 'nullable|array',
            'tkp_provinsi.*' => 'nullable|string|max:100',
            'tkp_kabupaten' => 'nullable|array',
            'tkp_kabupaten.*' => 'nullable|string|max:100',
            'tkp_kecamatan' => 'nullable|array',
            'tkp_kecamatan.*' => 'nullable|string|max:100',
            'tkp_desa' => 'nullable|array',
            'tkp_desa.*' => 'nullable|string|max:100',
            'tkp_lokasi' => 'nullable|array',
            'tkp_lokasi.*' => 'nullable|string|max:255',
            // TKP fields for status-specific forms
            'tkp_provinsi_proses' => 'nullable|array',
            'tkp_provinsi_proses.*' => 'nullable|string|max:100',
            'tkp_kabupaten_proses' => 'nullable|array',
            'tkp_kabupaten_proses.*' => 'nullable|string|max:100',
            'tkp_kecamatan_proses' => 'nullable|array',
            'tkp_kecamatan_proses.*' => 'nullable|string|max:100',
            'tkp_desa_proses' => 'nullable|array',
            'tkp_desa_proses.*' => 'nullable|string|max:100',
            'tkp_lokasi_proses' => 'nullable|array',
            'tkp_lokasi_proses.*' => 'nullable|string|max:255',
            'tkp_provinsi_narapidana' => 'nullable|array',
            'tkp_provinsi_narapidana.*' => 'nullable|string|max:100',
            'tkp_kabupaten_narapidana' => 'nullable|array',
            'tkp_kabupaten_narapidana.*' => 'nullable|string|max:100',
            'tkp_kecamatan_narapidana' => 'nullable|array',
            'tkp_kecamatan_narapidana.*' => 'nullable|string|max:100',
            'tkp_desa_narapidana' => 'nullable|array',
            'tkp_desa_narapidana.*' => 'nullable|string|max:100',
            'tkp_lokasi_narapidana' => 'nullable|array',
            'tkp_lokasi_narapidana.*' => 'nullable|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            $data = [
                'nama' => $request->nama,
                'nik' => $request->nik,
                'nkk' => $request->nkk,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
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
                'jenis_narkotika' => is_array($request->jenis_narkotika) ? implode(',', $request->jenis_narkotika) : ($request->jenis_narkotika ?? ''),
                'jumlah_barang_bukti' => $request->angka ?? '',
                'satuan_barang_bukti' => $request->satuan ?? '',
                'status' => $request->status,
                'residivis' => $request->residivis ?? 0,
                'sumber_informasi' => $request->sumber_informasi,
            ];

            // Update main individu data
            $individu->update($data);

            // Handle status-specific data using separate tables
            if ($request->status == 'Compulsary') {
                // Handle TKP data for Compulsary
                $tkpData = [];
                if ($request->tkp_provinsi && is_array($request->tkp_provinsi)) {
                    for ($i = 0; $i < count($request->tkp_provinsi); $i++) {
                        if (!empty($request->tkp_provinsi[$i])) {
                            $tkpData[] = [
                                'provinsi' => $request->tkp_provinsi[$i],
                                'kabupaten' => $request->tkp_kabupaten[$i] ?? '',
                                'kecamatan' => $request->tkp_kecamatan[$i] ?? '',
                                'desa' => $request->tkp_desa[$i] ?? '',
                                'lokasi' => $request->tkp_lokasi[$i] ?? '',
                            ];
                        }
                    }
                }

                // Update or create Compulsary status
                $compulsaryData = [
                    'no_kasus' => is_array($request->no_kasus) ? implode(',', array_filter($request->no_kasus)) : ($request->no_kasus ?? ''),
                    'tanggal_kasus' => $request->tanggal_kasus,
                    'satuan_kerja' => $request->satuan_kerja,
                    'aph_menangani' => is_array($request->aph_menangani) ? implode(',', array_filter($request->aph_menangani)) : ($request->aph_menangani ?? ''),
                    'pasal_disangkakan' => is_array($request->pasal_disangkakan) ? implode(',', array_filter($request->pasal_disangkakan)) : ($request->pasal_disangkakan ?? ''),
                    'ipwl_id' => $request->ipwl_compulsary_id,
                    'rekomendasi' => is_array($request->rekomendasi) ? implode(',', array_filter($request->rekomendasi)) : ($request->rekomendasi ?? ''),
                    'tkp_lokasi' => !empty($tkpData) ? json_encode($tkpData) : null,
                ];

                $individu->compulsaryStatus()->updateOrCreate(['individu_id' => $individu->id], $compulsaryData);
            } elseif ($request->status == 'Proses Hukum Lanjut') {
                // Handle TKP data for Proses Hukum
                $tkpData = [];
                if ($request->tkp_provinsi_proses && is_array($request->tkp_provinsi_proses)) {
                    for ($i = 0; $i < count($request->tkp_provinsi_proses); $i++) {
                        if (!empty($request->tkp_provinsi_proses[$i])) {
                            $tkpData[] = [
                                'provinsi' => $request->tkp_provinsi_proses[$i],
                                'kabupaten' => $request->tkp_kabupaten_proses[$i] ?? '',
                                'kecamatan' => $request->tkp_kecamatan_proses[$i] ?? '',
                                'desa' => $request->tkp_desa_proses[$i] ?? '',
                                'lokasi' => $request->tkp_lokasi_proses[$i] ?? '',
                            ];
                        }
                    }
                }

                // Update or create Proses Hukum status
                $prosesData = [
                    'no_kasus' => is_array($request->no_kasus_proses) ? implode(',', array_filter($request->no_kasus_proses)) : ($request->no_kasus_proses ?? ''),
                    'tanggal_kasus' => $request->tanggal_kasus_proses,
                    'satuan_kerja' => $request->satuan_kerja_proses,
                    'aph_menangani' => is_array($request->aph_menangani_proses) ? implode(',', array_filter($request->aph_menangani_proses)) : ($request->aph_menangani_proses ?? ''),
                    'pasal_disangkakan' => is_array($request->pasal_disangkakan_proses) ? implode(',', array_filter($request->pasal_disangkakan_proses)) : ($request->pasal_disangkakan_proses ?? ''),
                    'ipwl_id' => $request->ipwl_proses_id,
                    'rekomendasi' => is_array($request->rekomendasi_proses) ? implode(',', array_filter($request->rekomendasi_proses)) : ($request->rekomendasi_proses ?? ''),
                    'tkp_lokasi' => !empty($tkpData) ? json_encode($tkpData) : null,
                ];

                $individu->prosesHukumStatus()->updateOrCreate(['individu_id' => $individu->id], $prosesData);
            } elseif ($request->status == 'Narapidana') {
                // Handle TKP data for Narapidana
                $tkpData = [];
                if ($request->tkp_provinsi_narapidana && is_array($request->tkp_provinsi_narapidana)) {
                    for ($i = 0; $i < count($request->tkp_provinsi_narapidana); $i++) {
                        if (!empty($request->tkp_provinsi_narapidana[$i])) {
                            $tkpData[] = [
                                'provinsi' => $request->tkp_provinsi_narapidana[$i],
                                'kabupaten' => $request->tkp_kabupaten_narapidana[$i] ?? '',
                                'kecamatan' => $request->tkp_kecamatan_narapidana[$i] ?? '',
                                'desa' => $request->tkp_desa_narapidana[$i] ?? '',
                                'lokasi' => $request->tkp_lokasi_narapidana[$i] ?? '',
                            ];
                        }
                    }
                }

                // Update or create Narapidana status
                $narapidanaData = [
                    'no_kasus' => is_array($request->no_kasus_narapidana) ? implode(',', array_filter($request->no_kasus_narapidana)) : ($request->no_kasus_narapidana ?? ''),
                    'tanggal_kasus' => $request->tanggal_kasus_narapidana,
                    'satuan_kerja' => $request->satuan_kerja_narapidana,
                    'aph_menangani' => is_array($request->aph_menangani_narapidana) ? implode(',', array_filter($request->aph_menangani_narapidana)) : ($request->aph_menangani_narapidana ?? ''),
                    'pasal_disangkakan' => is_array($request->pasal_disangkakan_narapidana) ? implode(',', array_filter($request->pasal_disangkakan_narapidana)) : ($request->pasal_disangkakan_narapidana ?? ''),
                    'ipwl_id' => $request->ipwl_narapidana_id,
                    'rekomendasi' => is_array($request->rekomendasi_narapidana) ? implode(',', array_filter($request->rekomendasi_narapidana)) : ($request->rekomendasi_narapidana ?? ''),
                    'tkp_lokasi' => !empty($tkpData) ? json_encode($tkpData) : null,
                ];

                $individu->narapidanaStatus()->updateOrCreate(['individu_id' => $individu->id], $narapidanaData);
            }


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

            // Update telepon
            $individu->telepon()->delete(); // Hapus semua telepon lama
            if ($request->filled('telepon')) {
                foreach ($request->telepon as $telp) {
                    if ($telp) {
                        $individu->telepon()->create(['nomor_telepon' => $telp]);
                    }
                }
            }

            // Update rekening
            $individu->rekening()->delete(); // Hapus semua rekening lama
            if ($request->filled('rekening')) {
                foreach ($request->rekening as $rek) {
                    if ($rek) {
                        $individu->rekening()->create(['no_rekening' => $rek]);
                    }
                }
            }

            // Update ewallet
            $individu->ewallet()->delete(); // Hapus semua ewallet lama
            if ($request->filled('ewallet')) {
                foreach ($request->ewallet as $ew) {
                    if ($ew) {
                        $individu->ewallet()->create(['no_ewallet' => $ew]);
                    }
                }
            }

            // Update TKP data
            $individu->tkpResidivis()->delete(); // Hapus semua TKP lama
            if ($request->filled('tkp_provinsi') && $request->filled('tkp_kabupaten')) {
                foreach ($request->tkp_provinsi as $i => $provinsi) {
                    if (!empty($provinsi) && !empty($request->tkp_kabupaten[$i])) {
                        $individu->tkpResidivis()->create([
                            'provinsi' => $provinsi,
                            'kabupaten' => $request->tkp_kabupaten[$i] ?? '',
                            'kecamatan' => $request->tkp_kecamatan[$i] ?? '',
                            'desa' => $request->tkp_desa[$i] ?? '',
                            'lokasi' => $request->tkp_lokasi[$i] ?? '',
                            'created_by' => request()->user()->id
                        ]);
                    }
                }
            }

            // Note: kasus_narkoba table only has basic fields (nama_desa, kecamatan, kabupaten, keterangan)
            // Individual data is stored in data_individu_tsk and related status tables

            DB::commit();

            return redirect()->route('admin.data.individu')
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

            return redirect()->route('admin.data.individu')
                ->with('success', 'Data individu TSK berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getData(Request $request)
    {
        $user = request()->user();
        $userKabupaten = $user->name; // diasumsikan nama user = kabupaten/kota
        $userId = $user->id;

        $query = DataIndividuTsk::with('desaGeojson')
            ->where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            });

        // Apply filters
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
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
        $user = request()->user();
        $userKabupaten = $user->name; // diasumsikan nama user = kabupaten/kota
        $userId = $user->id;

        $query = DataIndividuTsk::with('desaGeojson')
            ->where(function ($query) use ($userId, $userKabupaten) {
                $query->where('created_by', $userId)
                    ->orWhere(function ($q) use ($userKabupaten) {
                        $q->whereNull('created_by')
                            ->where('kabupaten', $userKabupaten);
                    });
            });

        // Apply same filters as getData
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
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

    public function checkNik(Request $request)
    {
        $nik = $request->query('nik');

        if (!$nik || strlen($nik) !== 16) {
            return response()->json([
                'exists' => false,
                'message' => 'NIK harus 16 digit'
            ]);
        }

        $existingIndividu = DataIndividuTsk::where('nik', $nik)->first();

        if ($existingIndividu) {
            return response()->json([
                'exists' => true,
                'message' => 'NIK sudah terdaftar dalam sistem',
                'data' => [
                    'id' => $existingIndividu->id,
                    'nama' => $existingIndividu->nama,
                    'nik' => $existingIndividu->nik,
                    'nkk' => $existingIndividu->nkk,
                    'provinsi' => $existingIndividu->provinsi,
                    'kabupaten' => $existingIndividu->kabupaten,
                    'kecamatan' => $existingIndividu->kecamatan,
                    'kelurahan' => $existingIndividu->kelurahan,
                    'alamat' => $existingIndividu->alamat,
                    'status' => $existingIndividu->status,
                    'peran_jaringan' => $existingIndividu->peran_jaringan,
                    'residivis' => $existingIndividu->residivis,
                    'jenis_narkotika' => $existingIndividu->jenis_narkotika,
                    'skala_kelas' => $existingIndividu->skala_kelas,
                    'sumber_informasi' => $existingIndividu->sumber_informasi,
                ]
            ]);
        }

        return response()->json([
            'exists' => false,
            'message' => 'NIK belum terdaftar'
        ]);
    }

    public function searchIndividuByNik(Request $request)
    {
        $nik = $request->query('nik');
        $onlyNarapidana = (bool) $request->query('onlyNarapidana', false);

        if (!$nik || strlen($nik) !== 16) {
            return response()->json([
                'success' => false,
                'message' => 'NIK harus 16 digit'
            ]);
        }

        $query = DataIndividuTsk::where('nik', $nik);
        if ($onlyNarapidana) {
            $query->where('status', 'Narapidana');
        }
        $individu = $query->first();

        if ($individu) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $individu->id,
                    'nama' => $individu->nama,
                    'nik' => $individu->nik,
                    'kabupaten' => $individu->kabupaten,
                    'kecamatan' => $individu->kecamatan,
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Individu tidak ditemukan'
        ]);
    }
}
