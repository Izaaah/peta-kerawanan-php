<?php

namespace App\Http\Controllers;

use App\Models\TransportationRoute;
use Illuminate\Http\Request;

class TitikMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = TransportationRoute::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('route_name', 'like', "%$q%")
                    ->orWhere('start_location', 'like', "%$q%")
                    ->orWhere('end_location', 'like', "%$q%")
                    ->orWhere('transport_type', 'like', "%$q%");
            });
        }
        $titikMasukList = $query->latest()->paginate(15)->withQueryString();
        return view('super-admin.data.titik-masuk.index', compact('titikMasukList'));
    }

    public function create()
    {
        $transportTypeOptions = TransportationRoute::getTransportTypeOptions();
        return view('super-admin.data.titik-masuk.create', compact('transportTypeOptions'));
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
        ]);

        try {
            $data = $request->all();
            $data['created_by'] = auth()->id();
            $data['is_active'] = true;

            // Convert waypoints to array if it's a string
            if (isset($data['waypoints']) && is_string($data['waypoints'])) {
                $data['waypoints'] = json_decode($data['waypoints'], true);
            }

            TransportationRoute::create($data);
            return redirect()->route('super-admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $titikMasuk = TransportationRoute::findOrFail($id);
        return view('super-admin.data.titik-masuk.show', compact('titikMasuk'));
    }

    public function edit($id)
    {
        $titikMasuk = TransportationRoute::findOrFail($id);
        $transportTypeOptions = TransportationRoute::getTransportTypeOptions();
        return view('super-admin.data.titik-masuk.edit', compact('titikMasuk', 'transportTypeOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'route_name' => 'required|string|max:255',
        ]);

        try {
            $titikMasuk = TransportationRoute::findOrFail($id);
            $titikMasuk->update(['route_name' => $request->route_name]);

            return redirect()->route('super-admin.data.titik-masuk.index')
                ->with('success', 'Nama rute berhasil diperbarui.');
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

            return redirect()->route('super-admin.data.titik-masuk.index')
                ->with('success', 'Data transportasi berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
