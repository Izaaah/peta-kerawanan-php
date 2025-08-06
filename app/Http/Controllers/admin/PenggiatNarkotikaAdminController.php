<?php

namespace App\Http\Controllers\admin;

use App\Models\PenggiatNarkotika;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class PenggiatNarkotikaAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = PenggiatNarkotika::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('alamat', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $penggiatList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.penggiat.index', compact('penggiatList'));
    }

    public function create()
    {
        return view('admin.data.penggiat.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        PenggiatNarkotika::create($data);
        return redirect()->route('admin.data.penggiat.index')->with('success', 'Data penggiat narkotika berhasil ditambah.');
    }

    public function show($id)
    {
        $penggiat = PenggiatNarkotika::findOrFail($id);
        return view('admin.data.penggiat.show', compact('penggiat'));
    }

    public function edit($id)
    {
        $penggiat = PenggiatNarkotika::findOrFail($id);
        return view('admin.data.penggiat.edit', compact('penggiat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        $penggiat = PenggiatNarkotika::findOrFail($id);
        $penggiat->update($request->all());
        return redirect()->route('admin.data.penggiat.index')->with('success', 'Data penggiat narkotika berhasil diupdate.');
    }

    public function destroy($id)
    {
        $penggiat = PenggiatNarkotika::findOrFail($id);
        $penggiat->delete();
        return redirect()->route('admin.data.penggiat.index')->with('success', 'Data penggiat narkotika berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "nama,alamat,no_hp\n";

        // Set headers for download
        $filename = 'import_penggiat.csv';

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
                if (count($data) < 3) {
                    continue;
                }

                $penggiatData = [
                    'nama' => trim($data[0] ?? ''),
                    'alamat' => trim($data[1] ?? ''),
                    'no_hp' => trim($data[2] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (empty($penggiatData['nama']) || empty($penggiatData['alamat']) ||
                    empty($penggiatData['no_hp'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'penggiat_narkotika',
                    $penggiatData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    PenggiatNarkotika::create($penggiatData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data penggiat narkotika.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
