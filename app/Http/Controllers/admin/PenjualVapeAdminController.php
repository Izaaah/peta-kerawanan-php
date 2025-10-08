<?php

namespace App\Http\Controllers\admin;

use App\Models\DesaGeojson;
use App\Models\PenjualVape;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class PenjualVapeAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = PenjualVape::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_toko', 'like', "%$q%")
                    ->orWhere('pemilik', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $vapeList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.vape.index', compact('vapeList'));
    }

    public function create()
    {
        $kabupatenList = DesaGeojson::whereNotNull('kabupaten')
            ->where('kabupaten', 'not like', '%/%')
            ->where('kabupaten', 'not like', '%area%')
            ->where('kabupaten', 'not like', '%unknown%')
            ->distinct()
            ->pluck('kabupaten')
            ->sort()
            ->values();

        return view('admin.data.vape.create', compact('kabupatenList'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Handle liquid_dicurigai array
        if ($request->has('liquid_dicurigai')) {
            $liquidArray = array_filter($request->input('liquid_dicurigai', []));
            $data['liquid_dicurigai'] = !empty($liquidArray) ? $liquidArray : null;
        }

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'liquid_dicurigai' => 'nullable|array',
            'liquid_dicurigai.*' => 'nullable|string|max:255',
            'distributor' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'provinsi_lain' => 'nullable|string',
            'kabupaten_lain' => 'nullable|string',
            'kecamatan_lain' => 'nullable|string',
            'kelurahan_lain' => 'nullable|string',
        ]);

        PenjualVape::create($data);
        return redirect()->route('admin.data.vape.index')->with('success', 'Data penjual vape berhasil disimpan.');
    }

    public function show($id)
    {
        $vape = PenjualVape::findOrFail($id);
        return view('admin.data.vape.show', compact('vape'));
    }

    public function edit($id)
    {
        $vape = PenjualVape::findOrFail($id);
        $kabupatenList = DesaGeojson::whereNotNull('kabupaten')
            ->where('kabupaten', 'not like', '%/%')
            ->where('kabupaten', 'not like', '%area%')
            ->where('kabupaten', 'not like', '%unknown%')
            ->distinct()
            ->pluck('kabupaten')
            ->sort()
            ->values();

        return view('admin.data.vape.edit', compact('vape', 'kabupatenList'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        // Handle liquid_dicurigai array
        if ($request->has('liquid_dicurigai')) {
            $liquidArray = array_filter($request->input('liquid_dicurigai', []));
            $data['liquid_dicurigai'] = !empty($liquidArray) ? $liquidArray : null;
        }

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'liquid_dicurigai' => 'nullable|array',
            'liquid_dicurigai.*' => 'nullable|string|max:255',
            'distributor' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'provinsi_lain' => 'nullable|string',
            'kabupaten_lain' => 'nullable|string',
            'kecamatan_lain' => 'nullable|string',
            'kelurahan_lain' => 'nullable|string',
        ]);

        $vape = PenjualVape::findOrFail($id);
        $vape->update($data);
        return redirect()->route('admin.data.vape.index')->with('success', 'Data penjual vape berhasil diupdate.');
    }

    public function destroy($id)
    {
        $vape = PenjualVape::findOrFail($id);
        $vape->delete();
        return redirect()->route('admin.data.vape.index')->with('success', 'Data penjual vape berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "nama_toko,pemilik,lokasi,no_hp,liquid_dicurigai,distributor\n";

        // Set headers for download
        $filename = 'import_vape.csv';

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

                $vapeData = [
                    'nama_toko' => trim($data[0] ?? ''),
                    'pemilik' => trim($data[1] ?? ''),
                    'lokasi' => trim($data[2] ?? ''),
                    'no_hp' => trim($data[3] ?? ''),
                    'liquid_dicurigai' => trim($data[4] ?? ''),
                    'distributor' => trim($data[5] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (
                    empty($vapeData['nama_toko']) || empty($vapeData['pemilik']) ||
                    empty($vapeData['lokasi']) || empty($vapeData['no_hp'])
                ) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'penjual_vape',
                    $vapeData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    PenjualVape::create($vapeData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data penjual vape.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
