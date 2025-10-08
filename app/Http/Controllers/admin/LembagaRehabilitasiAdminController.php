<?php

namespace App\Http\Controllers\admin;

use App\Models\LembagaRehabilitasi;
use App\Models\DesaGeojson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class LembagaRehabilitasiAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = LembagaRehabilitasi::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('nama_ketua', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%")
                    ->orWhere('jenis_lrehab', 'like', "%$q%");
            });
        }
        $lrehabList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.lrehab.index', compact('lrehabList'));
    }

    public function create()
    {
        $jenisLrehabOptions = LembagaRehabilitasi::getJenisLrehabOptions();
        $kabupatenList = \App\Models\DesaGeojson::query()
            ->where('kabupaten', 'not like', '%/%')
            ->where('kabupaten', 'not like', '%area%')
            ->where('kabupaten', 'not like', '%unknown%')
            ->distinct()
            ->pluck('kabupaten')
            ->sort()
            ->values();
        return view('admin.data.lrehab.create', compact('jenisLrehabOptions', 'kabupatenList'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Handle sertifikasi array
        if ($request->has('sertifikasi')) {
            $data['sertifikasi'] = $request->sertifikasi;
        } else {
            $data['sertifikasi'] = [];
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_lrehab' => 'required|in:LRIP,LRKM',
            'nama_ketua' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'provinsi' => 'required|string|max:100',
            'alamat' => 'required|string',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'provinsi_lain' => 'nullable|string|max:100',
            'kabupaten_lain' => 'nullable|string|max:100',
            'kecamatan_lain' => 'nullable|string|max:100',
            'kelurahan_lain' => 'nullable|string|max:100',
            'nomor_sni_nasional' => 'nullable|string|max:100',
            'nomor_sni_reguler' => 'nullable|string|max:100',
        ]);

        LembagaRehabilitasi::create($data);
        return redirect()->route('admin.data.lrehab.index')->with('success', 'Data lembaga rehabilitasi berhasil disimpan.');
    }

    public function show($id)
    {
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        return view('admin.data.lrehab.show', compact('lrehab'));
    }

    public function edit($id)
    {
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        $jenisLrehabOptions = LembagaRehabilitasi::getJenisLrehabOptions();
        $kabupatenList = \App\Models\DesaGeojson::query()
            ->where('kabupaten', 'not like', '%/%')
            ->where('kabupaten', 'not like', '%area%')
            ->where('kabupaten', 'not like', '%unknown%')
            ->distinct()
            ->pluck('kabupaten')
            ->sort()
            ->values();
        return view('admin.data.lrehab.edit', compact('lrehab', 'jenisLrehabOptions', 'kabupatenList'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        // Handle sertifikasi array
        if ($request->has('sertifikasi')) {
            $data['sertifikasi'] = $request->sertifikasi;
        } else {
            $data['sertifikasi'] = [];
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_lrehab' => 'required|in:LRIP,LRKM',
            'nama_ketua' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'provinsi' => 'required|string|max:100',
            'alamat' => 'required|string',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'provinsi_lain' => 'nullable|string|max:100',
            'kabupaten_lain' => 'nullable|string|max:100',
            'kecamatan_lain' => 'nullable|string|max:100',
            'kelurahan_lain' => 'nullable|string|max:100',
            'nomor_sni_nasional' => 'nullable|string|max:100',
            'nomor_sni_reguler' => 'nullable|string|max:100',
        ]);

        $lrehab = LembagaRehabilitasi::findOrFail($id);
        $lrehab->update($data);
        return redirect()->route('admin.data.lrehab.index')->with('success', 'Data lembaga rehabilitasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $lrehab = LembagaRehabilitasi::findOrFail($id);
        $lrehab->delete();
        return redirect()->route('admin.data.lrehab.index')->with('success', 'Data lembaga rehabilitasi berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "nama,jenis\n";

        // Set headers for download
        $filename = 'import_lrehab.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        // Output CSV content
        echo $csvContent;
        exit;
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        try {
            $file = $request->file('file');
            $handle = fopen($file->getPathname(), 'r');

            if (!$handle) {
                throw new \Exception('Tidak dapat membaca file');
            }

            $importedCount = 0;
            $duplicateCount = 0;
            $rowNumber = 0;

            while (($data = fgetcsv($handle)) !== false) {
                $rowNumber++;

                // Skip header row (row 1) and empty rows
                if ($rowNumber == 1 || empty(array_filter($data))) {
                    continue;
                }

                // Validate data structure
                if (count($data) < 2) {
                    continue;
                }

                $lrehabData = [
                    'nama' => trim($data[0] ?? ''),
                    'jenis' => trim($data[1] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (empty($lrehabData['nama']) || empty($lrehabData['jenis'])) {
                    continue;
                }

                // Validate jenis field
                if (!in_array($lrehabData['jenis'], ['IPWL', 'Rawat Inap', 'Non Rawat Inap', 'SNI Nasional', 'SNI Reguler'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'lembaga_rehabilitasi',
                    $lrehabData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    LembagaRehabilitasi::create($lrehabData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data lembaga rehabilitasi.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
