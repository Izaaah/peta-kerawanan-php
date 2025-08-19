<?php

namespace App\Http\Controllers\admin;

use App\Models\JalurMasuk;
use App\Models\DesaGeojson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TitikMasukAdminController extends Controller
{
    public function index()
    {
        $titikMasuk = JalurMasuk::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.data.titik-masuk.index', compact('titikMasuk'));
    }

    /**
     * Show the transportation map
     */
    public function map()
    {
        $provinsiList = JalurMasuk::distinct()->pluck('provinsi')->sort()->values();
        return view('admin.data.titik-masuk-map', compact('provinsiList'));
    }

    public function create()
    {
        $jenisTitikMasukOptions = JalurMasuk::getJenisTitikMasukOptions();
        return view('admin.data.titik-masuk.create', compact('jenisTitikMasukOptions'));
    }

    public function store(Request $request)
    {
        // Debug: Log the request data
        \Log::info('TitikMasuk store request data:', $request->all());
        
        $request->validate([
            'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
            'nama_tempat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        try {
            $data = $request->all();
            \Log::info('Data to be saved:', $data);
            
            JalurMasuk::create($data);
            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Error saving TitikMasuk:', [
                'message' => $e->getMessage(),
                'data' => $request->all()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $jalurMasuk = JalurMasuk::findOrFail($id);
        return view('admin.data.titik-masuk.show', compact('jalurMasuk'));
    }

    public function edit($id)
    {
        $jalurMasuk = JalurMasuk::findOrFail($id);
        $jenisTitikMasukOptions = JalurMasuk::getJenisTitikMasukOptions();
        return view('admin.data.titik-masuk.edit', compact('jalurMasuk', 'jenisTitikMasukOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_transportasi' => 'required|in:Darat,Laut,Udara',
            'nama_tempat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
        ]);

        try {
            $jalurMasuk = JalurMasuk::findOrFail($id);
            $jalurMasuk->update($request->all());

            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $jalurMasuk = JalurMasuk::findOrFail($id);
            $jalurMasuk->delete();

            return redirect()->route('admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function template()
    {
        $filename = 'template_titik_masuk_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, [
                'jenis_transportasi',
                'nama_tempat', 
                'provinsi',
                'kabupaten',
                'kecamatan',
                'kelurahan'
            ]);

            // Add sample data
            fputcsv($file, [
                'Darat',
                'Terminal Bus Blitar',
                'Jawa Timur',
                'Blitar',
                'Kepanjen Kidul',
                'Kepanjen Kidul'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        try {
            $file = $request->file('file');
            $handle = fopen($file->getPathname(), 'r');
            
            // Skip header row
            fgetcsv($handle);
            
            $imported = 0;
            $errors = [];
            
            while (($data = fgetcsv($handle)) !== false) {
                if (count($data) >= 6) {
                    try {
                        JalurMasuk::create([
                            'jenis_transportasi' => $data[0],
                            'nama_tempat' => $data[1],
                            'provinsi' => $data[2],
                            'kabupaten' => $data[3],
                            'kecamatan' => $data[4],
                            'kelurahan' => $data[5],
                        ]);
                        $imported++;
                    } catch (\Exception $e) {
                        $errors[] = "Row " . ($imported + 1) . ": " . $e->getMessage();
                    }
                }
            }
            
            fclose($handle);
            
            if (empty($errors)) {
                return back()->with('success', "Berhasil mengimpor $imported data titik masuk.");
            } else {
                return back()->with('error', "Berhasil mengimpor $imported data, tetapi ada beberapa error: " . implode(', ', $errors));
            }
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengimpor file: ' . $e->getMessage());
        }
    }

    /**
     * Search for places using Google Maps API
     */
    public function searchPlaces(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255'
        ]);

        try {
            $googleMapsService = new \App\Services\GoogleMapsService();
            $places = $googleMapsService->searchPlaces($request->query);
            
            return response()->json([
                'success' => true,
                'places' => $places
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error searching places: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get coordinates from address using Google Maps API
     */
    public function getCoordinates(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500'
        ]);

        try {
            $googleMapsService = new \App\Services\GoogleMapsService();
            $coordinates = $googleMapsService->getCoordinatesFromAddress($request->address);
            
            if ($coordinates) {
                return response()->json([
                    'success' => true,
                    'coordinates' => $coordinates
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menemukan koordinat untuk alamat tersebut'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error getting coordinates: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get transportation points for map display
     */
    public function getTransportationPoints(Request $request)
    {
        $query = JalurMasuk::query();
        
        // Apply filters
        if ($request->filled('provinsi')) {
            $query->where('provinsi', $request->provinsi);
        }
        
        if ($request->filled('kabupaten')) {
            $query->where('kabupaten', $request->kabupaten);
        }
        
        if ($request->filled('jenis_transportasi')) {
            $query->where('jenis_transportasi', $request->jenis_transportasi);
        }
        
        // Only return points with coordinates
        $query->whereNotNull('latitude')
              ->whereNotNull('longitude')
              ->where('latitude', '!=', 0)
              ->where('longitude', '!=', 0);
        
        $points = $query->get();
        
        return response()->json($points);
    }

    /**
     * Get transportation routes for map display
     */
    public function getTransportationRoutes(Request $request)
    {
        $query = \App\Models\JalurTransportasi::with(['titikAwal', 'titikTujuan']);
        
        // Apply filters
        if ($request->filled('jenis_transportasi')) {
            $query->where('jenis_transportasi', $request->jenis_transportasi);
        }
        
        if ($request->filled('from_point')) {
            $query->where('titik_awal_id', $request->from_point);
        }
        
        if ($request->filled('to_point')) {
            $query->where('titik_tujuan_id', $request->to_point);
        }
        
        // Only return active routes
        $query->where('status', 'aktif');
        
        $routes = $query->get();
        
        return response()->json($routes);
    }
}