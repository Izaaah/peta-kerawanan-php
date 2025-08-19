@extends('layouts.admin-master')

@section('title', 'Peta Titik Masuk Transportasi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Peta Titik Masuk Transportasi</h1>
        <p class="text-gray-600">Visualisasi titik-titik transportasi dan jalur antar lokasi</p>
    </div>

    <!-- Filter Controls -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="filter_provinsi" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                <select id="filter_provinsi" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Provinsi</option>
                    @foreach($provinsiList as $provinsi)
                        <option value="{{ $provinsi }}">{{ $provinsi }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="filter_kabupaten" class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                <select id="filter_kabupaten" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Kabupaten</option>
                </select>
            </div>
            <div>
                <label for="filter_transportasi" class="block text-sm font-medium text-gray-700 mb-2">Jenis Transportasi</label>
                <select id="filter_transportasi" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Jenis</option>
                    <option value="Darat">Darat</option>
                    <option value="Laut">Laut</option>
                    <option value="Udara">Udara</option>
                </select>
            </div>
            <div>
                <label for="show_routes" class="block text-sm font-medium text-gray-700 mb-2">Tampilkan Jalur</label>
                <select id="show_routes" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="all">Semua Jalur</option>
                    <option value="kereta">Kereta Api</option>
                    <option value="bus">Bus</option>
                    <option value="pesawat">Pesawat</option>
                    <option value="kapal">Kapal</option>
                    <option value="none">Tidak Ada</option>
                </select>
            </div>
            <div class="flex items-end">
                <button id="applyFilter" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Terapkan Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div id="map" class="w-full h-96 rounded-lg border border-gray-300"></div>
    </div>

    <!-- Legend -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Keterangan</h3>
        
        <!-- Point Types -->
        <div class="mb-6">
            <h4 class="text-md font-medium text-gray-800 mb-3">Titik Transportasi</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-red-500 rounded-full"></div>
                    <span class="text-sm text-gray-700">Transportasi Darat (Stasiun, Terminal)</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-700">Transportasi Laut (Pelabuhan)</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-700">Transportasi Udara (Bandara)</span>
                </div>
            </div>
        </div>
        
        <!-- Route Types -->
        <div>
            <h4 class="text-md font-medium text-gray-800 mb-3">Jalur Transportasi</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-1 bg-red-600"></div>
                    <span class="text-sm text-gray-700">Kereta Api</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-1 bg-orange-600"></div>
                    <span class="text-sm text-gray-700">Bus</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-1 bg-green-600"></div>
                    <span class="text-sm text-gray-700">Pesawat</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-1 bg-blue-600"></div>
                    <span class="text-sm text-gray-700">Kapal</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-1 bg-purple-600"></div>
                    <span class="text-sm text-gray-700">Mobil Pribadi</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-1 bg-red-600"></div>
                    <span class="text-sm text-gray-700">Motor</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Titik Transportasi</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Tempat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Koordinat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataTable" class="bg-white divide-y divide-gray-200">
                    <!-- Data will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let map;
    let markers = [];
    let routes = [];
    
    // Initialize map
    function initMap() {
        map = L.map('map').setView([-2.5489, 118.0149], 5); // Center of Indonesia
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    }
    
    // Initialize map
    initMap();
    
    // Load transportation points and routes
    function loadTransportationPoints(filters = {}) {
        // Clear existing markers and routes
        markers.forEach(marker => map.removeLayer(marker));
        routes.forEach(route => map.removeLayer(route));
        markers = [];
        routes = [];
        
        // Fetch points data from API
        fetch('/admin/api/transportation-points?' + new URLSearchParams(filters))
            .then(response => response.json())
            .then(data => {
                // Create markers for each point
                data.forEach(point => {
                    const color = getMarkerColor(point.jenis_transportasi);
                    const icon = L.divIcon({
                        className: 'custom-div-icon',
                        html: `<div style="background-color: ${color}; width: 20px; height: 20px; border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`,
                        iconSize: [20, 20],
                        iconAnchor: [10, 10]
                    });
                    
                    const marker = L.marker([point.latitude, point.longitude], { icon: icon })
                        .addTo(map)
                        .bindPopup(`
                            <div class="p-2">
                                <h3 class="font-bold">${point.nama_tempat}</h3>
                                <p class="text-sm text-gray-600">${point.jenis_transportasi}</p>
                                <p class="text-sm text-gray-600">${point.kabupaten}, ${point.provinsi}</p>
                                <p class="text-xs text-gray-500">${point.latitude}, ${point.longitude}</p>
                                <div class="mt-2">
                                    <button onclick="showRoutesFromPoint(${point.id})" class="text-blue-600 hover:text-blue-800 text-sm">
                                        Lihat Jalur dari Sini
                                    </button>
                                </div>
                            </div>
                        `);
                    
                    markers.push(marker);
                });
                
                // Load routes if not set to 'none'
                const showRoutes = document.getElementById('show_routes').value;
                if (showRoutes !== 'none') {
                    loadTransportationRoutes(filters, showRoutes);
                }
                
                // Update table
                updateDataTable(data);
            })
            .catch(error => {
                console.error('Error loading transportation points:', error);
            });
    }
    
    // Load transportation routes
    function loadTransportationRoutes(filters = {}, routeType = 'all') {
        const routeFilters = { ...filters };
        if (routeType !== 'all') {
            routeFilters.jenis_transportasi = routeType;
        }
        
        fetch('/admin/api/transportation-routes?' + new URLSearchParams(routeFilters))
            .then(response => response.json())
            .then(data => {
                data.forEach(route => {
                    if (route.titik_awal && route.titik_tujuan) {
                        const color = getRouteColor(route.jenis_transportasi);
                        const polyline = L.polyline([
                            [route.titik_awal.latitude, route.titik_awal.longitude],
                            [route.titik_tujuan.latitude, route.titik_tujuan.longitude]
                        ], {
                            color: color,
                            weight: 3,
                            opacity: 0.7
                        }).addTo(map);
                        
                        // Add route info popup
                        const midpoint = [
                            (route.titik_awal.latitude + route.titik_tujuan.latitude) / 2,
                            (route.titik_awal.longitude + route.titik_tujuan.longitude) / 2
                        ];
                        
                        const routeMarker = L.marker(midpoint, {
                            icon: L.divIcon({
                                className: 'route-info-icon',
                                html: `<div style="background-color: ${color}; color: white; padding: 2px 6px; border-radius: 3px; font-size: 10px; font-weight: bold;">${route.jenis_transportasi}</div>`,
                                iconSize: [60, 20],
                                iconAnchor: [30, 10]
                            })
                        }).addTo(map);
                        
                        routeMarker.bindPopup(`
                            <div class="p-2">
                                <h3 class="font-bold">${route.nama_jalur}</h3>
                                <p class="text-sm text-gray-600">${route.titik_awal.nama_tempat} → ${route.titik_tujuan.nama_tempat}</p>
                                <p class="text-sm text-gray-600">Jenis: ${route.jenis_transportasi}</p>
                                <p class="text-sm text-gray-600">Waktu: ${Math.floor(route.estimasi_waktu / 60)}j ${route.estimasi_waktu % 60}m</p>
                                <p class="text-sm text-gray-600">Jarak: ${route.jarak_km} km</p>
                                <p class="text-sm text-gray-600">Status: ${route.status}</p>
                            </div>
                        `);
                        
                        routes.push(polyline);
                        routes.push(routeMarker);
                    }
                });
            })
            .catch(error => {
                console.error('Error loading transportation routes:', error);
            });
    }
    
    // Show routes from a specific point
    window.showRoutesFromPoint = function(pointId) {
        fetch(`/admin/api/transportation-routes?from_point=${pointId}`)
            .then(response => response.json())
            .then(data => {
                // Clear existing routes
                routes.forEach(route => map.removeLayer(route));
                routes = [];
                
                data.forEach(route => {
                    if (route.titik_awal && route.titik_tujuan) {
                        const color = getRouteColor(route.jenis_transportasi);
                        const polyline = L.polyline([
                            [route.titik_awal.latitude, route.titik_awal.longitude],
                            [route.titik_tujuan.latitude, route.titik_tujuan.longitude]
                        ], {
                            color: color,
                            weight: 4,
                            opacity: 0.8
                        }).addTo(map);
                        
                        routes.push(polyline);
                    }
                });
            });
    };
    
    // Get marker color based on transportation type
    function getMarkerColor(jenis) {
        switch(jenis) {
            case 'Darat': return '#ef4444'; // red
            case 'Laut': return '#3b82f6';  // blue
            case 'Udara': return '#10b981'; // green
            default: return '#6b7280'; // gray
        }
    }
    
    // Get route color based on transportation type
    function getRouteColor(jenis) {
        switch(jenis) {
            case 'kereta': return '#dc2626'; // red
            case 'bus': return '#ea580c';    // orange
            case 'pesawat': return '#059669'; // green
            case 'kapal': return '#2563eb';  // blue
            case 'mobil': return '#7c3aed';  // purple
            case 'motor': return '#dc2626';  // red
            default: return '#6b7280';       // gray
        }
    }
    
    // Update data table
    function updateDataTable(data) {
        const tbody = document.getElementById('dataTable');
        tbody.innerHTML = '';
        
        data.forEach(point => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${point.nama_tempat}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        ${point.jenis_transportasi}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${point.kabupaten}, ${point.provinsi}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${point.latitude}, ${point.longitude}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="/admin/titik-masuk/${point.id}/edit" class="text-blue-600 hover:text-blue-900">Edit</a>
                </td>
            `;
            tbody.appendChild(row);
        });
    }
    
    // Filter functionality
    document.getElementById('filter_provinsi').addEventListener('change', function() {
        const provinsi = this.value;
        const kabupatenSelect = document.getElementById('filter_kabupaten');
        
        if (provinsi) {
            fetch(`/admin/api/kabupaten-list?provinsi=${encodeURIComponent(provinsi)}`)
                .then(response => response.json())
                .then(data => {
                    kabupatenSelect.innerHTML = '<option value="">Semua Kabupaten</option>';
                    data.forEach(kab => {
                        const option = document.createElement('option');
                        option.value = kab;
                        option.textContent = kab;
                        kabupatenSelect.appendChild(option);
                    });
                });
        } else {
            kabupatenSelect.innerHTML = '<option value="">Semua Kabupaten</option>';
        }
    });
    
    // Apply filter
    document.getElementById('applyFilter').addEventListener('click', function() {
        const filters = {
            provinsi: document.getElementById('filter_provinsi').value,
            kabupaten: document.getElementById('filter_kabupaten').value,
            jenis_transportasi: document.getElementById('filter_transportasi').value
        };
        
        // Remove empty filters
        Object.keys(filters).forEach(key => {
            if (!filters[key]) delete filters[key];
        });
        
        loadTransportationPoints(filters);
    });
    
    // Load initial data
    loadTransportationPoints();
});
</script>

<style>
.custom-div-icon {
    background: transparent;
    border: none;
}
</style>
@endsection