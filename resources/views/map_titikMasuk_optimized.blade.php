@extends($layout ?? 'layouts.app')

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    @php
        $currentUser = Auth::user();
        $userRole = $currentUser ? $currentUser->role : 'guest';
        $isSuperAdmin = $userRole === 'super-admin';
    @endphp
    <div class="container-fluid px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Peta Kerawanan - Titik Masuk Narkoba</h1>
                    @if ($isSuperAdmin)
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
                    @endif
                </div>

                <!-- Control Panel -->
                @if ($isSuperAdmin)
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
                                <div id="waypointsList" class="max-h-40 overflow-y-auto">
                                    <!-- Waypoints will be populated here -->
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="">
                    </div>
                @endif

                <!-- Status Panel -->
                <div class="bg-white p-4 rounded-lg mb-4 border border-gray-300">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-sm font-medium text-gray-700">Status:</span>
                            <span id="statusInfo" class="text-sm text-gray-600">Siap</span>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                @if ($isSuperAdmin)
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Map Container -->
                        <div class="lg:col-span-2 relative">
                            <div id="map" class="w-full rounded-lg shadow-lg border-4 border-gray-300"
                                style="height: 600px;"></div>

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
                        </div>

                        <!-- Saved Routes Panel -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-lg shadow-lg border border-gray-300 p-4"
                                style="height: 600px; overflow-y: auto;">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-bold text-gray-800">📋 Rute Tersimpan</h3>
                                    <div class="flex gap-2">
                                        <button id="refreshRoutesBtn" class="text-blue-600 hover:text-blue-800"
                                            title="Refresh Routes">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="grid grid-cols-1 gap-2 mb-4">
                                    <button id="addNewRouteBtn"
                                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        ➕ Tambah Rute Baru
                                    </button>
                                    <button id="animateAllRoutesBtn"
                                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        🎬 Animasi Semua Rute
                                    </button>
                                    <button id="stopAnimationBtn"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 9h6v6H9z"></path>
                                        </svg>
                                        ⏹️ Stop Animasi
                                    </button>
                                </div>
                                <div id="savedRoutesList">
                                    <!-- Saved routes will be populated here -->
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Read-only Mode: Full Width Map -->
                    <div class="w-full relative">
                        <div id="map" class="w-full rounded-lg shadow-lg border-4 border-gray-300"
                            style="height: 600px;"></div>

                        <!-- Animation Controls for Read-only Mode -->
                        <div class="absolute top-4 right-4 flex flex-col gap-2" style="z-index: 1000;">
                            <button id="animateAllRoutesReadOnlyBtn"
                                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg transition-colors duration-200 flex items-center justify-center gap-2"
                                title="Mainkan Animasi Semua Rute">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                🎬 Mainkan Animasi
                            </button>
                            <button id="stopAnimationReadOnlyBtn"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg transition-colors duration-200 flex items-center justify-center gap-2"
                                title="Hentikan Animasi">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 9h6v6H9z"></path>
                                </svg>
                                ⏹️ Stop Animasi
                            </button>
                        </div>
                    </div>
                @endif


                <!-- Legend Panel -->
                <div class="bg-white p-4 rounded-lg mt-4 border border-gray-300">
                    <h4 class="font-semibold text-gray-700 mb-3">🎨 Keterangan Warna Rute</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-0.5 bg-black" style="border-top: 1px dashed black;"></div>
                            <span class="text-gray-700">🚗🏍️🚚🚂🚌 Jalur Darat (Hitam)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-0.5 bg-blue-500" style="border-top: 1px dashed blue;"></div>
                            <span class="text-gray-700">🚢 Jalur Laut (Biru)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-0.5 bg-red-500" style="border-top: 1px dashed red;"></div>
                            <span class="text-gray-700">✈️ Jalur Udara (Merah)</span>
                        </div>
                        <div class="flex items-center gap-2 mt-3 pt-2 border-t border-gray-200">
                            <div class="flex items-center gap-1">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-xs text-gray-600">Titik Waypoint</span>
                            </div>
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
    <script src="https://unpkg.com/leaflet-movingmarker@1.0.0/MovingMarker.js"></script>
    <script>
        // Set global variables for external JavaScript
        @php
            $currentUser = Auth::user();
            $userRole = $currentUser ? $currentUser->role : 'guest';
        @endphp
        const userRole = @json($userRole);
        const isSuperAdmin = userRole === 'super-admin';
        console.log('User role:', userRole, 'Is Super Admin:', isSuperAdmin);

        window.userRole = userRole;
        window.isSuperAdmin = isSuperAdmin;
    </script>
    <script src="{{ asset('js/map-waypoints.js') }}" defer></script>
@endpush
