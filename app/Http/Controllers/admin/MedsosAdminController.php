<?php

namespace App\Http\Controllers\admin;

use App\Models\Medsos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class MedsosAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Medsos::with('individu');
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_media_sosial', 'like', "%$q%")
                    ->orWhere('nama_akun', 'like', "%$q%")
                    ->orWhere('link_akun', 'like', "%$q%")
                    ->orWhere('jenis_akun', 'like', "%$q%");
            });
        }
        $medsosList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.medsos.index', compact('medsosList'));
    }

    public function create()
    {
        return view('admin.data.medsos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_media_sosial' => 'required|string|max:255',
            'nama_media_sosial_lainnya' => 'nullable|string|max:255',
            'jenis_akun' => 'required|in:personal,kelompok',
            'individu_id' => 'nullable|exists:data_individu_tsk,id',
            'nama_akun' => 'required|string|max:255',
            'link_akun' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Handle "Lainnya" option
        if ($data['nama_media_sosial'] === 'Lainnya') {
            if (empty($data['nama_media_sosial_lainnya'])) {
                return redirect()->back()
                    ->withErrors(['nama_media_sosial_lainnya' => 'Nama media sosial harus diisi jika memilih "Lainnya"'])
                    ->withInput();
            }
            $data['nama_media_sosial'] = $data['nama_media_sosial_lainnya'];
        }

        // Handle "Personal" jenis akun validation
        if ($data['jenis_akun'] === 'personal' && empty($data['individu_id'])) {
            return redirect()->back()
                ->withErrors(['individu_id' => 'Profil individu harus dipilih untuk akun personal'])
                ->withInput();
        }

        unset($data['nama_media_sosial_lainnya']);
        unset($data['search_nik']);

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'medsos',
            $data,
            $request->user()->id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Data akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        Medsos::create($data);
        return redirect()->route('admin.data.medsos.index')->with('success', 'Data medsos berhasil disimpan.');
    }

    public function show($id)
    {
        $medsos = Medsos::with('individu')->findOrFail($id);
        return view('admin.data.medsos.show', compact('medsos'));
    }

    public function edit($id)
    {
        $medsos = Medsos::with('individu')->findOrFail($id);
        return view('admin.data.medsos.edit', compact('medsos'));
    }

    public function update(Request $request, $id)
    {
        $medsos = Medsos::findOrFail($id);

        $request->validate([
            'nama_media_sosial' => 'required|string|max:255',
            'nama_media_sosial_lainnya' => 'nullable|string|max:255',
            'jenis_akun' => 'required|in:personal,kelompok',
            'individu_id' => 'nullable|exists:data_individu_tsk,id',
            'nama_akun' => 'required|string|max:255',
            'link_akun' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['created_by'] = $request->user()->id;

        // Handle "Lainnya" option
        if ($data['nama_media_sosial'] === 'Lainnya') {
            if (empty($data['nama_media_sosial_lainnya'])) {
                return redirect()->back()
                    ->withErrors(['nama_media_sosial_lainnya' => 'Nama media sosial harus diisi jika memilih "Lainnya"'])
                    ->withInput();
            }
            $data['nama_media_sosial'] = $data['nama_media_sosial_lainnya'];
        }

        // Handle "Personal" jenis akun validation
        if ($data['jenis_akun'] === 'personal' && empty($data['individu_id'])) {
            return redirect()->back()
                ->withErrors(['individu_id' => 'Profil individu harus dipilih untuk akun personal'])
                ->withInput();
        }

        unset($data['nama_media_sosial_lainnya']);
        unset($data['search_nik']);

        // Check for duplicates
        $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
            'medsos',
            $data,
            $request->user()->id,
            $id
        );

        if ($isDuplicate) {
            return redirect()->back()
                ->with('warning', 'Data terdeteksi duplikat. Perubahan akan diverifikasi oleh Super Admin terlebih dahulu.')
                ->withInput();
        }

        $medsos->update($data);
        return redirect()->route('admin.data.medsos.index')->with('success', 'Data medsos berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $medsos = Medsos::findOrFail($id);
        $medsos->delete();
        return redirect()->route('admin.data.medsos.index')->with('success', 'Data medsos berhasil dihapus.');
    }

    public function template()
    {
        // Create CSV template content
        $csvContent = "nama_media_sosial,nama_akun,link_akun\n";

        // Set headers for download
        $filename = 'import_medsos.csv';

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

                $medsosData = [
                    'nama_media_sosial' => trim($data[0] ?? ''),
                    'nama_akun' => trim($data[1] ?? ''),
                    'link_akun' => trim($data[2] ?? ''),
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (empty($medsosData['nama_media_sosial']) || empty($medsosData['nama_akun'])) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'medsos',
                    $medsosData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    Medsos::create($medsosData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data medsos.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
