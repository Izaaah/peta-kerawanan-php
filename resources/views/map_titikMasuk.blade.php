@extends($layout ?? 'layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Peta Kerawanan - Titik Masuk Narkoba</h1>
                    @if (Auth::check() && Auth::user()->role === 'super-admin')
                        <div class="flex space-x-2">
                            <button id="saveRouteBtn"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                    </path>
                                </svg>
                                Simpan Rute
                            </button>
                            <button id="clearMapBtn"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Clear Map
                            </button>
                        </div>
                    @else
                        <div class="">
                        </div>
                    @endif
                </div>

                @if (Auth::check() && Auth::user()->role === 'super-admin')
                    <!-- Control Panel -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg mb-4 border border-blue-200">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-sm font-semibold text-gray-700">🗺️ Multi-Waypoint Route</h3>
                            <div class="text-sm text-gray-600">
                                Klik pada peta untuk menambah waypoint
                            </div>
                        </div>

                        <!-- Multi-Waypoint Mode -->
                        <div id="multiModePanel">
                            <div class="bg-white rounded-lg p-4 border border-gray-300">
                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="font-semibold text-gray-700">📍 Waypoints</h4>
                                    <button id="clearWaypoints"
                                        class="text-sm px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        Clear All
                                    </button>
                                </div>
                                <div class="bg-blue-50 p-2 rounded mb-2 text-xs text-blue-800">
                                    💡 <strong>Tip:</strong> Klik pada peta untuk menambah waypoint. Klik kanan marker untuk
                                    edit/hapus.
                                </div>
                                <div id="waypointsList" class="space-y-2 max-h-48 overflow-y-auto">
                                    <p class="text-gray-500 text-sm text-center py-4">Klik peta untuk menambahkan
                                        waypoint...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Info Panel for Admin (Read-only) -->
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-lg mb-4 border border-gray-200">
                        <div class="flex items-center justify-center">
                            <div class="text-center">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">📍 Peta Titik Masuk Narkoba</h3>
                                <p class="text-sm text-gray-600">Anda dapat melihat rute yang telah dibuat oleh Super Admin
                                </p>
                                <div class="mt-2 flex items-center justify-center space-x-2">
                                    <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                                    <span class="text-sm text-gray-600">Mode Tampilan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Info Panel -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Titik Awal</p>
                                <p id="startCoords" class="text-lg font-bold text-blue-700">-</p>
                            </div>
                            <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Titik Tujuan</p>
                                <p id="endCoords" class="text-lg font-bold text-red-700">-</p>
                            </div>
                            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Jarak</p>
                                <p id="distanceInfo" class="text-lg font-bold text-green-700">-</p>
                            </div>
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Status</p>
                                <p id="statusInfo" class="text-lg font-bold text-purple-700">Siap</p>
                            </div>
                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="bg-yellow-50 p-4 rounded-lg mb-4 border border-yellow-200">
                    <div class="flex">
                        <svg class="w-5 h-5 text-yellow-600 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-yellow-800">Cara Penggunaan:</p>
                            <ol class="list-decimal list-inside text-sm text-yellow-700 mt-2 space-y-1">
                                <li>Klik pada peta untuk menempatkan <strong>Titik Awal</strong> (marker biru)</li>
                                <li>Klik lagi untuk menempatkan <strong>Titik Tujuan</strong> (marker merah)</li>
                                <li>Geser marker untuk menyesuaikan posisi sebelum di-lock</li>
                                <li>Pilih <strong>Jenis Transportasi</strong> dari dropdown</li>
                                <li>Klik <strong>Lock Titik</strong> untuk mengunci posisi marker</li>
                                <li>Klik <strong>Mulai Animasi</strong> untuk melihat simulasi pergerakan transportasi</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Grid Layout: Map + Saved Routes -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                    <!-- Map Container -->
                    <div class="lg:col-span-2 relative">
                        <div id="map" class="w-full rounded-lg shadow-lg border-4 border-gray-300"
                            style="height: 600px;"></div>

                        @if (Auth::check() && Auth::user()->role === 'super-admin')
                            <!-- Floating Animation Button -->
                            <button id="startAnimationBtn" title="Mulai Animasi Rute" aria-label="Mulai Animasi Rute"
                                style="position: absolute; top: 10px; right: 10px; z-index: 1000; background-color: #10b981; color: white; font-weight: bold; padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center; transition: all 0.2s; border: none; cursor: pointer; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;"
                                onmouseover="this.style.backgroundColor='#059669'; this.style.transform='scale(1.05)'"
                                onmouseout="this.style.backgroundColor='#10b981'; this.style.transform='scale(1)'">
                                <svg style="width: 24px; height: 24px; margin-right: 8px;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span style="font-weight: 600;">▶ Mulai Animasi</span>
                            </button>
                        @endif
                    </div>

                    <!-- Saved Routes Panel -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-lg border border-gray-300 p-4"
                            style="height: 600px; overflow-y: auto;">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold text-gray-800">📋 Rute Tersimpan</h3>
                                <div class="flex items-center space-x-2">
                                    @if (Auth::check() && Auth::user()->role !== 'super-admin')
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                                            👀 Lihat Saja
                                        </span>
                                    @endif
                                    <button id="refreshRoutesBtn" class="text-blue-600 hover:text-blue-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div id="savedRoutesList" class="space-y-3">
                                <div class="text-center text-gray-500 py-8">
                                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                        </path>
                                    </svg>
                                    <p>Belum ada rute tersimpan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Legend -->
                <div class="mt-4 bg-white p-4 rounded-lg border border-gray-200">
                    <h3 class="font-semibold text-gray-700 mb-3">Legenda:</h3>
                    <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm">Titik Awal</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-red-500 rounded-full mr-2"></div>
                            <span class="text-sm">Titik Tujuan</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-0.5 bg-green-500 mr-2"></div>
                            <span class="text-sm">Rute Transportasi</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">✈️</span>
                            <span class="text-sm">Pesawat</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">🚢</span>
                            <span class="text-sm">Kapal</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">🚗</span>
                            <span class="text-sm">Kendaraan Darat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .leaflet-popup-content-wrapper {
            border-radius: 8px;
        }

        .leaflet-popup-content {
            font-family: 'Inter', sans-serif;
        }

        .custom-marker {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        /* Context Menu Styles */
        .context-menu {
            position: fixed;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 8px 0;
            z-index: 10000 !important;
            min-width: 200px;
        }

        .context-menu-item {
            padding: 10px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.2s;
        }

        .context-menu-item:hover {
            background: #f3f4f6;
        }

        .context-menu-item.danger:hover {
            background: #fee;
            color: #dc2626;
        }

        .context-menu-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 4px 0;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/map-waypoints.js') }}" defer></script>
    <script>
        // Minimal inline script - main functionality moved to external file
        console.log('Map page loaded - external script will handle initialization');

        // User role for JavaScript access control
        const userRole = @json(Auth::check() && Auth::user() ? Auth::user()->role : 'guest');
        const isSuperAdmin = userRole === 'super-admin';
        console.log('User role:', userRole, 'Is Super Admin:', isSuperAdmin);

        // Set global variables for external JavaScript
        window.userRole = userRole;
        window.isSuperAdmin = isSuperAdmin;

        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 19
        }).addTo(map);

        // Variables
        // Simple mode variables removed - only multi-waypoint mode
        let movingMarker = null;
        let animationInProgress = false;
        let savedRoutes = []; // Array to store all saved routes
        let savedRouteLayers = {}; // Object to store route layers on map

        // Multi-waypoint variables
        let currentMode = 'multi'; // Only multi-waypoint mode
        let waypoints = []; // Array of {location, lat, lng, transport_to_next, marker}
        let waypointMarkers = [];
        let waypointLines = [];
        let contextMenu = null;
        let pendingWaypointLocation = null;

        // Custom icons
        const startIcon = L.divIcon({
            html: '<div style="background-color: #3B82F6; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.3);"></div>',
            className: 'custom-marker',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });

        const endIcon = L.divIcon({
            html: '<div style="background-color: #EF4444; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.3);"></div>',
            className: 'custom-marker',
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });

        // Transport icons mapping
        const transportIcons = {
            'pesawat': '✈️',
            'kapal': '🚢',
            'kereta': '🚂',
            'mobil': '🚗',
            'motor': '🏍️',
            'truk': '🚚'
        };

        // Update coordinates display
        function updateCoordinates() {
            if (startMarker) {
                const lat = startMarker.getLatLng().lat.toFixed(6);
                const lng = startMarker.getLatLng().lng.toFixed(6);
                document.getElementById('startCoords').textContent = `${lat}, ${lng}`;
            }
            if (endMarker) {
                const lat = endMarker.getLatLng().lat.toFixed(6);
                const lng = endMarker.getLatLng().lng.toFixed(6);
                document.getElementById('endCoords').textContent = `${lat}, ${lng}`;
            }
            updateDistance();
        }

        // Calculate and display distance
        function updateDistance() {
            if (startMarker && endMarker) {
                const distance = startMarker.getLatLng().distanceTo(endMarker.getLatLng());
                const distanceKm = (distance / 1000).toFixed(2);
                document.getElementById('distanceInfo').textContent = `${distanceKm} km`;
            }
        }

        // Draw route line
        function drawRoute() {
            if (routeLine) {
                map.removeLayer(routeLine);
            }

            if (startMarker && endMarker) {
                routeLine = L.polyline([
                    startMarker.getLatLng(),
                    endMarker.getLatLng()
                ], {
                    color: '#10B981',
                    weight: 4,
                    opacity: 0.7,
                    dashArray: '10, 10'
                }).addTo(map);

                updateDistance();
            }
        }

        // Map click handler
        map.on('click', function(e) {
            if (isLocked) {
                alert('⚠️ Titik sudah di-lock! Klik "Unlock Titik" untuk mengubah posisi.');
                return;
            }

            if (!startMarker) {
                // Create start marker
                startMarker = L.marker(e.latlng, {
                    draggable: true,
                    icon: startIcon
                }).addTo(map);

                startMarker.bindPopup('<b>📍 Titik Awal</b><br>Geser untuk menyesuaikan posisi')
                    .openPopup();

                startMarker.on('dragend', function() {
                    drawRoute();
                    updateCoordinates();
                });

                updateCoordinates();
                updateStatus('Titik awal ditempatkan. Klik peta untuk titik tujuan.');

            } else if (!endMarker) {
                // Create end marker
                endMarker = L.marker(e.latlng, {
                    draggable: true,
                    icon: endIcon
                }).addTo(map);

                endMarker.bindPopup('<b>🎯 Titik Tujuan</b><br>Geser untuk menyesuaikan posisi')
                    .openPopup();

                endMarker.on('dragend', function() {
                    drawRoute();
                    updateCoordinates();
                });

                drawRoute();
                updateCoordinates();
                updateStatus('Kedua titik ditempatkan. Pilih transportasi dan klik "Lock Titik".');
            }
        });

        // Lock/Unlock button
        document.getElementById('lockPointsBtn').addEventListener('click', function() {
            if (!startMarker || !endMarker) {
                alert('⚠️ Tempatkan kedua titik terlebih dahulu!');
                return;
            }

            isLocked = !isLocked;

            if (isLocked) {
                startMarker.dragging.disable();
                endMarker.dragging.disable();
                this.classList.remove('bg-yellow-500', 'hover:bg-yellow-600');
                this.classList.add('bg-red-500', 'hover:bg-red-600');
                document.getElementById('lockBtnText').textContent = 'Unlock Titik';
                document.getElementById('lockIcon').innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>';
                updateStatus('🔒 Titik terkunci. Siap untuk animasi.');
            } else {
                startMarker.dragging.enable();
                endMarker.dragging.enable();
                this.classList.remove('bg-red-500', 'hover:bg-red-600');
                this.classList.add('bg-yellow-500', 'hover:bg-yellow-600');
                document.getElementById('lockBtnText').textContent = 'Lock Titik';
                document.getElementById('lockIcon').innerHTML =
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>';
                updateStatus('🔓 Titik terbuka. Geser marker untuk menyesuaikan.');
            }
        });

        // Start animation button
        document.getElementById('startAnimationBtn').addEventListener('click', function() {
            // Multi-waypoint animation only
            if (waypoints.length < 2) {
                alert('⚠️ Tambahkan minimal 2 waypoint terlebih dahulu!');
                return;
            }

            if (animationInProgress) {
                alert('⚠️ Animasi sedang berjalan!');
                return;
            }

            startMultiWaypointAnimation();
        });

        // Animation function
        function startAnimation(transportType) {
            // Remove previous moving marker if exists
            if (movingMarker) {
                map.removeLayer(movingMarker);
            }

            animationInProgress = true;
            updateStatus(`🚀 Animasi ${transportType} dimulai...`);

            const emoji = transportIcons[transportType] || '🚗';
            const transportIconHtml = L.divIcon({
                html: `<div style="font-size: 32px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">${emoji}</div>`,
                className: 'custom-marker',
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            });

            // Create moving marker
            movingMarker = L.marker(startMarker.getLatLng(), {
                icon: transportIconHtml
            }).addTo(map);

            // Calculate animation duration based on distance
            const distance = startMarker.getLatLng().distanceTo(endMarker.getLatLng());
            const duration = Math.max(3000, Math.min(10000, distance / 100)); // 3-10 seconds

            // Animate marker
            animateMarker(movingMarker, startMarker.getLatLng(), endMarker.getLatLng(), duration);
        }

        // Marker animation function
        function animateMarker(marker, start, end, duration) {
            const startTime = Date.now();

            function animate() {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // Linear interpolation
                const lat = start.lat + (end.lat - start.lat) * progress;
                const lng = start.lng + (end.lng - start.lng) * progress;

                marker.setLatLng([lat, lng]);

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    animationInProgress = false;
                    updateStatus('✅ Animasi selesai!');
                    marker.bindPopup('🎯 Tiba di tujuan!').openPopup();
                }
            }

            animate();
        }

        // Multi-waypoint animation function
        function startMultiWaypointAnimation() {
            if (movingMarker) {
                map.removeLayer(movingMarker);
            }

            animationInProgress = true;
            let currentSegment = 0;

            function animateSegment() {
                if (currentSegment >= waypoints.length - 1) {
                    animationInProgress = false;
                    updateStatus('✅ Animasi selesai! Tiba di tujuan.');
                    if (movingMarker) {
                        movingMarker.bindPopup(`🎯 Tiba di ${waypoints[waypoints.length - 1].location}!`)
                            .openPopup();
                    }
                    return;
                }

                const start = waypoints[currentSegment];
                const end = waypoints[currentSegment + 1];
                const transport = start.transport_to_next || 'mobil';

                updateStatus(
                    `🚀 Segmen ${currentSegment + 1}/${waypoints.length - 1}: ${start.location} → ${end.location} (${transportIcons[transport]})`
                );

                // Create or update moving marker with current transport icon
                const emoji = transportIcons[transport] || '🚗';
                const transportIconHtml = L.divIcon({
                    html: `<div style="font-size: 32px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">${emoji}</div>`,
                    className: 'custom-marker',
                    iconSize: [32, 32],
                    iconAnchor: [16, 16]
                });

                if (!movingMarker) {
                    movingMarker = L.marker([start.lat, start.lng], {
                        icon: transportIconHtml
                    }).addTo(map);
                } else {
                    movingMarker.setIcon(transportIconHtml);
                    movingMarker.setLatLng([start.lat, start.lng]);
                }

                // Calculate duration for this segment
                const distance = L.latLng(start.lat, start.lng).distanceTo(L.latLng(end.lat, end.lng));
                const duration = Math.max(2000, Math.min(5000, distance / 150));

                // Animate this segment
                const startTime = Date.now();

                function animate() {
                    const elapsed = Date.now() - startTime;
                    const progress = Math.min(elapsed / duration, 1);

                    const lat = start.lat + (end.lat - start.lat) * progress;
                    const lng = start.lng + (end.lng - start.lng) * progress;

                    movingMarker.setLatLng([lat, lng]);

                    if (progress < 1) {
                        requestAnimationFrame(animate);
                    } else {
                        // This segment complete, move to next
                        currentSegment++;
                        setTimeout(() => animateSegment(), 500); // Pause 0.5s between segments
                    }
                }

                animate();
            }

            // Start first segment
            animateSegment();
        }

        // Clear map button
        document.getElementById('clearMapBtn').addEventListener('click', function() {
            if (confirm('🗑️ Hapus semua marker dan rute dari peta?')) {
                // Clear simple mode markers
                if (startMarker) {
                    map.removeLayer(startMarker);
                    startMarker = null;
                }
                if (endMarker) {
                    map.removeLayer(endMarker);
                    endMarker = null;
                }
                if (routeLine) {
                    map.removeLayer(routeLine);
                    routeLine = null;
                }
                if (movingMarker) {
                    map.removeLayer(movingMarker);
                    movingMarker = null;
                }

                // Clear multi-waypoint mode markers
                clearWaypoints();

                animationInProgress = false;
                updateStatus('🗑️ Peta dibersihkan. Klik peta untuk menambah waypoint.');
            }
        });

        // Save route button
        document.getElementById('saveRouteBtn').addEventListener('click', function() {
            if (!startMarker || !endMarker) {
                alert('⚠️ Tempatkan kedua titik terlebih dahulu!');
                return;
            }

            const transportType = document.getElementById('transportType').value;
            if (!transportType) {
                alert('⚠️ Pilih jenis transportasi terlebih dahulu!');
                return;
            }

            const routeData = {
                start_location: document.getElementById('startLocationName').value || 'Lokasi Awal',
                end_location: document.getElementById('endLocationName').value || 'Lokasi Tujuan',
                start_lat: startMarker.getLatLng().lat,
                start_lng: startMarker.getLatLng().lng,
                end_lat: endMarker.getLatLng().lat,
                end_lng: endMarker.getLatLng().lng,
                transport_type: transportType,
                distance: startMarker.getLatLng().distanceTo(endMarker.getLatLng()) / 1000
            };

            console.log('Route Data:', routeData);

            // TODO: Send to backend via AJAX
            // fetch('/api/save-route', {
            //     method: 'POST',
            //     headers: { 'Content-Type': 'application/json' },
            //     body: JSON.stringify(routeData)
            // });

            alert('💾 Rute berhasil disimpan!\n\n' +
                'Dari: ' + routeData.start_location + '\n' +
                'Ke: ' + routeData.end_location + '\n' +
                'Transportasi: ' + routeData.transport_type + '\n' +
                'Jarak: ' + routeData.distance.toFixed(2) + ' km');

            updateStatus('💾 Rute tersimpan!');
        });

        // Update status info
        function updateStatus(message) {
            document.getElementById('statusInfo').textContent = message;
        }

        // Initial status
        updateStatus('Siap');

        // ============================================
        // MULTI-WAYPOINT MODE FUNCTIONALITY
        // ============================================

        // Initialize multi-waypoint mode
        document.getElementById('multiModePanel').classList.remove('hidden');
        updateStatus('Mode Multi-Waypoint aktif. Klik peta untuk menambah waypoint.');
        console.log('Multi-waypoint mode initialized');

        // Context Menu Functions
        function closeContextMenu() {
            if (contextMenu) {
                contextMenu.remove();
                contextMenu = null;
            }
        }

        // Show context menu on map
        function showMapContextMenu(e) {
            console.log('showMapContextMenu called', e.containerPoint);
            closeContextMenu();

            const menu = document.createElement('div');
            menu.className = 'context-menu';

            // Position relative to map container
            const mapContainer = document.getElementById('map');
            const rect = mapContainer.getBoundingClientRect();
            menu.style.left = (rect.left + e.containerPoint.x) + 'px';
            menu.style.top = (rect.top + e.containerPoint.y) + 'px';
            menu.style.position = 'fixed';

            const waypointNum = waypoints.length + 1;

            menu.innerHTML = `
                    <div class="context-menu-item" onclick="addWaypointHere(${e.latlng.lat}, ${e.latlng.lng})">
                        <span style="font-size: 20px;">📍</span>
                        <span><strong>Tambah Waypoint ${waypointNum}</strong></span>
                    </div>
                `;

            document.body.appendChild(menu);
            contextMenu = menu;

            console.log('Context menu created and appended');
            pendingWaypointLocation = e.latlng;
        }

        // Show context menu on waypoint marker
        function showWaypointContextMenu(e, waypointIndex) {
            closeContextMenu();
            e.originalEvent.preventDefault();
            e.originalEvent.stopPropagation();

            const menu = document.createElement('div');
            menu.className = 'context-menu';

            // Position relative to map container
            const mapContainer = document.getElementById('map');
            const rect = mapContainer.getBoundingClientRect();
            menu.style.left = (rect.left + e.containerPoint.x) + 'px';
            menu.style.top = (rect.top + e.containerPoint.y) + 'px';
            menu.style.position = 'fixed';

            const wp = waypoints[waypointIndex];

            menu.innerHTML = `
                    <div class="context-menu-item" onclick="editWaypointName(${waypointIndex})">
                        <span>✏️</span>
                        <span>Edit Nama</span>
                    </div>
                    ${waypointIndex < waypoints.length - 1 ? `
                                                                                                                    <div class="context-menu-item" onclick="changeTransport(${waypointIndex})">
                                                                                                                        <span>🚗</span>
                                                                                                                        <span>Ubah Transportasi</span>
                                                                                                                    </div>
                                                                                                                    ` : ''}
                    <div class="context-menu-divider"></div>
                    <div class="context-menu-item danger" onclick="removeWaypoint(${waypointIndex})">
                        <span>🗑️</span>
                        <span>Hapus Waypoint</span>
                    </div>
                `;

            document.body.appendChild(menu);
            contextMenu = menu;
        }

        // Add waypoint at clicked location
        window.addWaypointHere = function(lat, lng, locationName = null) {
            closeContextMenu();

            const waypointNum = waypoints.length + 1;
            const location = locationName || prompt(`📍 Nama Waypoint ${waypointNum}:`,
                `Titik ${waypointNum}`);
            if (!location) return;

            // Choose transport to next point (only if we already have waypoints)
            let transportToNext = null;
            if (waypoints.length > 0) {
                transportToNext = chooseTransport(waypoints[waypoints.length - 1].location, location);
            }

            // Create waypoint with purple numbered marker
            createWaypoint(location, lat, lng, transportToNext);
        }

        // Choose transport dialog
        function chooseTransport(fromLocation, toLocation) {
            const transportChoice = prompt(
                `🚗 Transportasi dari "${fromLocation}" ke "${toLocation}":\n\n` +
                `1 = ✈️ Pesawat\n2 = 🚢 Kapal\n3 = 🚂 Kereta\n4 = 🚗 Mobil\n5 = 🏍️ Motor\n6 = 🚚 Truk\n\n` +
                `Pilih (1-6):`,
                '4'
            );

            const transportOptions = ['pesawat', 'kapal', 'kereta', 'mobil', 'motor', 'truk'];
            const transportIndex = parseInt(transportChoice) - 1;
            if (transportIndex >= 0 && transportIndex < transportOptions.length) {
                return transportOptions[transportIndex];
            }
            return 'mobil';
        }

        // Create waypoint marker
        function createWaypoint(location, lat, lng, transportToNext) {
            const waypointNum = waypoints.length + 1;

            const waypointIcon = L.divIcon({
                html: `<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; width: 35px; height: 35px; border-radius: 50%; border: 3px solid white; box-shadow: 0 3px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px;">${waypointNum}</div>`,
                className: 'custom-marker',
                iconSize: [35, 35],
                iconAnchor: [17.5, 17.5]
            });

            const marker = L.marker([lat, lng], {
                icon: waypointIcon,
                draggable: true
            }).addTo(map);

            marker.bindPopup(`<b>${waypointNum}. ${location}</b>`);

            // Add to waypoints array
            const waypoint = {
                location: location,
                lat: lat,
                lng: lng,
                transport_to_next: transportToNext,
                marker: marker
            };
            waypoints.push(waypoint);
            waypointMarkers.push(marker);

            // Add context menu on right click
            const waypointIndex = waypoints.length - 1;
            marker.on('contextmenu', function(e) {
                showWaypointContextMenu(e, waypointIndex);
            });

            // Draw lines between waypoints
            if (waypoints.length > 1) {
                drawWaypointLines();
            }

            // Update waypoints list UI
            renderWaypointsList();

            // Update marker drag event
            marker.on('dragend', function() {
                waypoint.lat = marker.getLatLng().lat;
                waypoint.lng = marker.getLatLng().lng;
                drawWaypointLines();
                renderWaypointsList();
            });
        }

        // Edit waypoint name
        window.editWaypointName = function(index) {
            closeContextMenu();
            const wp = waypoints[index];
            const newName = prompt(`✏️ Edit Nama Waypoint ${index + 1}:`, wp.location);
            if (newName && newName !== wp.location) {
                wp.location = newName;
                wp.marker.setPopupContent(`<b>${index + 1}. ${newName}</b>`);
                renderWaypointsList();
            }
        }

        // Change transport between waypoints
        window.changeTransport = function(index) {
            closeContextMenu();
            const wp = waypoints[index];
            const nextWp = waypoints[index + 1];

            const newTransport = chooseTransport(wp.location, nextWp.location);
            wp.transport_to_next = newTransport;

            drawWaypointLines();
            renderWaypointsList();
        }

        // Draw lines between waypoints with transport icons
        function drawWaypointLines() {
            // Clear existing lines
            waypointLines.forEach(line => map.removeLayer(line));
            waypointLines = [];

            // Draw lines between consecutive waypoints
            for (let i = 0; i < waypoints.length - 1; i++) {
                const start = waypoints[i];
                const end = waypoints[i + 1];

                // Get transport type for this segment
                const transport = start.transport_to_next || 'mobil';
                const colors = {
                    'pesawat': '#3B82F6',
                    'kapal': '#10B981',
                    'kereta': '#F59E0B',
                    'mobil': '#EF4444',
                    'motor': '#8B5CF6',
                    'truk': '#6B7280'
                };

                const line = L.polyline([
                    [start.lat, start.lng],
                    [end.lat, end.lng]
                ], {
                    color: colors[transport] || '#10B981',
                    weight: 6,
                    opacity: 0.7,
                    dashArray: '10, 5',
                    className: 'draggable-line'
                }).addTo(map);

                // Add right-click on line to insert waypoint
                line.on('contextmenu', function(e) {
                    showLineContextMenu(e, i);
                });

                // Add hover effect
                line.on('mouseover', function(e) {
                    this.setStyle({
                        weight: 8,
                        opacity: 0.9
                    });
                });

                line.on('mouseout', function(e) {
                    this.setStyle({
                        weight: 6,
                        opacity: 0.7
                    });
                });

                // DRAG LINE TO CREATE WAYPOINT
                let isDraggingLine = false;
                let dragMarker = null;

                line.on('mousedown', function(e) {
                    if (e.originalEvent.button !== 0) return; // Only left click

                    isDraggingLine = true;

                    // Create temporary drag marker
                    dragMarker = L.marker(e.latlng, {
                        icon: L.divIcon({
                            html: `<div style="background: #FCD34D; width: 20px; height: 20px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.3);"></div>`,
                            className: 'custom-marker',
                            iconSize: [20, 20],
                            iconAnchor: [10, 10]
                        }),
                        draggable: false
                    }).addTo(map);

                    map.dragging.disable();

                    // Follow mouse movement
                    const onMouseMove = function(e) {
                        if (isDraggingLine && dragMarker) {
                            dragMarker.setLatLng(e.latlng);
                        }
                    };

                    map.on('mousemove', onMouseMove);

                    // Release to create waypoint
                    const onMouseUp = function(e) {
                        if (isDraggingLine) {
                            map.off('mousemove', onMouseMove);
                            map.off('mouseup', onMouseUp);
                            map.dragging.enable();

                            const dragLatLng = dragMarker.getLatLng();
                            map.removeLayer(dragMarker);

                            // Create waypoint at drag position
                            insertWaypointBetweenInteractive(i, dragLatLng.lat, dragLatLng.lng);

                            isDraggingLine = false;
                            dragMarker = null;
                        }
                    };

                    map.on('mouseup', onMouseUp);
                });

                // Add transport icon at midpoint
                const midLat = (start.lat + end.lat) / 2;
                const midLng = (start.lng + end.lng) / 2;
                const icon = transportIcons[transport] || '🚗';

                const transportMarker = L.marker([midLat, midLng], {
                    icon: L.divIcon({
                        html: `<div style="font-size: 24px; background: white; padding: 4px; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">${icon}</div>`,
                        className: 'custom-marker',
                        iconSize: [32, 32],
                        iconAnchor: [16, 16]
                    })
                }).addTo(map);

                // Context menu on transport icon too
                transportMarker.on('contextmenu', function(e) {
                    showLineContextMenu(e, i);
                });

                waypointLines.push(line);
                waypointLines.push(transportMarker);
            }
        }

        // Insert waypoint between (interactive drag version)
        window.insertWaypointBetweenInteractive = function(afterIndex, lat, lng) {
            const start = waypoints[afterIndex];
            const end = waypoints[afterIndex + 1];

            const location = prompt(
                `📍 Nama Waypoint Baru (antara "${start.location}" dan "${end.location}"):`,
                `Titik ${waypoints.length + 1}`);
            if (!location) return;

            // Ask for transport from previous point to this new point
            const transportToPrev = chooseTransport(start.location, location);

            // Ask for transport from this new point to next point
            const transportToNext = chooseTransport(location, end.location);

            // Update previous waypoint's transport
            start.transport_to_next = transportToPrev;

            // Create new waypoint marker
            const waypointNum = afterIndex + 2;
            const waypointIcon = L.divIcon({
                html: `<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; width: 35px; height: 35px; border-radius: 50%; border: 3px solid white; box-shadow: 0 3px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px;">${waypointNum}</div>`,
                className: 'custom-marker',
                iconSize: [35, 35],
                iconAnchor: [17.5, 17.5]
            });

            const marker = L.marker([lat, lng], {
                icon: waypointIcon,
                draggable: true
            }).addTo(map);

            marker.bindPopup(`<b>${waypointNum}. ${location}</b>`);

            // Create new waypoint object
            const newWaypoint = {
                location: location,
                lat: lat,
                lng: lng,
                transport_to_next: transportToNext,
                marker: marker
            };

            // Insert into waypoints array
            waypoints.splice(afterIndex + 1, 0, newWaypoint);
            waypointMarkers.splice(afterIndex + 1, 0, marker);

            // Add context menu handler
            marker.on('contextmenu', function(e) {
                const newIndex = waypoints.findIndex(wp => wp.marker === marker);
                showWaypointContextMenu(e, newIndex);
            });

            // Add drag handler
            marker.on('dragend', function() {
                newWaypoint.lat = marker.getLatLng().lat;
                newWaypoint.lng = marker.getLatLng().lng;
                drawWaypointLines();
                renderWaypointsList();
            });

            // Renumber and redraw
            renumberWaypoints();
            drawWaypointLines();
            renderWaypointsList();
        }

        // Show context menu on line (insert waypoint between)
        function showLineContextMenu(e, segmentIndex) {
            closeContextMenu();
            e.originalEvent.preventDefault();
            e.originalEvent.stopPropagation();

            const menu = document.createElement('div');
            menu.className = 'context-menu';

            const mapContainer = document.getElementById('map');
            const rect = mapContainer.getBoundingClientRect();
            menu.style.left = (rect.left + e.containerPoint.x) + 'px';
            menu.style.top = (rect.top + e.containerPoint.y) + 'px';
            menu.style.position = 'fixed';

            const start = waypoints[segmentIndex];
            const end = waypoints[segmentIndex + 1];

            menu.innerHTML = `
                    <div class="context-menu-item" onclick="insertWaypointBetween(${segmentIndex}, ${e.latlng.lat}, ${e.latlng.lng})">
                        <span>➕</span>
                        <span><strong>Insert Waypoint</strong></span>
                    </div>
                    <div class="context-menu-divider"></div>
                    <div class="context-menu-item" onclick="changeTransport(${segmentIndex})">
                        <span>🚗</span>
                        <span>Ubah Transportasi ${transportIcons[start.transport_to_next] || '🚗'}</span>
                    </div>
                `;

            document.body.appendChild(menu);
            contextMenu = menu;
        }

        // Insert waypoint between two existing waypoints
        window.insertWaypointBetween = function(afterIndex, lat, lng) {
            closeContextMenu();

            const start = waypoints[afterIndex];
            const end = waypoints[afterIndex + 1];

            const location = prompt(
                `📍 Nama Waypoint Baru (antara "${start.location}" dan "${end.location}"):`,
                `Titik ${waypoints.length + 1}`);
            if (!location) return;

            // Ask for transport from previous point to this new point
            const transportToPrev = chooseTransport(start.location, location);

            // Ask for transport from this new point to next point
            const transportToNext = chooseTransport(location, end.location);

            // Update previous waypoint's transport
            start.transport_to_next = transportToPrev;

            // Create new waypoint marker
            const waypointNum = afterIndex + 2; // Temporary, will be renumbered
            const waypointIcon = L.divIcon({
                html: `<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; width: 35px; height: 35px; border-radius: 50%; border: 3px solid white; box-shadow: 0 3px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px;">${waypointNum}</div>`,
                className: 'custom-marker',
                iconSize: [35, 35],
                iconAnchor: [17.5, 17.5]
            });

            const marker = L.marker([lat, lng], {
                icon: waypointIcon,
                draggable: true
            }).addTo(map);

            marker.bindPopup(`<b>${waypointNum}. ${location}</b>`);

            // Create new waypoint object
            const newWaypoint = {
                location: location,
                lat: lat,
                lng: lng,
                transport_to_next: transportToNext,
                marker: marker
            };

            // Insert into waypoints array at correct position
            waypoints.splice(afterIndex + 1, 0, newWaypoint);
            waypointMarkers.splice(afterIndex + 1, 0, marker);

            // Add context menu handler
            marker.on('contextmenu', function(e) {
                const newIndex = waypoints.findIndex(wp => wp.marker === marker);
                showWaypointContextMenu(e, newIndex);
            });

            // Add drag handler
            marker.on('dragend', function() {
                newWaypoint.lat = marker.getLatLng().lat;
                newWaypoint.lng = marker.getLatLng().lng;
                drawWaypointLines();
                renderWaypointsList();
            });

            // Renumber all markers
            renumberWaypoints();

            // Redraw lines
            drawWaypointLines();
            renderWaypointsList();
        }

        // Renumber all waypoint markers
        function renumberWaypoints() {
            waypoints.forEach((wp, i) => {
                const newIcon = L.divIcon({
                    html: `<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; width: 35px; height: 35px; border-radius: 50%; border: 3px solid white; box-shadow: 0 3px 8px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px;">${i + 1}</div>`,
                    className: 'custom-marker',
                    iconSize: [35, 35],
                    iconAnchor: [17.5, 17.5]
                });
                wp.marker.setIcon(newIcon);
                wp.marker.setPopupContent(`<b>${i + 1}. ${wp.location}</b>`);
            });
        }

        // Render waypoints list UI
        window.renderWaypointsList = function() {
            const list = document.getElementById('waypointsList');

            if (waypoints.length === 0) {
                list.innerHTML =
                    '<p class="text-gray-500 text-sm text-center py-4">Klik kanan peta untuk menambahkan waypoint...</p>';
                return;
            }

            list.innerHTML = waypoints.map((wp, index) => {
                const nextTransport = wp.transport_to_next ? transportIcons[wp.transport_to_next] :
                    '';
                const arrow = index < waypoints.length - 1 ? `→ ${nextTransport}` : '';

                return `
                        <div class="flex items-center justify-between bg-gray-50 p-2 rounded border">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-purple-600">${index + 1}.</span>
                                <div>
                                    <p class="text-sm font-semibold">${wp.location}</p>
                                    <p class="text-xs text-gray-500">${wp.lat.toFixed(6)}, ${wp.lng.toFixed(6)}</p>
                                </div>
                                ${arrow ? `<span class="text-lg">${arrow}</span>` : ''}
                            </div>
                            <button onclick="removeWaypoint(${index})" class="text-red-600 hover:text-red-800 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    `;
            }).join('');
        }

        // Remove waypoint
        window.removeWaypoint = function(index) {
            if (!confirm(`Hapus waypoint "${waypoints[index].location}"?`)) return;

            // Remove marker from map
            map.removeLayer(waypoints[index].marker);

            // Remove from array
            waypoints.splice(index, 1);
            waypointMarkers.splice(index, 1);

            // Renumber all markers
            renumberWaypoints();

            // Redraw everything
            drawWaypointLines();
            renderWaypointsList();
        }

        // Clear all waypoints
        function clearWaypoints() {
            waypointMarkers.forEach(marker => map.removeLayer(marker));
            waypointLines.forEach(line => map.removeLayer(line));
            waypoints = [];
            waypointMarkers = [];
            waypointLines = [];
            renderWaypointsList();
        }

        document.getElementById('clearWaypoints').addEventListener('click', clearWaypoints);

        // Close context menu on regular click
        document.addEventListener('click', closeContextMenu);

        // Map right-click handler for multi mode
        console.log('Setting up contextmenu event listeners...');

        map.on('contextmenu', function(e) {
            console.log('Leaflet contextmenu triggered at:', e.latlng);
            e.originalEvent.preventDefault();
            e.originalEvent.stopPropagation();
            showMapContextMenu(e);
        });

        // Alternative: Listen for right-click on the map container
        const mapElement = document.getElementById('map');
        console.log('Map element found:', mapElement);

        mapElement.addEventListener('contextmenu', function(e) {
            console.log('DOM contextmenu triggered at:', e.clientX, e.clientY);
            e.preventDefault();
            e.stopPropagation();

            // Convert screen coordinates to map coordinates
            const mapContainer = map.getContainer();
            const rect = mapContainer.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const latlng = map.containerPointToLatLng([x, y]);

            console.log('Converted coordinates:', latlng);

            // Create fake event object for showMapContextMenu
            const fakeEvent = {
                latlng: latlng,
                originalEvent: e,
                containerPoint: [x, y]
            };

            showMapContextMenu(fakeEvent);
        });

        console.log('Context menu event listeners set up!');

        // Map click handler - add waypoint on click (Super Admin only)
        map.on('click', function(e) {
            closeContextMenu();
            console.log('Map clicked at:', e.latlng);

            // Only allow super-admin to add waypoints
            if (!isSuperAdmin) {
                console.log('Access denied: Only Super Admin can add waypoints');
                return;
            }

            // Add waypoint directly on click
            const waypointNum = waypoints.length + 1;
            const locationName = `Waypoint ${waypointNum}`;

            addWaypointHere(e.latlng.lat, e.latlng.lng, locationName);
        });

        // Save button for multi-waypoint routes (Super Admin only)
        if (isSuperAdmin && document.getElementById('saveRouteBtn')) {
            document.getElementById('saveRouteBtn').addEventListener('click', function() {
                // Save multi-waypoint route
                if (waypoints.length < 2) {
                    alert('⚠️ Tambahkan minimal 2 waypoint!');
                    return;
                }

                const routeName = prompt('Nama rute:', `Rute ${waypoints.length} titik`);
                if (!routeName) return;

                // Calculate total distance
                let totalDistance = 0;
                for (let i = 0; i < waypoints.length - 1; i++) {
                    const start = L.latLng(waypoints[i].lat, waypoints[i].lng);
                    const end = L.latLng(waypoints[i + 1].lat, waypoints[i + 1].lng);
                    totalDistance += start.distanceTo(end);
                }

                const routeData = {
                    route_name: routeName,
                    is_multi_segment: true,
                    waypoints: waypoints.map(wp => ({
                        location: wp.location,
                        lat: wp.lat,
                        lng: wp.lng,
                        transport_to_next: wp.transport_to_next
                    })),
                    distance_km: (totalDistance / 1000).toFixed(2),
                    color: '#667eea'
                };

                fetch('/api/transportation-routes', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(routeData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('💾 Rute multi-waypoint berhasil disimpan!');
                            clearWaypoints();
                            updateStatus('💾 Rute tersimpan!');
                        } else {
                            alert('❌ Gagal menyimpan rute!');
                        }
                    })
                    .catch(error => {
                        console.error('Error saving route:', error);
                        alert('❌ Terjadi kesalahan saat menyimpan rute!');
                    });
            });
        }
    </script>
@endpush
