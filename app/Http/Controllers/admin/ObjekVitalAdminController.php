<?php

namespace App\Http\Controllers\admin;

use App\Models\ObjekVital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class ObjekVitalAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = \App\Models\ObjekVital::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('nama_objek', 'like', "%$q%")
                    ->orWhere('nama_manager', 'like', "%$q%")
                    ->orWhere('lokasi', 'like', "%$q%")
                    ->orWhere('no_hp', 'like', "%$q%");
            });
        }
        $objekVitalList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.objekvital.index', compact('objekVitalList'));
    }

    public function create()
    {
        return view('admin.data.objekvital.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        \App\Models\ObjekVital::create($data);
        return redirect()->route('admin.data.objekvital.index')->with('success', 'Data objek vital berhasil disimpan.');
    }

    public function show($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        return view('admin.data.objekvital.show', compact('objekVital'));
    }

    public function edit($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        return view('admin.data.objekvital.edit', compact('objekVital'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_objek' => 'required|string|max:255',
            'nama_manager' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ]);
        $objekVital = ObjekVital::findOrFail($id);
        $objekVital->update($request->all());
        return redirect()->route('admin.data.objekvital.index')->with('success', 'Data objek vital berhasil diupdate.');
    }

    public function destroy($id)
    {
        $objekVital = ObjekVital::findOrFail($id);
        $objekVital->delete();
        return redirect()->route('admin.data.objekvital.index')->with('success', 'Data objek vital berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "nama_objek,nama_manager,lokasi,no_hp\n";

        // Set headers for download
        $filename = 'import_objekvital.csv';

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

                $objekVitalData = [
                    'nama_objek' => trim($data[0] ?? ''),
                    'nama_manager' => trim($data[1] ?? ''),
                    'lokasi' => trim($data[2] ?? ''),
                    'no_hp' => trim($data[3] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (empty($objekVitalData['nama_objek']) || empty($objekVitalData['nama_manager']) ||
                    empty($objekVitalData['lokasi']) || empty($objekVitalData['no_hp'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'objek_vital',
                    $objekVitalData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    ObjekVital::create($objekVitalData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data objek vital.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
