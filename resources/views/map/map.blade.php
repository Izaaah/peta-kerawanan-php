@extends($layout ?? 'layouts.app')

@section('content')
    <div class="container-fluid px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Peta Kerawanan Narkoba Berdasarkan Domisili</h1>
                    <div class="flex space-x-2">
                        <!-- Screenshot Dropdown -->
                        <div class="relative">
                            <button id="screenshotBtn"
                                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded flex items-center shadow-lg">
                                📸 Screenshot ▼
                            </button>
                            <div id="screenshotDropdown"
                                class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                                <div class="py-1">
                                    <button id="screenshotWithBackground"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        🗺️ Screenshot dengan Background Peta
                                    </button>
                                    <button id="screenshotKerawananOnly"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        🎯 Screenshot Peta Kerawanan Saja
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export Data
                        </button>
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
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
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="searchDesa" placeholder="Masukkan nama desa..."
                                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button id="searchBtn"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </button>
                            <button id="clearSearchBtn"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
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
                            <select id="kabupatenFilter"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Kabupaten</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                            <select id="kecamatanFilter"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Kecamatan</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                            <select
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                                <option value="proses">Dalam Proses</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button id="resetFilterBtn"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Reset Filter
                        </button>
                    </div>
                </div>

                <!-- Peta Container -->
                <div class="relative">
                    <div id="map" class="w-full h-[600px] rounded-lg border border-gray-300"></div>

                    <!-- Screenshot Button (Alternative) -->
                    <div class="absolute top-4 left-4">
                        <div class="relative">
                            <button id="screenshotBtnAlt"
                                class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                                📸 Screenshot ▼
                            </button>
                            <div id="screenshotDropdownAlt"
                                class="hidden absolute left-0 mt-2 w-64 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                                <div class="py-1">
                                    <button id="screenshotWithBackgroundAlt"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        🗺️ Screenshot dengan Background Peta
                                    </button>
                                    <button id="screenshotKerawananOnlyAlt"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        🎯 Screenshot Peta Kerawanan Saja
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Legend -->
                    <div class="absolute top-4 right-4 bg-white p-4 rounded-lg shadow-lg border border-gray-200">
                        <h4 class="font-semibold text-gray-900 mb-3">Legenda</h4>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-red-600 rounded mr-2"></div>
                                <span class="text-sm text-gray-700">Tinggi (>5 kasus)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-orange-500 rounded mr-2"></div>
                                <span class="text-sm text-gray-700">Sedang (>3 kasus)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-yellow-400 rounded mr-2"></div>
                                <span class="text-sm text-gray-700">Rendah (>2 kasus)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-green-400 rounded mr-2"></div>
                                <span class="text-sm text-gray-700">Sangat Rendah (>1 kasus)</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-blue-300 rounded mr-2"></div>
                                <span class="text-sm text-gray-700">Minimal (1 kasus)</span>
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
                        <p class="text-2xl font-bold text-red-600" id="tinggi-count">0</p>
                        <p class="text-sm text-red-600">>5 kasus per desa</p>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                        <h3 class="font-semibold text-orange-800">Daerah Rawan Sedang</h3>
                        <p class="text-2xl font-bold text-orange-600" id="sedang-count">0</p>
                        <p class="text-sm text-orange-600">>3 kasus per desa</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <h3 class="font-semibold text-yellow-800">Daerah Rawan Rendah</h3>
                        <p class="text-2xl font-bold text-yellow-600" id="rendah-count">0</p>
                        <p class="text-sm text-yellow-600">>2 kasus per desa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalDetail"
        class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4 mt-12">
        <div
            class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto mt-10 transform transition-all duration-300 ease-in-out">
            <div class="relative px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Anggaran Baru</h3>
                <button id="closeModalDetail"
                    class="absolute top-[20px] right-4 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="border-b border-gray-200 pb-3 mb-3">
                <h3 class="font-bold text-lg text-gray-900 mb-1">${feature.properties.nama_desa || 'N/A'}</h3>
                <p class="text-sm text-gray-600">Desa/Kelurahan</p>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-700">Kecamatan:</span>
                    <span class="text-sm text-gray-900">${feature.properties.kecamatan || 'N/A'}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-700">Kota/Kabupaten:</span>
                    <span class="text-sm text-gray-900">${feature.properties.kabupaten || 'N/A'}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-700">Jumlah Individu:</span>
                    <span class="text-sm font-bold" id="individu-count-${desaId}">Memuat...</span>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-500">Tingkat Kerawanan:</span>
                    <span
                        class="text-xs font-medium ${getKerawananColor(feature.properties.jumlah_kasus || 0)} kerawanan-text">
                        ${getKerawananLevel(feature.properties.jumlah_kasus || 0)}
                    </span>
                </div>
                <div class="flex items-center justify-end">
                    <a href="#"
                        class="text-xs bg-blue-500 p-1 text-white rounded-sm text-right underline font-medium mt-2"
                        onClick="openModalDetail()">
                        Lebih detail
                    </a>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

        <script>
            // Inisialisasi peta dengan ukuran yang lebih besar
            const bounds = L.latLngBounds(
                L.latLng(-8.8, 110.8), // barat daya
                L.latLng(-6.5, 114.5) // timur laut
            );

            const map = L.map('map', {
                minZoom: 8, // atau 9, sesuaikan dengan kebutuhan
                maxZoom: 16,
                maxBounds: bounds,
                maxBoundsViscosity: 1.0
            }).setView([-7.5, 112.5], 9);

            // Tambahkan tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: ''
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
                            const desaId = feature.properties.nama_desa.replace(/[^a-zA-Z0-9]/g, '_');
                            const popupContent = `
                        <div class="p-4 min-w-[250px]">
                            <div class="border-b border-gray-200 pb-3 mb-3">
                                <h3 class="font-bold text-lg text-gray-900 mb-1">${feature.properties.nama_desa || 'N/A'}</h3>
                                <p class="text-sm text-gray-600">Desa/Kelurahan</p>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Kecamatan:</span>
                                    <span class="text-sm text-gray-900">${feature.properties.kecamatan || 'N/A'}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Kota/Kabupaten:</span>
                                    <span class="text-sm text-gray-900">${feature.properties.kabupaten || 'N/A'}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-700">Jumlah Individu:</span>
                                    <span class="text-sm font-bold" id="individu-count-${desaId}">Memuat...</span>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-700">Informan:</span>
                                        <span class="text-sm font-bold" id="informan-count-${desaId}">Memuat...</span>
                                    </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium text-gray-700">Broker:</span>
                                            <span class="text-sm font-bold" id="broker-count-${desaId}">-</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium text-gray-700">Bandar:</span>
                                            <span class="text-sm font-bold" id="bandar-count-${desaId}">-</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium text-gray-700">Kurir:</span>
                                            <span class="text-sm font-bold" id="kurir-count-${desaId}">-</span>
                                        </div>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-500">Tingkat Kerawanan:</span>
                                    <span class="text-xs font-medium ${getKerawananColor(feature.properties.jumlah_kasus || 0)} kerawanan-text">
                                        ${getKerawananLevel(feature.properties.jumlah_kasus || 0)}
                                    </span>
                                </div>
                                <div class="flex items-center justify-end">
                                    <a href="#" class="text-xs bg-blue-500 p-1 text-white rounded-sm text-right underline font-medium mt-2" onClick="openModalDetail()">
                                        Lebih detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    `;
                            layer.bindPopup(popupContent);

                            // Tambahkan fetch jumlah individu
                            layer.on('popupopen', function() {
                                fetch(
                                        `/api/individu-count?kabupaten=${encodeURIComponent(feature.properties.kabupaten)}&kecamatan=${encodeURIComponent(feature.properties.kecamatan)}&desa=${encodeURIComponent(feature.properties.nama_desa)}`
                                    )
                                    .then(res => res.json())
                                    .then(data => {
                                        document.getElementById(`individu-count-${desaId}`)
                                            .innerHTML = data.count;
                                        // Update tingkat kerawanan di popup
                                        const kerawananText = document.querySelector(
                                            `#individu-count-${desaId}`).closest(
                                            '.leaflet-popup-content').querySelector(
                                            '.kerawanan-text');
                                        const kerawananLevel = getKerawananLevel(data.count);
                                        const kerawananColor = getKerawananColor(data.count);
                                        if (kerawananText) {
                                            kerawananText.textContent = kerawananLevel;
                                            kerawananText.className =
                                                `text-xs font-medium ${kerawananColor} kerawanan-text`;
                                        }
                                        // --- Tambahan: update warna poligon di peta ---
                                        feature.properties.jumlah_kasus = data.count;
                                        layer.setStyle({
                                            fillColor: getColor(data.count)
                                        });

                                        // Update statistik setelah data berubah
                                        calculateKerawananStats();

                                        // Juga update dari API untuk data yang lebih akurat
                                        setTimeout(() => {
                                            fetchKerawananStats();
                                        }, 500);
                                    })
                                    .catch(() => {
                                        document.getElementById(`individu-count-${desaId}`)
                                            .innerHTML = 'Gagal memuat';
                                    });
                            });

                            layer.on('popupopen', function() {
                                fetch(
                                        `/api/informan-detail?kabupaten=${encodeURIComponent(feature.properties.kabupaten)}&kecamatan=${encodeURIComponent(feature.properties.kecamatan)}&desa=${encodeURIComponent(feature.properties.nama_desa)}`
                                    )
                                    .then(res => res.json())
                                    .then(data => {
                                        // Update total informan
                                        document.getElementById(`informan-count-${desaId}`)
                                            .innerHTML = data.total;

                                        // Update detail per peran
                                        document.getElementById(`broker-count-${desaId}`)
                                            .innerHTML = data.broker;
                                        document.getElementById(`bandar-count-${desaId}`)
                                            .innerHTML = data.bandar;
                                        document.getElementById(`kurir-count-${desaId}`)
                                            .innerHTML = data.kurir;

                                        // Update tingkat kerawanan di popup
                                        const kerawananText = document.querySelector(
                                            `#informan-count-${desaId}`).closest(
                                            '.leaflet-popup-content').querySelector(
                                            '.kerawanan-text');
                                        const kerawananLevel = getKerawananLevel(data.total);
                                        const kerawananColor = getKerawananColor(data.total);
                                        if (kerawananText) {
                                            kerawananText.textContent = kerawananLevel;
                                            kerawananText.className =
                                                `text-xs font-medium ${kerawananColor} kerawanan-text`;
                                        }
                                        // --- Tambahan: update warna poligon di peta ---
                                        feature.properties.jumlah_kasus = data.total;
                                        layer.setStyle({
                                            fillColor: getColor(data.total)
                                        });

                                        // Update statistik setelah data berubah
                                        calculateKerawananStats();

                                        // Juga update dari API untuk data yang lebih akurat
                                        setTimeout(() => {
                                            fetchKerawananStats();
                                        }, 500);
                                    })
                                    .catch(() => {
                                        document.getElementById(`informan-count-${desaId}`)
                                            .innerHTML = 'Gagal memuat';
                                        document.getElementById(`broker-count-${desaId}`)
                                            .innerHTML = '-';
                                        document.getElementById(`bandar-count-${desaId}`)
                                            .innerHTML = '-';
                                        document.getElementById(`kurir-count-${desaId}`)
                                            .innerHTML = '-';
                                    });
                            });
                        }
                    }).addTo(map);

                    // Update statistik setelah map dimuat
                    updateStatsAfterMapLoad();
                })
                .catch(error => {
                    console.error('Error loading map data:', error);
                    // Tampilkan pesan error yang user-friendly
                    const mapContainer = document.getElementById('map');
                    mapContainer.innerHTML = `
                <div class="flex items-center justify-center h-full bg-gray-100 rounded-lg">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Data Peta Tidak Tersedia</h3>
                        <p class="text-gray-500">File GeoJSON belum tersedia atau terjadi kesalahan saat memuat data.</p>
                        <button onclick="location.reload()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Muat Ulang
                        </button>
                    </div>
                </div>
            `;
                });

            function getColor(jumlah) {
                return jumlah > 5 ? '#dc2626' : // Merah - Tinggi
                    jumlah > 3 ? '#ea580c' : // Orange - Sedang
                    jumlah > 2 ? '#eab308' : // Kuning - Rendah
                    jumlah > 1 ? '#22c55e' : // Hijau - Sangat Rendah
                    jumlah > 0 ? '#3b82f6' : // Biru - Minimal
                    '#d1d5db'; // Abu-abu - Tidak ada kasus
            }

            // Helper functions untuk popup
            function getStatusColor(jumlah) {
                return jumlah > 100 ? 'text-red-600' :
                    jumlah > 50 ? 'text-orange-600' :
                    jumlah > 20 ? 'text-yellow-600' :
                    jumlah > 5 ? 'text-green-600' :
                    jumlah > 0 ? 'text-blue-600' :
                    'text-gray-600';
            }

            function getStatusBadgeColor(status) {
                switch (status.toLowerCase()) {
                    case 'aktif':
                        return 'bg-red-100 text-red-800';
                    case 'selesai':
                        return 'bg-green-100 text-green-800';
                    case 'dalam proses':
                    case 'proses':
                        return 'bg-yellow-100 text-yellow-800';
                    default:
                        return 'bg-gray-100 text-gray-800';
                }
            }

            function getKerawananLevel(jumlah) {
                return jumlah > 100 ? 'Sangat Tinggi' :
                    jumlah > 50 ? 'Tinggi' :
                    jumlah > 20 ? 'Sedang' :
                    jumlah > 5 ? 'Rendah' :
                    jumlah > 0 ? 'Sangat Rendah' :
                    'Tidak Ada Kasus';
            }

            function getKerawananColor(jumlah) {
                return jumlah > 100 ? 'text-red-600' :
                    jumlah > 50 ? 'text-orange-600' :
                    jumlah > 20 ? 'text-yellow-600' :
                    jumlah > 5 ? 'text-green-600' :
                    jumlah > 0 ? 'text-blue-600' :
                    'text-gray-600';
            }

            // Search functionality
            const searchInput = document.getElementById('searchDesa');
            const searchBtn = document.getElementById('searchBtn');
            const clearSearchBtn = document.getElementById('clearSearchBtn');
            const searchResults = document.getElementById('searchResults');
            const searchResultsList = document.getElementById('searchResultsList');

            // Search function
            function searchDesa(query) {
                if (!desaData.length) return;

                const results = desaData.filter(desa =>
                    desa.properties.nama_desa.toLowerCase().includes(query.toLowerCase()) ||
                    desa.properties.kecamatan.toLowerCase().includes(query.toLowerCase()) ||
                    desa.properties.kabupaten.toLowerCase().includes(query.toLowerCase())
                );

                displaySearchResults(results);
            }

            // Display search results
            function displaySearchResults(results) {
                searchResultsList.innerHTML = '';

                if (results.length === 0) {
                    searchResultsList.innerHTML =
                        '<div class="p-3 text-gray-500 text-center">Tidak ada desa yang ditemukan</div>';
                    searchResults.classList.remove('hidden');
                    return;
                }

                results.forEach(desa => {
                    const resultItem = document.createElement('div');
                    resultItem.className = 'p-3 hover:bg-gray-100 cursor-pointer border-b border-gray-100';
                    resultItem.innerHTML = `
                <div class="font-medium text-gray-900">${desa.properties.nama_desa}</div>
                <div class="text-sm text-gray-600">${desa.properties.kecamatan}, ${desa.properties.kabupaten}</div>
            `;

                    resultItem.addEventListener('click', () => {
                        // Zoom to the selected desa
                        if (geoJsonLayer) {
                            geoJsonLayer.eachLayer(layer => {
                                if (layer.feature && layer.feature.properties.nama_desa === desa
                                    .properties.nama_desa) {
                                    map.fitBounds(layer.getBounds());
                                    layer.openPopup();
                                }
                            });
                        }
                        searchResults.classList.add('hidden');
                        searchInput.value = '';
                    });

                    searchResultsList.appendChild(resultItem);
                });

                searchResults.classList.remove('hidden');
            }

            // Event listeners
            searchBtn.addEventListener('click', () => {
                const query = searchInput.value.trim();
                if (query) {
                    searchDesa(query);
                }
            });

            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    const query = searchInput.value.trim();
                    if (query) {
                        searchDesa(query);
                    }
                }
            });

            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.trim();
                if (query.length >= 2) {
                    searchDesa(query);
                } else {
                    searchResults.classList.add('hidden');
                }
            });

            clearSearchBtn.addEventListener('click', () => {
                searchInput.value = '';
                searchResults.classList.add('hidden');
                // Reset map view
                map.setView([-7.5, 112.5], 9);
            });

            // Tambahkan kontrol zoom
            L.control.zoom({
                position: 'bottomright'
            }).addTo(map);

            // Tambahkan kontrol skala
            L.control.scale({
                position: 'bottomleft',
                metric: true,
                imperial: false
            }).addTo(map);

            // Fungsi untuk menghitung statistik kerawanan
            function calculateKerawananStats() {
                if (!desaData || desaData.length === 0) return;

                let tinggiCount = 0;
                let sedangCount = 0;
                let rendahCount = 0;

                desaData.forEach(desa => {
                    const individuCount = desa.properties.jumlah_kasus ||
                        0; // jumlah_kasus di peta sebenarnya adalah jumlah individu

                    // Sesuaikan dengan logika getColor yang menggunakan >5, >3, >2, >1, >0
                    if (individuCount > 5) {
                        tinggiCount++;
                    } else if (individuCount > 3) {
                        sedangCount++;
                    } else if (individuCount > 2) {
                        rendahCount++;
                    }
                });

                // Update kartu statistik
                document.getElementById('tinggi-count').textContent = `${tinggiCount} Desa`;
                document.getElementById('sedang-count').textContent = `${sedangCount} Desa`;
                document.getElementById('rendah-count').textContent = `${rendahCount} Desa`;

                console.log('Statistik kerawanan:', {
                    tinggi: tinggiCount,
                    sedang: sedangCount,
                    rendah: rendahCount
                });
                console.log('Sample data:', desaData.slice(0, 3).map(d => ({
                    nama: d.properties.nama_desa,
                    individu: d.properties.jumlah_kasus
                })));
            }

            // Panggil fungsi statistik setelah data map dimuat
            function updateStatsAfterMapLoad() {
                // Tunggu sebentar untuk memastikan data sudah diproses
                setTimeout(() => {
                    calculateKerawananStats();
                }, 1000);
            }

            // Fungsi untuk mengambil statistik dari API
            function fetchKerawananStats() {
                console.log('Fetching kerawanan stats...');
                fetch('/api/kerawanan-stats')
                    .then(res => {
                        console.log('Response status:', res.status);
                        return res.json();
                    })
                    .then(data => {
                        document.getElementById('tinggi-count').textContent = `${data.tinggi} Desa`;
                        document.getElementById('sedang-count').textContent = `${data.sedang} Desa`;
                        document.getElementById('rendah-count').textContent = `${data.rendah} Desa`;
                        console.log('Statistik dari API:', data);

                        // Debug info
                        if (data.debug) {
                            console.log('=== DEBUG INFO ===');
                            console.log('Total Desa:', data.debug.total_desa);
                            console.log('Total Individu:', data.debug.total_individu);
                            console.log('Desa dengan Individu:', data.debug.desa_dengan_individu);
                            console.log('Total Individu Counted:', data.debug.total_individu_counted);
                            console.log('Sample Desa:', data.debug.sample_desa);
                            console.log('Individu Desa Names:', data.debug.individu_desa_names);
                            console.log('Matching Desa:', data.debug.matching_desa);
                            console.log('Non Matching Individu:', data.debug.non_matching_individu);
                            console.log('==================');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching kerawanan stats:', error);
                        // Fallback ke perhitungan lokal
                        calculateKerawananStats();
                    });
            }


            // const openModalDetail = document.getElementById(openModalDetail);
            // const closeModalDetail = document.getElementById('closeModalBtn');

            function openModalDetail() {
                const modal = document.getElementById('modalDetail');
                modal.classList.remove('hidden'); // Menampilkan modal
                modal.classList.add('flex'); // Menambahkan kelas flex
                document.body.classList.add('overflow-hidden'); // Mencegah body bergulir
            }

            // Fungsi untuk menutup modal
            function closeModalDetail() {
                const modal = document.getElementById('modalDetail');
                modal.classList.add('hidden'); // Menyembunyikan modal
                modal.classList.remove('flex'); // Menghapus kelas flex
                document.body.classList.remove('overflow-hidden'); // Mengembalikan scroll pada body
            }

            // Menambahkan event listener pada tombol untuk menutup modal
            const closeModalButton = document.getElementById('closeModalDetail');
            closeModalButton.addEventListener('click', closeModalDetail);

            // Event listener pada tombol "Lihat Detail" untuk membuka modal
            const lihatDetailButton = document.querySelectorAll('.text-xs.bg-blue-500.p-1.text-white');
            lihatDetailButton.forEach(button => {
                button.addEventListener('click', openModalDetail);
            });

            // Panggil statistik dari API saat halaman dimuat
            fetchKerawananStats();

            // Function to load kabupaten data from API
            function loadKabupatenData(retryCount = 0) {
                console.log(`Loading kabupaten data... (attempt ${retryCount + 1})`);

                const kabupatenSelect = document.getElementById('kabupatenFilter');
                if (!kabupatenSelect) {
                    console.error('Kabupaten select element not found');
                    if (retryCount < 3) {
                        setTimeout(() => loadKabupatenData(retryCount + 1), 1000);
                    }
                    return;
                }

                fetch('/api/kabupaten-list')
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Kabupaten data received:', data);

                        // Clear existing options except the first one
                        kabupatenSelect.innerHTML = '<option value="">Semua Kabupaten</option>';

                        // Add kabupaten options
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(kabupaten => {
                                const option = document.createElement('option');
                                option.value = kabupaten;
                                option.textContent = kabupaten;
                                kabupatenSelect.appendChild(option);
                            });
                            console.log(`Successfully added ${data.length} kabupaten options`);
                        } else {
                            console.error('Data is not an array or is empty:', data);
                            loadFallbackKabupaten();
                        }
                    })
                    .catch(error => {
                        console.error('Error loading kabupaten data:', error);
                        if (retryCount < 2) {
                            console.log(`Retrying in 2 seconds... (attempt ${retryCount + 1})`);
                            setTimeout(() => loadKabupatenData(retryCount + 1), 2000);
                        } else {
                            console.log('Max retries reached, using fallback data');
                            loadFallbackKabupaten();
                        }
                    });
            }

            // Function to load fallback kabupaten data
            function loadFallbackKabupaten() {
                console.log('Loading fallback kabupaten data');
                const kabupatenSelect = document.getElementById('kabupatenFilter');
                if (kabupatenSelect) {
                    kabupatenSelect.innerHTML = '<option value="">Semua Kabupaten</option>';

                    // Add some default kabupaten as fallback
                    const defaultKabupaten = [
                        'Surabaya', 'Malang', 'Sidoarjo', 'Gresik', 'Mojokerto',
                        'Pasuruan', 'Probolinggo', 'Lumajang', 'Jember', 'Banyuwangi',
                        'Bondowoso', 'Situbondo', 'Kediri', 'Blitar', 'Tulungagung',
                        'Trenggalek', 'Ponorogo', 'Pacitan', 'Magetan', 'Ngawi',
                        'Madiun', 'Nganjuk', 'Jombang', 'Bojonegoro', 'Tuban',
                        'Lamongan', 'Bangkalan', 'Sampang', 'Pamekasan', 'Sumenep'
                    ];

                    defaultKabupaten.forEach(kabupaten => {
                        const option = document.createElement('option');
                        option.value = kabupaten;
                        option.textContent = kabupaten;
                        kabupatenSelect.appendChild(option);
                    });

                    console.log('Using fallback kabupaten data');
                }
            }

            // Function to load kecamatan data based on selected kabupaten
            function loadKecamatanData(kabupaten) {
                console.log('Loading kecamatan data for kabupaten:', kabupaten);

                const kecamatanSelect = document.getElementById('kecamatanFilter');
                if (!kecamatanSelect) {
                    console.error('Kecamatan select element not found');
                    return;
                }

                // Clear existing options
                kecamatanSelect.innerHTML = '<option value="">Semua Kecamatan</option>';

                if (!kabupaten) {
                    console.log('No kabupaten selected, kecamatan dropdown cleared');
                    return;
                }

                // Fetch kecamatan data from API
                fetch(`/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
                    .then(response => {
                        console.log('Kecamatan response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Kecamatan data received:', data);

                        // Add kecamatan options
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(kecamatan => {
                                const option = document.createElement('option');
                                option.value = kecamatan;
                                option.textContent = kecamatan;
                                kecamatanSelect.appendChild(option);
                            });
                            console.log(`Successfully added ${data.length} kecamatan options`);
                        } else {
                            console.log('No kecamatan data found for kabupaten:', kabupaten);
                            kecamatanSelect.innerHTML = '<option value="">Tidak ada kecamatan</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error loading kecamatan data:', error);
                        kecamatanSelect.innerHTML = '<option value="">Error loading data</option>';
                    });
            }

            // Function to filter map by kabupaten
            function filterMapByKabupaten(kabupaten) {
                if (!geoJsonLayer) return;

                geoJsonLayer.eachLayer(layer => {
                    if (layer.feature && layer.feature.properties) {
                        const desaKabupaten = layer.feature.properties.kabupaten;

                        if (!kabupaten || desaKabupaten === kabupaten) {
                            // Show the layer
                            layer.setStyle({
                                fillOpacity: 0.7,
                                weight: 1,
                                color: 'white'
                            });
                        } else {
                            // Hide the layer by making it transparent
                            layer.setStyle({
                                fillOpacity: 0.1,
                                weight: 0.5,
                                color: '#ccc'
                            });
                        }
                    }
                });

                // Update statistics for filtered data
                updateFilteredStats(kabupaten);
            }

            // Function to filter map by kecamatan
            function filterMapByKecamatan(kabupaten, kecamatan) {
                if (!geoJsonLayer) return;

                geoJsonLayer.eachLayer(layer => {
                    if (layer.feature && layer.feature.properties) {
                        const desaKabupaten = layer.feature.properties.kabupaten;
                        const desaKecamatan = layer.feature.properties.kecamatan;

                        let shouldShow = true;

                        // Apply kabupaten filter
                        if (kabupaten && desaKabupaten !== kabupaten) {
                            shouldShow = false;
                        }

                        // Apply kecamatan filter
                        if (kecamatan && desaKecamatan !== kecamatan) {
                            shouldShow = false;
                        }

                        if (shouldShow) {
                            // Show the layer
                            layer.setStyle({
                                fillOpacity: 0.7,
                                weight: 1,
                                color: 'white'
                            });
                        } else {
                            // Hide the layer by making it transparent
                            layer.setStyle({
                                fillOpacity: 0.1,
                                weight: 0.5,
                                color: '#ccc'
                            });
                        }
                    }
                });

                // Update statistics for filtered data
                updateFilteredStatsByKecamatan(kabupaten, kecamatan);
            }

            // Function to update statistics based on filtered data
            function updateFilteredStats(kabupaten) {
                if (!desaData || desaData.length === 0) return;

                let filteredData = desaData;
                if (kabupaten) {
                    filteredData = desaData.filter(desa =>
                        desa.properties.kabupaten === kabupaten
                    );
                }

                let tinggiCount = 0;
                let sedangCount = 0;
                let rendahCount = 0;

                filteredData.forEach(desa => {
                    const individuCount = desa.properties.jumlah_kasus || 0;

                    if (individuCount > 5) {
                        tinggiCount++;
                    } else if (individuCount > 3) {
                        sedangCount++;
                    } else if (individuCount > 2) {
                        rendahCount++;
                    }
                });

                // Update kartu statistik
                document.getElementById('tinggi-count').textContent = `${tinggiCount} Desa`;
                document.getElementById('sedang-count').textContent = `${sedangCount} Desa`;
                document.getElementById('rendah-count').textContent = `${rendahCount} Desa`;
            }

            // Function to update statistics based on filtered data by kecamatan
            function updateFilteredStatsByKecamatan(kabupaten, kecamatan) {
                if (!desaData || desaData.length === 0) return;

                let filteredData = desaData;

                // Apply kabupaten filter
                if (kabupaten) {
                    filteredData = filteredData.filter(desa =>
                        desa.properties.kabupaten === kabupaten
                    );
                }

                // Apply kecamatan filter
                if (kecamatan) {
                    filteredData = filteredData.filter(desa =>
                        desa.properties.kecamatan === kecamatan
                    );
                }

                let tinggiCount = 0;
                let sedangCount = 0;
                let rendahCount = 0;

                filteredData.forEach(desa => {
                    const individuCount = desa.properties.jumlah_kasus || 0;

                    if (individuCount > 5) {
                        tinggiCount++;
                    } else if (individuCount > 3) {
                        sedangCount++;
                    } else if (individuCount > 2) {
                        rendahCount++;
                    }
                });

                // Update kartu statistik
                document.getElementById('tinggi-count').textContent = `${tinggiCount} Desa`;
                document.getElementById('sedang-count').textContent = `${sedangCount} Desa`;
                document.getElementById('rendah-count').textContent = `${rendahCount} Desa`;
            }

            // Add event listener for kabupaten filter
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM Content Loaded - Setting up kabupaten filter');

                // Wait a bit for the page to fully load, then load kabupaten data
                setTimeout(function() {
                    console.log('Loading kabupaten data after timeout');
                    loadKabupatenData();
                }, 1000);

                const kabupatenFilter = document.getElementById('kabupatenFilter');
                const kecamatanFilter = document.getElementById('kecamatanFilter');
                const resetFilterBtn = document.getElementById('resetFilterBtn');

                if (kabupatenFilter) {
                    kabupatenFilter.addEventListener('change', function() {
                        const selectedKabupaten = this.value;
                        console.log('Kabupaten filter changed to:', selectedKabupaten);

                        // Load kecamatan data for selected kabupaten
                        loadKecamatanData(selectedKabupaten);

                        // Filter map by kabupaten
                        filterMapByKabupaten(selectedKabupaten);

                        // Optional: Zoom to selected kabupaten
                        if (selectedKabupaten) {
                            zoomToKabupaten(selectedKabupaten);
                        } else {
                            // Reset to default view
                            map.setView([-7.5, 112.5], 9);
                        }
                    });
                } else {
                    console.error('Kabupaten filter element not found');
                }

                // Add event listener for kecamatan filter
                if (kecamatanFilter) {
                    kecamatanFilter.addEventListener('change', function() {
                        const selectedKecamatan = this.value;
                        const selectedKabupaten = kabupatenFilter ? kabupatenFilter.value : '';
                        console.log('Kecamatan filter changed to:', selectedKecamatan, 'for kabupaten:',
                            selectedKabupaten);

                        // Filter map by kecamatan
                        filterMapByKecamatan(selectedKabupaten, selectedKecamatan);

                        // Optional: Zoom to selected kecamatan
                        if (selectedKecamatan && selectedKabupaten) {
                            zoomToKecamatan(selectedKabupaten, selectedKecamatan);
                        } else if (selectedKabupaten) {
                            zoomToKabupaten(selectedKabupaten);
                        } else {
                            // Reset to default view
                            map.setView([-7.5, 112.5], 9);
                        }
                    });
                } else {
                    console.error('Kecamatan filter element not found');
                }

                // Add reset filter functionality
                if (resetFilterBtn) {
                    resetFilterBtn.addEventListener('click', function() {
                        console.log('Reset filter clicked');

                        // Reset kabupaten filter
                        if (kabupatenFilter) {
                            kabupatenFilter.value = '';
                        }

                        // Reset kecamatan filter
                        if (kecamatanFilter) {
                            kecamatanFilter.value = '';
                            kecamatanFilter.innerHTML = '<option value="">Semua Kecamatan</option>';
                        }

                        // Reset map view
                        map.setView([-7.5, 112.5], 9);

                        // Reset all layers to normal visibility
                        if (geoJsonLayer) {
                            geoJsonLayer.eachLayer(layer => {
                                if (layer.feature && layer.feature.properties) {
                                    const jumlah = layer.feature.properties.jumlah_kasus || 0;
                                    layer.setStyle({
                                        fillColor: getColor(jumlah),
                                        fillOpacity: 0.7,
                                        weight: 1,
                                        color: 'white'
                                    });
                                }
                            });
                        }

                        // Reset statistics to show all data
                        updateFilteredStats(null);
                    });
                } else {
                    console.error('Reset filter button not found');
                }

                // Screenshot functionality
                const screenshotBtn = document.getElementById('screenshotBtn');
                const screenshotDropdown = document.getElementById('screenshotDropdown');
                const screenshotWithBackground = document.getElementById('screenshotWithBackground');
                const screenshotKerawananOnly = document.getElementById('screenshotKerawananOnly');

                // Alternative screenshot buttons
                const screenshotBtnAlt = document.getElementById('screenshotBtnAlt');
                const screenshotDropdownAlt = document.getElementById('screenshotDropdownAlt');
                const screenshotWithBackgroundAlt = document.getElementById('screenshotWithBackgroundAlt');
                const screenshotKerawananOnlyAlt = document.getElementById('screenshotKerawananOnlyAlt');

                // Toggle dropdown (header button)
                if (screenshotBtn && screenshotDropdown) {
                    screenshotBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        screenshotDropdown.classList.toggle('hidden');
                        // Close alternative dropdown
                        if (screenshotDropdownAlt) {
                            screenshotDropdownAlt.classList.add('hidden');
                        }
                    });
                }

                // Toggle dropdown (alternative button)
                if (screenshotBtnAlt && screenshotDropdownAlt) {
                    screenshotBtnAlt.addEventListener('click', function(e) {
                        e.stopPropagation();
                        screenshotDropdownAlt.classList.toggle('hidden');
                        // Close header dropdown
                        if (screenshotDropdown) {
                            screenshotDropdown.classList.add('hidden');
                        }
                    });
                }

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (screenshotBtn && screenshotDropdown &&
                        !screenshotBtn.contains(e.target) && !screenshotDropdown.contains(e.target)) {
                        screenshotDropdown.classList.add('hidden');
                    }
                    if (screenshotBtnAlt && screenshotDropdownAlt &&
                        !screenshotBtnAlt.contains(e.target) && !screenshotDropdownAlt.contains(e.target)) {
                        screenshotDropdownAlt.classList.add('hidden');
                    }
                });

                // Screenshot with background (header)
                if (screenshotWithBackground) {
                    screenshotWithBackground.addEventListener('click', function() {
                        screenshotDropdown.classList.add('hidden');
                        takeScreenshotWithBackground();
                    });
                }

                // Screenshot kerawanan only (header)
                if (screenshotKerawananOnly) {
                    screenshotKerawananOnly.addEventListener('click', function() {
                        screenshotDropdown.classList.add('hidden');
                        takeScreenshotKerawananOnly();
                    });
                }

                // Screenshot with background (alternative)
                if (screenshotWithBackgroundAlt) {
                    screenshotWithBackgroundAlt.addEventListener('click', function() {
                        screenshotDropdownAlt.classList.add('hidden');
                        takeScreenshotWithBackground();
                    });
                }

                // Screenshot kerawanan only (alternative)
                if (screenshotKerawananOnlyAlt) {
                    screenshotKerawananOnlyAlt.addEventListener('click', function() {
                        screenshotDropdownAlt.classList.add('hidden');
                        takeScreenshotKerawananOnly();
                    });
                }
            });

            // Function to zoom to selected kabupaten
            function zoomToKabupaten(kabupaten) {
                if (!geoJsonLayer) return;

                const bounds = L.latLngBounds();
                let hasFeatures = false;

                geoJsonLayer.eachLayer(layer => {
                    if (layer.feature &&
                        layer.feature.properties &&
                        layer.feature.properties.kabupaten === kabupaten) {
                        bounds.extend(layer.getBounds());
                        hasFeatures = true;
                    }
                });

                if (hasFeatures) {
                    map.fitBounds(bounds, {
                        padding: [20, 20]
                    });
                }
            }

            // Function to zoom to selected kecamatan
            function zoomToKecamatan(kabupaten, kecamatan) {
                if (!geoJsonLayer) return;

                const bounds = L.latLngBounds();
                let hasFeatures = false;

                geoJsonLayer.eachLayer(layer => {
                    if (layer.feature &&
                        layer.feature.properties &&
                        layer.feature.properties.kabupaten === kabupaten &&
                        layer.feature.properties.kecamatan === kecamatan) {
                        bounds.extend(layer.getBounds());
                        hasFeatures = true;
                    }
                });

                if (hasFeatures) {
                    map.fitBounds(bounds, {
                        padding: [20, 20]
                    });
                }
            }

            // Screenshot functionality
            function takeScreenshotWithBackground() {
                console.log('Taking screenshot with background...');

                // Show loading indicator
                showScreenshotLoading();

                // Get the map container
                const mapContainer = document.getElementById('map');

                // Use html2canvas to capture the map with background
                html2canvas(mapContainer, {
                    backgroundColor: null,
                    scale: 2, // Higher quality
                    useCORS: true,
                    allowTaint: true,
                    logging: false,
                    width: mapContainer.offsetWidth,
                    height: mapContainer.offsetHeight
                }).then(canvas => {
                    // Create download link
                    const link = document.createElement('a');
                    link.download = `peta-kerawanan-with-background-${new Date().toISOString().slice(0, 10)}.png`;
                    link.href = canvas.toDataURL();
                    link.click();

                    hideScreenshotLoading();
                    showScreenshotSuccess('Screenshot dengan background berhasil diunduh!');
                }).catch(error => {
                    console.error('Error taking screenshot:', error);
                    hideScreenshotLoading();
                    showScreenshotError('Gagal mengambil screenshot. Silakan coba lagi.');
                });
            }

            function takeScreenshotKerawananOnly() {
                console.log('Taking screenshot kerawanan only...');

                // Show loading indicator
                showScreenshotLoading();

                // Temporarily hide map tiles to show only the kerawanan data
                const mapContainer = document.getElementById('map');
                const mapTiles = mapContainer.querySelectorAll('.leaflet-tile-pane');

                // Hide map tiles
                mapTiles.forEach(tile => {
                    tile.style.display = 'none';
                });

                // Wait a bit for the change to take effect
                setTimeout(() => {
                    html2canvas(mapContainer, {
                        backgroundColor: '#ffffff',
                        scale: 2,
                        useCORS: true,
                        allowTaint: true,
                        logging: false,
                        width: mapContainer.offsetWidth,
                        height: mapContainer.offsetHeight
                    }).then(canvas => {
                        // Restore map tiles
                        mapTiles.forEach(tile => {
                            tile.style.display = '';
                        });

                        // Create download link
                        const link = document.createElement('a');
                        link.download = `peta-kerawanan-only-${new Date().toISOString().slice(0, 10)}.png`;
                        link.href = canvas.toDataURL();
                        link.click();

                        hideScreenshotLoading();
                        showScreenshotSuccess('Screenshot peta kerawanan berhasil diunduh!');
                    }).catch(error => {
                        // Restore map tiles even if error
                        mapTiles.forEach(tile => {
                            tile.style.display = '';
                        });

                        console.error('Error taking screenshot:', error);
                        hideScreenshotLoading();
                        showScreenshotError('Gagal mengambil screenshot. Silakan coba lagi.');
                    });
                }, 500);
            }

            // Screenshot UI functions
            function showScreenshotLoading() {
                // Create loading overlay
                const loadingOverlay = document.createElement('div');
                loadingOverlay.id = 'screenshotLoading';
                loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                loadingOverlay.innerHTML = `
                    <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600"></div>
                        <span class="text-gray-700">Mengambil screenshot...</span>
                    </div>
                `;
                document.body.appendChild(loadingOverlay);
            }

            function hideScreenshotLoading() {
                const loadingOverlay = document.getElementById('screenshotLoading');
                if (loadingOverlay) {
                    loadingOverlay.remove();
                }
            }

            function showScreenshotSuccess(message) {
                const toast = document.createElement('div');
                toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                toast.innerHTML = `
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>${message}</span>
                    </div>
                `;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 3000);
            }

            function showScreenshotError(message) {
                const toast = document.createElement('div');
                toast.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                toast.innerHTML = `
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>${message}</span>
                    </div>
                `;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 5000);
            }
        </script>
    @endpush
@endsection
