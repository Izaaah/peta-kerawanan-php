<?php

namespace App\Http\Controllers\admin;

use App\Models\Transportasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class TransportasiAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Transportasi::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('jenis_transportasi', 'like', "%$q%")
                    ->orWhere('nama_pihak', 'like', "%$q%")
                    ->orWhere('posisi', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $transportasiList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.transportasi.index', compact('transportasiList'));
    }

    public function create()
    {
        $jenisTransportasiOptions = Transportasi::getJenisTransportasiOptions();
        return view('admin.data.transportasi.create', compact('jenisTransportasiOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
            'nama_pihak' => 'required|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        try {
            Transportasi::create($data);
            return redirect()->route('admin.data.transportasi.index')
                ->with('success', 'Data transportasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $transportasi = Transportasi::findOrFail($id);
        return view('admin.data.transportasi.show', compact('transportasi'));
    }

    public function edit($id)
    {
        $transportasi = Transportasi::findOrFail($id);
        $jenisTransportasiOptions = Transportasi::getJenisTransportasiOptions();
        return view('admin.data.transportasi.edit', compact('transportasi', 'jenisTransportasiOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
            'nama_pihak' => 'required|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);

        try {
            $transportasi = Transportasi::findOrFail($id);
            $transportasi->update($request->all());

            return redirect()->route('admin.data.transportasi.index')
                ->with('success', 'Data transportasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $transportasi = Transportasi::findOrFail($id);
            $transportasi->delete();

            return redirect()->route('admin.data.transportasi.index')
                ->with('success', 'Data transportasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "jenis_transportasi,nama_pihak,posisi,no_hp,lokasi\n";

        // Set headers for download
        $filename = 'import_transportasi.csv';

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

                $transportasiData = [
                    'jenis_transportasi' => trim($data[0] ?? ''),
                    'nama_pihak' => trim($data[1] ?? ''),
                    'posisi' => trim($data[2] ?? ''),
                    'no_hp' => trim($data[3] ?? ''),
                    'lokasi' => trim($data[4] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (empty($transportasiData['jenis_transportasi']) || empty($transportasiData['nama_pihak']) ||
                    empty($transportasiData['no_hp']) || empty($transportasiData['lokasi'])) {
                    continue;
                }

                // Validate jenis_transportasi field
                if (!in_array($transportasiData['jenis_transportasi'], ['Darat', 'Laut', 'Udara'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'transportasi',
                    $transportasiData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    Transportasi::create($transportasiData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data transportasi.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
