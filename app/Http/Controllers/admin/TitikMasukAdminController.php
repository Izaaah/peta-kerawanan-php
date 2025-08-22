<?php

namespace App\Http\Controllers\admin;

use App\Models\JalurMasuk;
use App\Models\DesaGeojson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class TitikMasukAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = JalurMasuk::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('jenis_transportasi', 'like', "%$q%")
                    ->orWhere('nama_tempat', 'like', "%$q%")
                    ->orWhere('provinsi', 'like', "%$q%")
                    ->orWhere('kabupaten', 'like', "%$q%")
                    ->orWhere('kecamatan', 'like', "%$q%")
                    ->orWhere('kelurahan', 'like', "%$q%");
            });
        }
        $titikMasukList = $query->latest()->paginate(10)->withQueryString();
            return view('admin.data.titik-masuk.index', compact('titikMasukList'));
    }

    public function create()
    {
        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();
        $desaList = DesaGeojson::all();

        $jenisTitikMasukOptions = JalurMasuk::getJenisTitikMasukOptions();
        return view('admin.data.titik-masuk.create', compact('jenisTitikMasukOptions', 'kabupatenList', 'kecamatanList', 'desaList'));
    }

    public function store(Request $request)
{
    $request->validate([
        'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
        'nama_tempat' => 'required|string|max:255',
        'provinsi' => 'required|string|max:255',
        'kabupaten' => 'required|string|max:255',
        'kecamatan' => 'required|string|max:255',
        'kelurahan' => 'required|string|max:255',
    ]);

    try {
        $data = $request->only([
            'jenis_transportasi','nama_tempat','provinsi','kabupaten','kecamatan','kelurahan'
        ]);
        $data['created_by'] = $request->user()->id; // set creator

        JalurMasuk::create($data);

        return redirect()->route('admin.data.titik-masuk.index')
            ->with('success', 'Data transportasi berhasil ditambahkan.');
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
            ->withInput();
    }
}

    public function show($id)
    {
        $jalurMasuk = JalurMasuk::findOrFail($id);
        return view('admin.data.titik-masuk.show', compact('jalurMasuk'));
    }

    public function edit($id)
    {
        $jalurMasuk = JalurMasuk::findOrFail($id);
        $jenisTitikMasukOptions = JalurMasuk::getJenisTitikMasukOptions();
        return view('admin.data.titik-masuk.edit', compact('jalurMasuk'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        $request->validate([
            'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
            'nama_tempat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);

        try {
            $jalurMasuk = JalurMasuk::findOrFail($id);
            $jalurMasuk->update($data);

            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $jalurMasuk = JalurMasuk::findOrFail($id);
            $jalurMasuk->delete();

            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "jenis_transportasi,nama_tempat,provinsi,kabupaten,kecamatan,kelurahan\n";

        // Set headers for download
        $filename = 'import_titik_masuk' . '.csv';

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
                if (count($data) < 4) {
                    continue;
                }

                $lsmData = [
                    'jenis_transportasi' => trim($data[0] ?? ''),
                    'nama_tempat' => trim($data[1] ?? ''),
                    'provinsi' => trim($data[2] ?? ''),
                    'kabupaten' => trim($data[3] ?? ''),
                    'kecamatan' => trim($data[4] ?? ''),
                    'kelurahan' => trim($data[5] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (empty($lsmData['jenis_transportasi']) || empty($lsmData['nama_tempat']) ||
                    empty($lsmData['provinsi']) || empty($lsmData['kabupaten']) ||
                    empty($lsmData['kecamatan']) || empty($lsmData['kelurahan'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'titik_masuk',
                    $lsmData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    JalurMasuk::create($lsmData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data Titik Masuk.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }

    }
}
