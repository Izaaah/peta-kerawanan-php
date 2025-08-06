<?php

namespace App\Http\Controllers\admin;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class EkspedisiAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Ekspedisi::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%$q%")
                    ->orWhere('manager', 'like', "%$q%")
                    ->orWhere('alamat', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%")
                    ->orWhere('jenis', 'like', "%$q%");
            });
        }
        $ekspedisiList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.ekspedisi.index', compact('ekspedisiList'));
    }

    public function create()
    {
        $jenisOptions = Ekspedisi::getJenisOptions();
        return view('admin.data.ekspedisi.create', compact('jenisOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'jenis' => 'required|in:Asperindo,Non Asperindo',
        ]);
        Ekspedisi::create($data);
        return redirect()->route('admin.data.ekspedisi.index')->with('success', 'Data ekspedisi berhasil disimpan.');
    }

    public function show($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        return view('admin.data.ekspedisi.show', compact('ekspedisi'));
    }

    public function edit($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        $jenisOptions = Ekspedisi::getJenisOptions();
        return view('admin.data.ekspedisi.edit', compact('ekspedisi', 'jenisOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'manager' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'jenis' => 'required|in:Asperindo,Non Asperindo',
        ]);
        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->update($request->all());
        return redirect()->route('admin.data.ekspedisi.index')->with('success', 'Data ekspedisi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $ekspedisi = Ekspedisi::findOrFail($id);
        $ekspedisi->delete();
        return redirect()->route('admin.data.ekspedisi.index')->with('success', 'Data ekspedisi berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "nama,manager,no_hp,jenis,alamat\n";

        // Set headers for download
        $filename = 'import_ekspedisi.csv';

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

                $ekspedisiData = [
                    'nama' => trim($data[0] ?? ''),
                    'manager' => trim($data[1] ?? ''),
                    'no_hp' => trim($data[2] ?? ''),
                    'jenis' => trim($data[3] ?? ''),
                    'alamat' => trim($data[4] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (empty($ekspedisiData['nama']) || empty($ekspedisiData['manager']) ||
                    empty($ekspedisiData['no_hp']) || empty($ekspedisiData['jenis']) ||
                    empty($ekspedisiData['alamat'])) {
                    continue;
                }

                // Validate jenis field
                if (!in_array($ekspedisiData['jenis'], ['Asperindo', 'Non Asperindo'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'ekspedisi',
                    $ekspedisiData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    Ekspedisi::create($ekspedisiData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data ekspedisi.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
