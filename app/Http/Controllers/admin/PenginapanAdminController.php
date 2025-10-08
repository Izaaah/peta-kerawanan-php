<?php

namespace App\Http\Controllers\admin;

use App\Models\DesaGeojson;
use App\Models\Penginapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class PenginapanAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Penginapan::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('jenis', 'like', "%$q%")
                    ->orWhere('nama_pengelola', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $penginapanList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.penginapan.index', compact('penginapanList'));
    }

    public function create()
    {
        $jenisOptions = Penginapan::getJenisOptions();
        $kabupatenList = DesaGeojson::whereNotNull('kabupaten')
            ->where('kabupaten', 'not like', '%/%')
            ->where('kabupaten', 'not like', '%area%')
            ->where('kabupaten', 'not like', '%unknown%')
            ->distinct()
            ->pluck('kabupaten')
            ->sort()
            ->values();

        return view('admin.data.penginapan.create', compact('jenisOptions', 'kabupatenList'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:Hotel,Apartemen,Losmen,Kontrakan,Kost',
            'nama_pengelola' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'provinsi' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'provinsi_lain' => 'nullable|string',
            'kabupaten_lain' => 'nullable|string',
            'kecamatan_lain' => 'nullable|string',
            'kelurahan_lain' => 'nullable|string',
        ]);
        Penginapan::create($data);
        return redirect()->route('admin.data.penginapan.index')->with('success', 'Data penginapan berhasil disimpan.');
    }

    public function show($id)
    {
        $penginapan = Penginapan::findOrFail($id);
        return view('admin.data.penginapan.show', compact('penginapan'));
    }

    public function edit($id)
    {
        $penginapan = Penginapan::findOrFail($id);
        $jenisOptions = Penginapan::getJenisOptions();
        $kabupatenList = DesaGeojson::whereNotNull('kabupaten')
            ->where('kabupaten', 'not like', '%/%')
            ->where('kabupaten', 'not like', '%area%')
            ->where('kabupaten', 'not like', '%unknown%')
            ->distinct()
            ->pluck('kabupaten')
            ->sort()
            ->values();

        return view('admin.data.penginapan.edit', compact('penginapan', 'jenisOptions', 'kabupatenList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|in:Hotel,Apartemen,Losmen,Kontrakan,Kost',
            'nama_pengelola' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'provinsi' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'provinsi_lain' => 'nullable|string',
            'kabupaten_lain' => 'nullable|string',
            'kecamatan_lain' => 'nullable|string',
            'kelurahan_lain' => 'nullable|string',
        ]);
        $penginapan = Penginapan::findOrFail($id);
        $penginapan->update($request->all());
        return redirect()->route('admin.data.penginapan.index')->with('success', 'Data penginapan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $penginapan = Penginapan::findOrFail($id);
        $penginapan->delete();
        return redirect()->route('admin.data.penginapan.index')->with('success', 'Data penginapan berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "nama,jenis,nama_pengelola,no_hp,lokasi\n";

        // Set headers for download
        $filename = 'import_penginapan.csv';

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
                if (count($data) < 5) {
                    continue;
                }

                $penginapanData = [
                    'nama' => trim($data[0] ?? ''),
                    'jenis' => trim($data[1] ?? ''),
                    'nama_pengelola' => trim($data[2] ?? ''),
                    'no_hp' => trim($data[3] ?? ''),
                    'lokasi' => trim($data[4] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (
                    empty($penginapanData['nama']) || empty($penginapanData['jenis']) ||
                    empty($penginapanData['nama_pengelola']) || empty($penginapanData['no_hp']) ||
                    empty($penginapanData['lokasi'])
                ) {
                    continue;
                }

                // Validate jenis field
                if (!in_array($penginapanData['jenis'], ['Hotel', 'Apartemen', 'Losmen', 'Kontrakan', 'Kost'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'penginapan',
                    $penginapanData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    Penginapan::create($penginapanData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data penginapan.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
