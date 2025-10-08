<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LsmNarkotika;
use App\Models\DesaGeojson;
use App\Services\DuplicateDetectionService;

class LsmAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = LsmNarkotika::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_lsm', 'like', "%$q%")
                    ->orWhere('ketua_lsm', 'like', "%$q%")
                    ->orWhere('alamat', 'like', "%$q%")
                    ->orWhere('no_hp_ketua', 'like', "%$q%");
            });
        }
        $lsmList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.lsm.index', compact('lsmList'));
    }

    public function create()
    {
        $kabupatenList = DesaGeojson::getKabupatenList();
        return view('admin.data.lsm.create', compact('kabupatenList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lsm' => 'required|string|max:255',
            'ketua_lsm' => 'required|string|max:255',
            'provinsi' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string|max:20',
            'no_hp_ketua' => 'required|string|max:20',
        ]);

        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'lsm_narkotika',
            $data,
            $request->user()->id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Data akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        try {
            LsmNarkotika::create($data);
            return redirect()->route('admin.data.lsm.index')->with('success', 'Data LSM berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    public function show($id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        return view('admin.data.lsm.show', compact('lsm'));
    }

    public function edit($id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        $kabupatenList = DesaGeojson::getKabupatenList();
        return view('admin.data.lsm.edit', compact('lsm', 'kabupatenList'));
    }

    public function update(Request $request, $id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        $oldData = $lsm->toArray();
        $newData = $request->only(['nama_lsm', 'ketua_lsm', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'alamat', 'no_telp', 'no_hp_ketua']);
        $newData['created_by'] = $request->user()->id;

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'lsm_narkotika',
            $newData,
            $request->user()->id,
            $id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Perubahan akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        try {
            $lsm->update($newData);
            return redirect()->route('admin.data.lsm.index')->with('success', 'Data LSM berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data.')->withInput();
        }
    }

    public function destroy($id)
    {
        $lsm = LsmNarkotika::findOrFail($id);
        $lsm->delete();
        return redirect()->route('admin.data.lsm.index')->with('success', 'Data LSM berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content with all form fields
        $csvContent = "nama_lsm,provinsi,kabupaten,kecamatan,kelurahan,alamat,no_telp,ketua_lsm,no_hp_ketua\n";

        // Set headers for download
        $filename = 'import_lsm_narkotika' . '.csv';

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

                $lsmData = [
                    'nama_lsm' => trim($data[0] ?? ''),
                    'provinsi' => trim($data[1] ?? ''),
                    'kabupaten' => trim($data[2] ?? ''),
                    'kecamatan' => trim($data[3] ?? ''),
                    'kelurahan' => trim($data[4] ?? ''),
                    'alamat' => trim($data[5] ?? ''),
                    'no_telp' => trim($data[6] ?? ''),
                    'ketua_lsm' => trim($data[7] ?? ''),
                    'no_hp_ketua' => trim($data[8] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (
                    empty($lsmData['nama_lsm']) || empty($lsmData['ketua_lsm']) ||
                    empty($lsmData['alamat']) || empty($lsmData['no_hp_ketua'])
                ) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'lsm_narkotika',
                    $lsmData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    LsmNarkotika::create($lsmData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data LSM.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
