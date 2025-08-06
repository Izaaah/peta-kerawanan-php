<?php

namespace App\Http\Controllers\admin;

use App\Models\PerusahaanFarmasiPrekursor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class PerusahaanFarmasiPrekursorAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = PerusahaanFarmasiPrekursor::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('jenis', 'like', "%$q%")
                    ->orWhere('nama', 'like', "%$q%")
                    ->orWhere('manager', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%")
                    ->orWhere('prekusor', 'like', "%$q%")
                    ->orWhere('tujuan', 'like', "%$q%");
            });
        }
        $farmasiList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.farmasi.index', compact('farmasiList'));
    }

    public function create()
    {
        return view('admin.data.farmasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Perusahaan,Farmasi',
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'prekusor' => 'required|string',
            'ijin_penerbit' => 'required|string',
            'jumlah' => 'required|string',
            'tujuan' => 'required|string',
        ]);
        PerusahaanFarmasiPrekursor::create($request->all());
        return redirect()->route('admin.data.farmasi.index')->with('success', 'Data perusahaan farmasi berhasil ditambah.');
    }

    public function show($id)
    {
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        return view('admin.data.farmasi.show', compact('farmasi'));
    }

    public function edit($id)
    {
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        return view('admin.data.farmasi.edit', compact('farmasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|in:Perusahaan,Farmasi',
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'prekusor' => 'required|string',
            'ijin_penerbit' => 'required|string',
            'jumlah' => 'required|string',
            'tujuan' => 'required|string',
        ]);
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        $farmasi->update($request->all());
        return redirect()->route('admin.data.farmasi.index')->with('success', 'Data perusahaan farmasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $farmasi = PerusahaanFarmasiPrekursor::findOrFail($id);
        $farmasi->delete();
        return redirect()->route('admin.data.farmasi.index')->with('success', 'Data perusahaan farmasi berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "jenis,nama,manager,lokasi,no_hp,prekusor,ijin_penerbit,jumlah,tujuan\n";

        // Set headers for download
        $filename = 'import_farmasi.csv';

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
                if (count($data) < 9) {
                    continue;
                }

                $farmasiData = [
                    'jenis' => trim($data[0] ?? ''),
                    'nama' => trim($data[1] ?? ''),
                    'manager' => trim($data[2] ?? ''),
                    'lokasi' => trim($data[3] ?? ''),
                    'no_hp' => trim($data[4] ?? ''),
                    'prekusor' => trim($data[5] ?? ''),
                    'ijin_penerbit' => trim($data[6] ?? ''),
                    'jumlah' => trim($data[7] ?? ''),
                    'tujuan' => trim($data[8] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (empty($farmasiData['jenis']) || empty($farmasiData['nama']) ||
                    empty($farmasiData['manager']) || empty($farmasiData['lokasi']) ||
                    empty($farmasiData['no_hp']) || empty($farmasiData['prekusor']) ||
                    empty($farmasiData['ijin_penerbit']) || empty($farmasiData['jumlah']) ||
                    empty($farmasiData['tujuan'])) {
                    continue;
                }

                // Validate jenis field
                if (!in_array($farmasiData['jenis'], ['Perusahaan', 'Farmasi'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'perusahaan_farmasi_prekursor',
                    $farmasiData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    PerusahaanFarmasiPrekursor::create($farmasiData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data perusahaan farmasi.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
