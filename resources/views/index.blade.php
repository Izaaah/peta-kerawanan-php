<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peta Kerawanan Narkoba Jawa Timur</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white px-6 py-4 flex justify-between items-center rounded-none border-b border-blue-500 shadow-lg">
        <div class="flex items-center space-x-2">
          <img src="https://img.icons8.com/ios-filled/50/ffffff/map.png" alt="Logo" class="w-6 h-6" />
          <span class="font-bold text-lg">Peta Kerawanan Narkoba</span>
        </div>
        <nav class="space-x-4">
          <a href="#" class="hover:text-blue-200 transition-colors duration-200 font-medium">Beranda</a>
          <a href="#statistik" class="hover:text-blue-200 transition-colors duration-200 font-medium">Statistik</a>
          <a href="#peta" class="hover:text-blue-200 transition-colors duration-200 font-medium">Laporan</a>
          <a href="#kontak" class="hover:text-blue-200 transition-colors duration-200 font-medium">Kontak</a>
        </nav>
      </header>
      <div class="relative text-white text-center pb-16 pt-20 px-4 rounded-b-xl overflow-hidden " style="background-image: url('{{ asset('storage/img/bg-page.png') }}'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10">
          <h1 class="text-4xl font-bold mb-2">SIJAGAD</h1>
          <p class="mb-6">Sistem Informasi Jaringan Pemetaan Kawasan Rawan Geospasial Berbasis Intelijen Dasar</p>
          <p class="mb-8">Sistem visualisasi untuk memantau tingkat kerawanan Narkoba di Jawa Timur secara real-time.</p>
          <div class="space-x-4">
            <a href="#peta" class="bg-white text-blue-700 px-6 py-2 rounded hover:bg-gray-100 font-semibold">Lihat Peta Sekarang</a>
            <a href="#tentang" class="border border-white px-6 py-2 rounded hover:bg-white hover:text-blue-700 font-semibold">Mulai Eksplorasi</a>
          </div>
        </div>
      </div>
      <section class="p-6">
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
      </section>
      <section id="statistik" class="text-center py-12 px-6">
        <h2 class="text-2xl font-bold mb-10">Ringkasan Statistik</h2>
        <div class="grid md:grid-cols-3 gap-6">
          <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-blue-500">
            <div class="text-3xl font-bold mb-1">4,524</div>
            <div class="text-gray-600">Total Kasus</div>
            <div class="text-green-600 text-sm mt-2">↓ 8% dari bulan lalu</div>
          </div>
          <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-red-500">
            <div class="text-xl font-bold mb-1">Jawa Timur</div>
            <div class="text-gray-600">Daerah Rawan Tertinggi</div>
            <div class="text-red-600 text-sm mt-2">↑ 512 kasus aktif</div>
          </div>
          <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-green-500">
            <div class="text-3xl font-bold mb-1">189</div>
            <div class="text-gray-600">Tren Bulanan</div>
            <div class="text-green-600 text-sm mt-2">↓ Menurun 12% bulan ini</div>
          </div>
        </div>
      </section>
      <section id="tentang" class="bg-blue-600 text-white py-16 px-6 rounded-lg mx-4 my-10">
        <h2 class="text-2xl font-bold mb-4">Tentang Platform Ini</h2>
        <p class="mb-8 max-w-3xl">Platform Peta Kerawanan Narkoba adalah sistem informasi terintegrasi yang menyajikan visualisasi data dan analisis mengenai persebaran kasus narkoba di Indonesia.</p>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="bg-blue-500 p-4 rounded">
            <h3 class="font-semibold text-lg mb-2">Data Terintegrasi</h3>
            <p>Menggabungkan data dari berbagai instansi untuk informasi yang akurat dan terpercaya.</p>
          </div>
          <div class="bg-blue-500 p-4 rounded">
            <h3 class="font-semibold text-lg mb-2">Update Real-time</h3>
            <p>Data diperbarui berkala untuk informasi terkini di lapangan.</p>
          </div>
          <div class="bg-blue-500 p-4 rounded">
            <h3 class="font-semibold text-lg mb-2">Keamanan Data</h3>
            <p>Dilengkapi sistem keamanan berlapis untuk melindungi integritas data.</p>
          </div>
          <div class="bg-blue-500 p-4 rounded">
            <h3 class="font-semibold text-lg mb-2">Kolaborasi Multi-Instansi</h3>
            <p>Kerja sama antarinstansi pemerintah untuk pencegahan narkoba.</p>
          </div>
          <div class="bg-blue-500 p-4 rounded col-span-2">
            <h3 class="font-semibold text-lg mb-2">Visi Kami</h3>
            <p>Mewujudkan Indonesia bebas narkoba melalui sistem informasi yang transparan, akurat, dan terintegrasi untuk mendukung pengambilan keputusan yang efektif.</p>
          </div>
        </div>
      </section>
      <footer id="kontak" class="bg-blue-800 text-white py-10 px-6 text-sm mt-10">
        <div class="grid md:grid-cols-4 gap-6 mb-6">
          <div>
            <h4 class="font-bold mb-2">Informasi Kontak</h4>
            <p>📞 +62 21 1234 5678</p>
            <p>📧 info@petanarkoba.go.id</p>
            <p>📍 Jakarta, Indonesia</p>
          </div>
          <div>
            <h4 class="font-bold mb-2">Tautan Penting</h4>
            <ul class="space-y-1">
              <li><a href="#" class="hover:underline">Panduan Penggunaan</a></li>
              <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
              <li><a href="#" class="hover:underline">Syarat dan Ketentuan</a></li>
              <li><a href="#" class="hover:underline">FAQ</a></li>
            </ul>
          </div>
          <div>
            <h4 class="font-bold mb-2">Instansi Terkait</h4>
            <ul class="space-y-1">
              <li>Polri</li>
              <li>BNN</li>
              <li>Kemendagri</li>
            </ul>
          </div>
          <div>
            <h4 class="font-bold mb-2">Media Sosial</h4>
            <div class="flex space-x-4">
              <a href="#"><img src="https://img.icons8.com/ios-filled/24/ffffff/facebook.png"/></a>
              <a href="#"><img src="https://img.icons8.com/ios-filled/24/ffffff/twitterx.png"/></a>
              <a href="#"><img src="https://img.icons8.com/ios-filled/24/ffffff/instagram-new.png"/></a>
              <a href="#"><img src="https://img.icons8.com/ios-filled/24/ffffff/youtube-play.png"/></a>
            </div>
          </div>
        </div>
        <p class="text-center text-gray-300 mt-4">&copy; 2024 Peta Kerawanan Narkoba. Seluruh hak cipta dilindungi.</p>
        <p class="text-center text-gray-400 text-xs mt-2">Disclaimer: Data yang ditampilkan bersifat informatif dan dapat berubah sewaktu-waktu. Untuk informasi resmi, silakan hubungi instansi terkait.</p>
      </footer>

      <!-- Leaflet CSS -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

      <!-- Leaflet JS -->
      <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

      <script>
        // Debug: Check if Leaflet is loaded
        if (typeof L === 'undefined') {
            console.error('Leaflet is not loaded!');
            document.getElementById('map').innerHTML = `
                <div class="flex items-center justify-center h-full bg-gray-100 rounded-lg">
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Leaflet Map Library Error</h3>
                        <p class="text-gray-500">Leaflet library tidak dapat dimuat. Periksa koneksi internet.</p>
                    </div>
                </div>
            `;
        } else {
            console.log('Leaflet loaded successfully');

            // Inisialisasi peta dengan ukuran yang lebih besar
            const bounds = L.latLngBounds(
                L.latLng(-8.8, 110.8), // barat daya
                L.latLng(-6.5, 114.5)  // timur laut
            );

            const map = L.map('map', {
                minZoom: 8, // atau 9, sesuaikan dengan kebutuhan
                maxZoom: 16,
                maxBounds: bounds,
                maxBoundsViscosity: 1.0
            }).setView([-7.5, 112.5], 9);

            // Tambahkan tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Variabel untuk menyimpan data desa dan layer
            let desaData = [];
            let geoJsonLayer = null;

            // Fetch data dari endpoint
            console.log('Fetching map data...');
            fetch('/peta-kerawanan')
                .then(res => {
                    console.log('Response status:', res.status);
                    if (!res.ok) {
                        throw new Error(`HTTP error! status: ${res.status}`);
                    }
                    return res.json();
                })
                .then(data => {
                    console.log('Map data received:', data);
                    desaData = data.features || [];
                    console.log('Features count:', desaData.length);

                    if (!data.features || data.features.length === 0) {
                        throw new Error('No features found in GeoJSON data');
                    }

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
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm font-medium text-gray-700">Status:</span>
                                            <span class="text-sm px-2 py-1 rounded-full ${getStatusBadgeColor(feature.properties.status || 'Aktif')}">${feature.properties.status || 'Aktif'}</span>
                                        </div>
                                    </div>
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-gray-500">Tingkat Kerawanan:</span>
                                            <span class="text-xs font-medium ${getKerawananColor(feature.properties.jumlah_kasus || 0)} kerawanan-text">
                                                ${getKerawananLevel(feature.properties.jumlah_kasus || 0)}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            `;
                            layer.bindPopup(popupContent);

                            // Tambahkan fetch jumlah individu
                            layer.on('popupopen', function() {
                                fetch(`/api/individu-count?kabupaten=${encodeURIComponent(feature.properties.kabupaten)}&kecamatan=${encodeURIComponent(feature.properties.kecamatan)}&desa=${encodeURIComponent(feature.properties.nama_desa)}`)
                                    .then(res => res.json())
                                    .then(data => {
                                        document.getElementById(`individu-count-${desaId}`).innerHTML = data.count;
                                        // Update tingkat kerawanan di popup
                                        const kerawananText = document.querySelector(`#individu-count-${desaId}`).closest('.leaflet-popup-content').querySelector('.kerawanan-text');
                                        const kerawananLevel = getKerawananLevel(data.count);
                                        const kerawananColor = getKerawananColor(data.count);
                                        if (kerawananText) {
                                            kerawananText.textContent = kerawananLevel;
                                            kerawananText.className = `text-xs font-medium ${kerawananColor} kerawanan-text`;
                                        }
                                        // --- Tambahan: update warna poligon di peta ---
                                        feature.properties.jumlah_kasus = data.count;
                                        layer.setStyle({
                                            fillColor: getColor(data.count)
                                        });
                                    })
                                    .catch(() => {
                                        document.getElementById(`individu-count-${desaId}`).innerHTML = 'Gagal memuat';
                                    });
                            });
                        }
                    }).addTo(map);
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
                                <p class="text-gray-500">Error: ${error.message}</p>
                                <p class="text-gray-500 text-sm mt-2">Coba refresh halaman atau periksa console untuk detail error.</p>
                                <button onclick="location.reload()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Muat Ulang
                                </button>
                            </div>
                        </div>
                    `;
                });

            function getColor(jumlah) {
                return jumlah > 5 ? '#dc2626' :  // Merah - Tinggi
                       jumlah > 3  ? '#ea580c' :   // Orange - Sedang
                       jumlah > 2 ? '#eab308' :   // Kuning - Rendah
                       jumlah > 1   ? '#22c55e' :   // Hijau - Sangat Rendah
                       jumlah > 0   ? '#3b82f6' :   // Biru - Minimal
                                      '#d1d5db';    // Abu-abu - Tidak ada kasus
            }

            // Helper functions untuk popup
            function getStatusColor(jumlah) {
                return jumlah > 100 ? 'text-red-600' :
                       jumlah > 50  ? 'text-orange-600' :
                       jumlah > 20  ? 'text-yellow-600' :
                       jumlah > 5   ? 'text-green-600' :
                       jumlah > 0   ? 'text-blue-600' :
                                      'text-gray-600';
            }

            function getStatusBadgeColor(status) {
                switch(status.toLowerCase()) {
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
                       jumlah > 50  ? 'Tinggi' :
                       jumlah > 20  ? 'Sedang' :
                       jumlah > 5   ? 'Rendah' :
                       jumlah > 0   ? 'Sangat Rendah' :
                                      'Tidak Ada Kasus';
            }

            function getKerawananColor(jumlah) {
                return jumlah > 100 ? 'text-red-600' :
                       jumlah > 50  ? 'text-orange-600' :
                       jumlah > 20  ? 'text-yellow-600' :
                       jumlah > 5   ? 'text-green-600' :
                       jumlah > 0   ? 'text-blue-600' :
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
                    searchResultsList.innerHTML = '<div class="p-3 text-gray-500 text-center">Tidak ada desa yang ditemukan</div>';
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
                                if (layer.feature && layer.feature.properties.nama_desa === desa.properties.nama_desa) {
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
        }
      </script>
</body>
</html>
