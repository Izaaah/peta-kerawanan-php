<?php

namespace App\Http\Controllers\admin;

use App\Models\TransportationRoute;
use App\Models\DesaGeojson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DuplicateDetectionService;

class TitikMasukAdminController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = TransportationRoute::query();
        if (!$user->isSuperAdmin()) {
            $query->where('created_by', $user->id);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('route_name', 'like', "%$q%")
                    ->orWhere('start_location', 'like', "%$q%")
                    ->orWhere('end_location', 'like', "%$q%")
                    ->orWhere('transport_type', 'like', "%$q%");
            });
        }
        $titikMasukList = $query->latest()->paginate(10)->withQueryString();
        return view('admin.data.titik-masuk.index', compact('titikMasukList'));
    }

    public function create()
    {
        $kabupatenList = DesaGeojson::getKabupatenList();
        $kecamatanList = DesaGeojson::getKecamatanList();
        $desaList = DesaGeojson::all();

        $transportTypeOptions = TransportationRoute::getTransportTypeOptions();
        return view('admin.data.titik-masuk.create', compact('transportTypeOptions', 'kabupatenList', 'kecamatanList', 'desaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
            'start_location' => 'required|string|max:255',
            'start_lat' => 'required|numeric|between:-90,90',
            'start_lng' => 'required|numeric|between:-180,180',
            'end_location' => 'nullable|string|max:255',
            'end_lat' => 'nullable|numeric|between:-90,90',
            'end_lng' => 'nullable|numeric|between:-180,180',
            'transport_type' => 'required|in:pesawat,kapal,kereta,mobil,motor,truk,bus',
            'waypoints' => 'nullable|json',
            'is_multi_segment' => 'boolean',
            'distance_km' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
        ]);

        try {
            $data = $request->all();
            $data['created_by'] = $request->user()->id;

            // Convert waypoints to array if it's a string
            if (isset($data['waypoints']) && is_string($data['waypoints'])) {
                $data['waypoints'] = json_decode($data['waypoints'], true);
            }

            TransportationRoute::create($data);

            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data titik masuk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $titikMasuk = TransportationRoute::findOrFail($id);
        return view('admin.data.titik-masuk.show', compact('titikMasuk'));
    }

    public function edit($id)
    {
        $titikMasuk = TransportationRoute::findOrFail($id);
        $transportTypeOptions = TransportationRoute::getTransportTypeOptions();
        $kabupatenList = DesaGeojson::getKabupatenList();
        return view('admin.data.titik-masuk.edit', compact('titikMasuk', 'transportTypeOptions', 'kabupatenList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
            'start_location' => 'required|string|max:255',
            'start_lat' => 'required|numeric|between:-90,90',
            'start_lng' => 'required|numeric|between:-180,180',
            'end_location' => 'nullable|string|max:255',
            'end_lat' => 'nullable|numeric|between:-90,90',
            'end_lng' => 'nullable|numeric|between:-180,180',
            'transport_type' => 'required|in:pesawat,kapal,kereta,mobil,motor,truk,bus',
            'waypoints' => 'nullable|json',
            'is_multi_segment' => 'boolean',
            'distance_km' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
        ]);

        try {
            $titikMasuk = TransportationRoute::findOrFail($id);
            $data = $request->all();

            // Convert waypoints to array if it's a string
            if (isset($data['waypoints']) && is_string($data['waypoints'])) {
                $data['waypoints'] = json_decode($data['waypoints'], true);
            }

            $titikMasuk->update($data);

            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data titik masuk berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $titikMasuk = TransportationRoute::findOrFail($id);
            $titikMasuk->delete();

            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function template()
    {
        // Create CSV template content with all form fields
        $csvContent = "route_name,start_location,start_lat,start_lng,end_location,end_lat,end_lng,transport_type,waypoints,is_multi_segment,distance_km,description,color,is_active\n";

        // Set headers for download
        $filename = 'import_titik_masuk' . '.csv';

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
                if (count($data) < 6) {
                    continue;
                }

                $titikMasukData = [
                    'route_name' => trim($data[0] ?? ''),
                    'start_location' => trim($data[1] ?? ''),
                    'start_lat' => !empty($data[2]) ? floatval($data[2]) : null,
                    'start_lng' => !empty($data[3]) ? floatval($data[3]) : null,
                    'end_location' => trim($data[4] ?? ''),
                    'end_lat' => !empty($data[5]) ? floatval($data[5]) : null,
                    'end_lng' => !empty($data[6]) ? floatval($data[6]) : null,
                    'transport_type' => trim($data[7] ?? ''),
                    'waypoints' => trim($data[8] ?? ''),
                    'is_multi_segment' => isset($data[9]) ? filter_var($data[9], FILTER_VALIDATE_BOOLEAN) : false,
                    'distance_km' => !empty($data[10]) ? floatval($data[10]) : null,
                    'description' => trim($data[11] ?? ''),
                    'color' => trim($data[12] ?? ''),
                    'is_active' => isset($data[13]) ? filter_var($data[13], FILTER_VALIDATE_BOOLEAN) : true,
                    'created_by' => $request->user()->id,
                ];

                // Validate required fields
                if (
                    empty($titikMasukData['route_name']) || empty($titikMasukData['start_location']) ||
                    empty($titikMasukData['start_lat']) || empty($titikMasukData['start_lng']) ||
                    empty($titikMasukData['transport_type'])
                ) {
                    continue;
                }

                // Check for duplicates
                $isDuplicate = DuplicateDetectionService::checkAndCreateVerification(
                    'titik_masuk',
                    $titikMasukData,
                    $request->user()->id
                );

                if (!$isDuplicate) {
                    TransportationRoute::create($titikMasukData);
                    $importedCount++;
                } else {
                    $duplicateCount++;
                }
            }

            fclose($handle);

            $message = "Berhasil mengimport {$importedCount} data Titik Masuk.";
            if ($duplicateCount > 0) {
                $message .= " {$duplicateCount} data duplikat akan diverifikasi.";
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimport file: ' . $e->getMessage());
        }
    }
}
