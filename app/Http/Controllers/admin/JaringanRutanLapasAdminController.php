<?php

namespace App\Http\Controllers\admin;

use App\Models\JaringanRutanLapas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class JaringanRutanLapasAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = JaringanRutanLapas::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_napi', 'like', "%$q%")
                    ->orWhere('nik', 'like', "%$q%")
                    ->orWhere('jenis_napi', 'like', "%$q%")
                    ->orWhere('lapas', 'like', "%$q%")
                    ->orWhere('status_proses', 'like', "%$q%");
            });
        }
        $rutanlapasList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.rutanlapas.index', compact('rutanlapasList'));
    }

    public function create()
    {
        $jenisNapiOptions = JaringanRutanLapas::getJenisNapiOptions();
        $statusProsesOptions = JaringanRutanLapas::getStatusProsesOptions();
        return view('admin.data.rutanlapas.create', compact('jenisNapiOptions', 'statusProsesOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = $request->user()->id;
        $request->validate([
            'nik' => 'nullable|digits:16',
            'nama_napi' => 'required|string|max:255',
            'jenis_napi' => 'required|in:Napi Narkotika,Napi Non Narkotika',
            'lapas' => 'required|string|max:255',
            'lokasi_lapas' => 'required|string',
            'peran_dalam_jaringan' => 'nullable|string|max:255',
            'status_proses' => 'required|in:Ditahan,Bebas,Dalam proses,Tidak diketahui',
            'keterangan' => 'nullable|string',
        ]);
        JaringanRutanLapas::create($data);
        return redirect()->route('admin.data.rutanlapas.index')->with('success', 'Data jaringan rutan/lapas berhasil disimpan.');
    }

    public function show($id)
    {
        $rutanlapas = JaringanRutanLapas::findOrFail($id);
        return view('admin.data.rutanlapas.show', compact('rutanlapas'));
    }

    public function edit($id)
    {
        $rutanlapas = JaringanRutanLapas::findOrFail($id);
        $jenisNapiOptions = JaringanRutanLapas::getJenisNapiOptions();
        $statusProsesOptions = JaringanRutanLapas::getStatusProsesOptions();
        return view('admin.data.rutanlapas.edit', compact('rutanlapas', 'jenisNapiOptions', 'statusProsesOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'nullable|digits:16',
            'nama_napi' => 'required|string|max:255',
            'jenis_napi' => 'required|in:Napi Narkotika,Napi Non Narkotika',
            'lapas' => 'required|string|max:255',
            'lokasi_lapas' => 'required|string',
            'peran_dalam_jaringan' => 'nullable|string|max:255',
            'status_proses' => 'required|in:Ditahan,Bebas,Dalam proses,Tidak diketahui',
            'keterangan' => 'nullable|string',
        ]);
        $rutanlapas = JaringanRutanLapas::findOrFail($id);
        $rutanlapas->update($request->all());
        return redirect()->route('admin.data.rutanlapas.index')->with('success', 'Data jaringan rutan/lapas berhasil diupdate.');
    }

    public function destroy($id)
    {
        $rutanlapas = JaringanRutanLapas::findOrFail($id);
        $rutanlapas->delete();
        return redirect()->route('admin.data.rutanlapas.index')->with('success', 'Data jaringan rutan/lapas berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "nama_napi,jenis_napi,lapas,lokasi_lapas,peran_dalam_jaringan,status_proses,keterangan\n";

        // Set headers for download
        $filename = 'import_rutanlapas.csv';

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

                $rutanlapasData = [
                    'nama_napi' => trim($data[0] ?? ''),
                    'jenis_napi' => trim($data[1] ?? ''),
                    'lapas' => trim($data[2] ?? ''),
                    'lokasi_lapas' => trim($data[3] ?? ''),
                    'peran_dalam_jaringan' => trim($data[4] ?? ''),
                    'status_proses' => trim($data[5] ?? ''),
                    'keterangan' => trim($data[6] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (
                    empty($rutanlapasData['nama_napi']) || empty($rutanlapasData['jenis_napi']) ||
                    empty($rutanlapasData['lapas']) || empty($rutanlapasData['lokasi_lapas']) ||
                    empty($rutanlapasData['status_proses'])
                ) {
                    continue;
                }

                // Validate jenis_napi field
                if (!in_array($rutanlapasData['jenis_napi'], ['Napi Narkotika', 'Napi Non Narkotika'])) {
                    continue;
                }

                // Validate status_proses field
                if (!in_array($rutanlapasData['status_proses'], ['Ditahan', 'Bebas', 'Dalam proses', 'Tidak diketahui'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'jaringan_rutan_lapas',
                    $rutanlapasData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    JaringanRutanLapas::create($rutanlapasData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data jaringan rutan/lapas.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
