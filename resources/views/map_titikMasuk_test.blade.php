@extends('layouts.app')

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="container-fluid px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Peta Kerawanan - Titik Masuk Narkoba (TEST)</h1>
                    <div class="flex space-x-2">
                        <button id="saveRouteBtn"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Simpan Rute
                        </button>
                        <button id="clearMapBtn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Clear Map
                        </button>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Map Container -->
                    <div class="lg:col-span-2 relative">
                        <div id="map" class="w-full rounded-lg shadow-lg border-4 border-gray-300"
                            style="height: 600px;"></div>
                    </div>

                    <!-- Saved Routes Panel -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-lg border border-gray-300 p-4"
                            style="height: 600px; overflow-y: auto;">
                            <h3 class="text-lg font-bold text-gray-800">📋 Rute Tersimpan (TEST)</h3>
                            <div id="savedRoutesList">
                                <p>Test page loaded successfully!</p>
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
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        console.log('Test page loaded successfully!');

        // Set global variables for external JavaScript - TEST
        const userRole = 'super-admin';
        const isSuperAdmin = true;
        console.log('User role:', userRole, 'Is Super Admin:', isSuperAdmin);

        window.userRole = userRole;
        window.isSuperAdmin = isSuperAdmin;

        // Initialize basic map
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([-2.5, 118], 5);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);
            console.log('Basic map initialized');
        });
    </script>
@endpush
