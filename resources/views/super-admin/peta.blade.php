@extends('layouts.superadmin-master')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Peta Kerawanan Narkoba</h1>
                <div class="flex space-x-2">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export Data
                    </button>
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Analisis
                    </button>
                </div>
            </div>

            <!-- Search Section -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-200">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Desa</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text"
                                   id="searchDesa"
                                   placeholder="Masukkan nama desa..."
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button id="searchBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        <button id="clearSearchBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Reset
                        </button>
                    </div>
                </div>
                <!-- Search Results -->
                <div id="searchResults" class="mt-3 hidden">
                    <div class="bg-white rounded-lg border border-gray-200 max-h-48 overflow-y-auto">
                        <div id="searchResultsList" class="p-2">
                            <!-- Results will be populated here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                        <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Kabupaten</option>
                            <option value="surabaya">Surabaya</option>
                            <option value="malang">Malang</option>
                            <option value="sidoarjo">Sidoarjo</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                        <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                            <option value="proses">Dalam Proses</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Peta Container -->
            <div class="relative">
                <div id="map" class="w-full h-[600px] rounded-lg border border-gray-300"></div>

                <!-- Legend -->
                <div class="absolute top-4 right-4 bg-white p-4 rounded-lg shadow-lg border border-gray-200">
                    <h4 class="font-semibold text-gray-900 mb-3">Legenda</h4>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-red-600 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Tinggi (>100 kasus)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-orange-500 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Sedang (50-100 kasus)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-yellow-400 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Rendah (20-50 kasus)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-green-400 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Sangat Rendah (5-20 kasus)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-blue-300 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Minimal (1-5 kasus)</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 bg-gray-200 rounded mr-2"></div>
                            <span class="text-sm text-gray-700">Tidak ada kasus</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Ringkas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                    <h3 class="font-semibold text-red-800">Daerah Rawan Tinggi</h3>
                    <p class="text-2xl font-bold text-red-600">12 Desa</p>
                    <p class="text-sm text-red-600">>100 kasus per desa</p>
                </div>
                <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                    <h3 class="font-semibold text-orange-800">Daerah Rawan Sedang</h3>
                    <p class="text-2xl font-bold text-orange-600">28 Desa</p>
                    <p class="text-sm text-orange-600">50-100 kasus per desa</p>
                </div>
                <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    <h3 class="font-semibold text-yellow-800">Daerah Rawan Rendah</h3>
                    <p class="text-2xl font-bold text-yellow-600">45 Desa</p>
                    <p class="text-sm text-yellow-600">20-50 kasus per desa</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<script>
    // Inisialisasi peta dengan ukuran yang lebih besar
    const map = L.map('map').setView([-7.5, 112.5], 9);

    // Tambahkan tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Variabel untuk menyimpan data desa dan layer
    let desaData = [];
    let geoJsonLayer = null;

    // Fetch data dari endpoint
    fetch('/peta-kerawanan')
        .then(res => res.json())
        .then(data => {
            desaData = data.features || [];

            geoJsonLayer = L.geoJSON(data, {
                style: feature => {
                    const jumlah = feature.properties.jumlah_kasus || 0;
                    return {
                        fillColor: getColor(jumlah),
                        weight: 1,
                        color: 'white',
                        fillOpacity: 0.7
                    };
                },
                onEachFeature: (feature, layer) => {
                    const popupContent = `
                        <div class="p-4 min-w-[250px]">
                            <div class="border-b border-gray-200 pb-3 mb-3">
                                <h3 class="font-bold text-lg text-gray-900 mb-1">${feature.properties.nama_desa || 'N/A'}</h3>
                                <p class="text-sm text-gray-600">Desa/Kelurahan</p>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Kabupaten:</span>
                                    <span class="text-sm font-medium">${feature.properties.kabupaten || 'N/A'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Kecamatan:</span>
                                    <span class="text-sm font-medium">${feature.properties.kecamatan || 'N/A'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Jumlah Kasus:</span>
                                    <span class="text-sm font-bold text-red-600">${feature.properties.jumlah_kasus || 0}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Level Kerawanan:</span>
                                    <span class="text-sm font-medium ${getKerawananClass(feature.properties.kerawanan_level)}">${feature.properties.kerawanan_level || 'N/A'}</span>
                                </div>
                            </div>
                        </div>
                    `;
                    layer.bindPopup(popupContent);
                }
            }).addTo(map);
        })
        .catch(error => {
            console.error('Error loading map data:', error);
        });

    // Function untuk menentukan warna berdasarkan jumlah kasus
    function getColor(jumlah) {
        if (jumlah > 100) return '#dc2626'; // Red
        if (jumlah > 50) return '#f97316'; // Orange
        if (jumlah > 20) return '#eab308'; // Yellow
        if (jumlah > 5) return '#22c55e'; // Green
        if (jumlah > 0) return '#60a5fa'; // Blue
        return '#d1d5db'; // Gray
    }

    // Function untuk menentukan class CSS berdasarkan level kerawanan
    function getKerawananClass(level) {
        switch(level) {
            case 'Tinggi': return 'text-red-600';
            case 'Sedang': return 'text-orange-600';
            case 'Rendah': return 'text-yellow-600';
            case 'Sangat Rendah': return 'text-green-600';
            case 'Minimal': return 'text-blue-600';
            default: return 'text-gray-600';
        }
    }

    // Search functionality
    const searchInput = document.getElementById('searchDesa');
    const searchBtn = document.getElementById('searchBtn');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const searchResults = document.getElementById('searchResults');
    const searchResultsList = document.getElementById('searchResultsList');

    searchBtn.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        searchResults.classList.add('hidden');
        if (geoJsonLayer) {
            geoJsonLayer.setStyle({
                fillColor: feature => getColor(feature.properties.jumlah_kasus || 0),
                weight: 1,
                color: 'white',
                fillOpacity: 0.7
            });
        }
    });

    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        if (!searchTerm) return;

        const filteredDesa = desaData.filter(desa =>
            desa.properties.nama_desa.toLowerCase().includes(searchTerm) ||
            desa.properties.kabupaten.toLowerCase().includes(searchTerm) ||
            desa.properties.kecamatan.toLowerCase().includes(searchTerm)
        );

        if (filteredDesa.length > 0) {
            // Highlight searched areas
            if (geoJsonLayer) {
                geoJsonLayer.setStyle(feature => {
                    const isMatch = filteredDesa.some(fd => fd.properties.nama_desa === feature.properties.nama_desa);
                    return {
                        fillColor: isMatch ? '#8b5cf6' : '#d1d5db',
                        weight: isMatch ? 3 : 1,
                        color: isMatch ? '#7c3aed' : 'white',
                        fillOpacity: isMatch ? 0.9 : 0.3
                    };
                });
            }

            // Show search results
            searchResultsList.innerHTML = filteredDesa.map(desa => `
                <div class="p-2 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0"
                     onclick="focusOnDesa('${desa.properties.nama_desa}')">
                    <div class="font-medium text-gray-900">${desa.properties.nama_desa}</div>
                    <div class="text-sm text-gray-600">${desa.properties.kecamatan}, ${desa.properties.kabupaten}</div>
                    <div class="text-sm text-red-600 font-medium">${desa.properties.jumlah_kasus || 0} kasus</div>
                </div>
            `).join('');
            searchResults.classList.remove('hidden');
        } else {
            searchResultsList.innerHTML = '<div class="p-2 text-gray-500">Tidak ada hasil ditemukan</div>';
            searchResults.classList.remove('hidden');
        }
    }

    function focusOnDesa(desaName) {
        const targetDesa = desaData.find(desa => desa.properties.nama_desa === desaName);
        if (targetDesa) {
            const coordinates = targetDesa.geometry.coordinates[0][0];
            const center = coordinates.reduce((acc, coord) => {
                return [acc[0] + coord[1], acc[1] + coord[0]];
            }, [0, 0]).map(coord => coord / coordinates.length);

            map.setView(center, 12);

            // Find and open popup for the target desa
            geoJsonLayer.eachLayer(layer => {
                if (layer.feature.properties.nama_desa === desaName) {
                    layer.openPopup();
                }
            });
        }
    }
</script>
@endpush
@endsection
