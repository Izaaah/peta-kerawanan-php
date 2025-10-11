<?php

namespace App\Http\Controllers;

use App\Models\TransportationRoute;
use Illuminate\Http\Request;

class TransportationRouteController extends Controller
{
    /**
     * Display map with routes
     */
    public function index()
    {
        return view('map.map_titikMasuk_optimized');
    }

    /**
     * Get all active routes (API)
     */
    public function getRoutes()
    {
        $routes = TransportationRoute::orderBy('created_at', 'desc')->get();

        return response()->json($routes);
    }

    /**
     * Store a new route (API)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_name' => 'nullable|string|max:255',
            'is_multi_segment' => 'boolean',
            'waypoints' => 'nullable|array',
            'waypoints.*.location' => 'required_if:is_multi_segment,true|string|max:255',
            'waypoints.*.lat' => 'required_if:is_multi_segment,true|numeric|between:-90,90',
            'waypoints.*.lng' => 'required_if:is_multi_segment,true|numeric|between:-180,180',
            'waypoints.*.transport_to_next' => 'nullable|in:pesawat,kapal,kereta,mobil,motor,truk,bus',
            'start_location' => 'required_without:waypoints|string|max:255',
            'start_lat' => 'required_without:waypoints|numeric|between:-90,90',
            'start_lng' => 'required_without:waypoints|numeric|between:-180,180',
            'end_location' => 'required_without:waypoints|string|max:255',
            'end_lat' => 'required_without:waypoints|numeric|between:-90,90',
            'end_lng' => 'required_without:waypoints|numeric|between:-180,180',
            'transport_type' => 'required_without:waypoints|in:pesawat,kapal,kereta,mobil,motor,truk,bus',
            'distance_km' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['is_active'] = true; // Set new routes as active by default

        $route = TransportationRoute::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Rute berhasil disimpan!',
            'route' => $route
        ], 201);
    }

    /**
     * Update route (API)
     */
    public function update(Request $request, $id)
    {
        $route = TransportationRoute::findOrFail($id);

        $validated = $request->validate([
            'route_name' => 'nullable|string|max:255',
            'is_multi_segment' => 'boolean',
            'waypoints' => 'nullable|array',
            'waypoints.*.location' => 'required_if:is_multi_segment,true|string|max:255',
            'waypoints.*.lat' => 'required_if:is_multi_segment,true|numeric|between:-90,90',
            'waypoints.*.lng' => 'required_if:is_multi_segment,true|numeric|between:-180,180',
            'waypoints.*.transport_to_next' => 'nullable|in:pesawat,kapal,kereta,mobil,motor,truk,bus',
            'start_location' => 'required_without:waypoints|string|max:255',
            'start_lat' => 'required_without:waypoints|numeric|between:-90,90',
            'start_lng' => 'required_without:waypoints|numeric|between:-180,180',
            'end_location' => 'required_without:waypoints|string|max:255',
            'end_lat' => 'required_without:waypoints|numeric|between:-90,90',
            'end_lng' => 'required_without:waypoints|numeric|between:-180,180',
            'transport_type' => 'required_without:waypoints|in:pesawat,kapal,kereta,mobil,motor,truk,bus',
            'distance_km' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
        ]);

        $route->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Rute berhasil diupdate!',
            'route' => $route
        ]);
    }

    /**
     * Delete route (API)
     */
    public function destroy($id)
    {
        $route = TransportationRoute::findOrFail($id);
        $route->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rute berhasil dihapus!'
        ]);
    }

    /**
     * Toggle route visibility (API)
     */
    public function toggleActive($id)
    {
        $route = TransportationRoute::findOrFail($id);
        $route->is_active = !$route->is_active;
        $route->save();

        return response()->json([
            'success' => true,
            'message' => 'Status rute berhasil diubah!',
            'is_active' => $route->is_active,
            'route' => $route
        ]);
    }
}
