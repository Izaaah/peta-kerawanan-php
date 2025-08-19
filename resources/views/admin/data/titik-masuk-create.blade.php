@extends('layouts.admin-master')

@section('title', 'Tambah Data Titik Masuk')

@section('content')
<div class="container mx-auto px-1 pt-1 pb-2 max-w-7xl">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Tambah Data Titik Masuk</h1>
            <p class="text-sm text-gray-500">Form untuk input data tempat titik masuk</p>
        </div>
        <a href="{{ route('admin.data.titik-masuk.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
    @if(session('error'))
    <div class="p-4 text-red-700 bg-red-100 rounded mb-4">{{ session('error') }}</div>
    @endif
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
        <div class="order-2 lg:order-1 lg:col-span-2">
            <form action="{{ route('admin.data.titik-masuk.store') }}" method="POST" class="space-y-6" id="titikMasukForm">
                @csrf
                <div class="bg-white shadow rounded p-6 space-y-4">
                    <h6 class="text-lg font-semibold text-primary"><i class="fas fa-bus mr-2"></i>Data Tempat Titik Masuk</h6>
                    <div>
                        <label for="jenis_transportasi" class="block text-sm font-medium text-gray-700">Jenis Transportasi <span class="text-red-500">*</span></label>
                        <select name="jenis_transportasi" id="jenis_transportasi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Jenis Titik Masuk</option>
                            @foreach($jenisTitikMasukOptions as $value => $label)
                            <option value="{{ $value }}" {{ old('jenis_transportasi') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('jenis_transportasi')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_tempat" class="block text-sm font-medium text-gray-700">Nama Tempat <span class="text-red-500">*</span></label>
                        <div class="flex space-x-2">
                            <input type="text" name="nama_tempat" id="nama_tempat" value="{{ old('nama_tempat') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <button type="button" id="searchLocation" class="mt-1 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        @error('nama_tempat')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Hidden fields for coordinates -->
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                    
                    <!-- Map display -->
                    <div id="map" class="w-full h-64 rounded-lg border border-gray-300" style="display: none;"></div>
                    <div>
                        <label for="provinsi" class="block text-sm font-medium text-black  ">Provinsi <span class="text-red-500">*</span></label>
                        <select name="provinsi" id="provinsi" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="Jawa Timur" selected>Jawa Timur</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div id="wilayah-jatim">
                        <div>
                            <label for="kabupaten" class="block text-sm font-medium text-black   mb-1">Kabupaten <span class="text-red-500">*</span></label>
                            <select name="kabupaten" id="kabupaten" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Kabupaten</option>
                            </select>
                            @error('kabupaten')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-black   mb-1">Kecamatan <span class="text-red-500">*</span></label>
                            <select name="kecamatan" id="kecamatan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-black   mb-1">Kelurahan/Desa <span class="text-red-500">*</span></label>
                            <select name="kelurahan" id="kelurahan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                            @error('kelurahan')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <button type="reset" class="px-6 py-2 text-gray-800 bg-gray-200 rounded hover:bg-gray-300">
                        <i class="fas fa-undo mr-2"></i>Reset
                    </button>
                </div>
            </form>
        </div>
        <div class="mt-6 order-1 lg:order-2">
            <div class="bg-white shadow rounded p-4 space-y-4">
                <div class="bg-blue-50 p-3 rounded border-l-4 border-blue-400">
                    <h6 class="font-semibold text-blue-700 mb-2"><i class="fas fa-info-circle mr-2"></i>Informasi</h6>
                    <ul class="list-disc list-inside text-sm text-blue-800 space-y-1">
                        <li>Pastikan semua data tempat transportasi yang diinput sudah benar</li>
                        <li>Nama pihak dan nomor HP harus valid</li>
                        <li>Data digunakan untuk keperluan verifikasi dan pelaporan</li>
                    </ul>
                </div>
            </div>
            <div class="mt-4">
                <div class="bg-white shadow rounded p-6">
                    <h6 class="text-lg font-semibold text-green-700 mb-4 flex items-center">
                        <i class="fas fa-file-excel mr-2"></i>Import Data
                    </h6>

                    <!-- Download Template CSV -->
                    <div class="mb-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-download text-blue-600 mr-2"></i>
                                <span class="text-sm text-blue-800">Download template untuk format yang benar</span>
                            </div>
                            <a href="{{ route('admin.data.titik-masuk.template') }}" class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                <i class="fas fa-file-csv mr-1"></i>
                                Download
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('admin.data.titik-masuk.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center sm:space-x-4 space-y-4 sm:space-y-0">
                        @csrf
                        <input type="file" name="file" accept=".csv,.txt" required class="block w-full text-sm text-gray-500">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center">
                            <i class="fas fa-file-csv mr-2"></i>Input
                        </button>
                    </form>

                    @error('file')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                    @if(session('success'))
                        <div class="mt-2 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="mt-2 p-2 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Initializing titik-masuk dropdown functionality...');
        
        // Google Maps integration
        let map, marker;
        
        // Initialize Google Maps
        function initMap() {
            // Default to Indonesia center
            const defaultLocation = { lat: -2.5489, lng: 118.0149 };
            
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: defaultLocation,
            });
            
            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true
            });
            
            // Update coordinates when marker is dragged
            google.maps.event.addListener(marker, 'dragend', function() {
                const position = marker.getPosition();
                document.getElementById('latitude').value = position.lat();
                document.getElementById('longitude').value = position.lng();
            });
        }
        
        // Search location function
        function searchLocation() {
            const query = document.getElementById('nama_tempat').value;
            if (!query) {
                alert('Masukkan nama tempat terlebih dahulu!');
                return;
            }
            
            // Show loading
            document.getElementById('searchLocation').innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            // Use Google Places API for search
            const service = new google.maps.places.PlacesService(map);
            const request = {
                query: query + ', Indonesia',
                fields: ['name', 'geometry', 'formatted_address']
            };
            
            service.findPlaceFromQuery(request, function(results, status) {
                document.getElementById('searchLocation').innerHTML = '<i class="fas fa-search"></i>';
                
                if (status === google.maps.places.PlacesServiceStatus.OK && results.length > 0) {
                    const place = results[0];
                    const location = place.geometry.location;
                    
                    // Update map
                    map.setCenter(location);
                    map.setZoom(15);
                    marker.setPosition(location);
                    
                    // Update coordinates
                    document.getElementById('latitude').value = location.lat();
                    document.getElementById('longitude').value = location.lng();
                    
                    // Update nama_tempat with formatted address
                    document.getElementById('nama_tempat').value = place.formatted_address;
                    
                    // Show map
                    document.getElementById('map').style.display = 'block';
                    
                    console.log('Location found:', {
                        name: place.name,
                        address: place.formatted_address,
                        lat: location.lat(),
                        lng: location.lng()
                    });
                } else {
                    alert('Tidak dapat menemukan lokasi tersebut. Silakan coba dengan nama yang lebih spesifik.');
                }
            });
        }
        
        // Event listener for search button
        document.getElementById('searchLocation')?.addEventListener('click', searchLocation);
        
        // Initialize map when Google Maps is loaded
        if (typeof google !== 'undefined' && google.maps) {
            initMap();
        } else {
            // Load Google Maps API
            const script = document.createElement('script');
            script.src = `https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap`;
            script.async = true;
            script.defer = true;
            document.head.appendChild(script);
            
            // Global callback function
            window.initMap = initMap;
        }
        
        // Fetch kabupaten list from API
        fetch('/admin/api/kabupaten-list')
            .then(response => {
                console.log('Kabupaten response:', response.status, response.ok);
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Kabupaten data:', data);
                const kabupatenSelect = document.getElementById('kabupaten');
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                data.forEach(kab => {
                    const option = document.createElement('option');
                    option.value = kab;
                    option.textContent = kab;
                    kabupatenSelect.appendChild(option);
                });
                console.log('Kabupaten dropdown populated with', data.length, 'options');
            })
            .catch(error => {
                console.error('Error fetching kabupaten:', error);
            });

        document.getElementById('kabupaten')?.addEventListener('change', function() {
            const kabupaten = this.value;
            console.log('Kabupaten selected:', kabupaten);
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');

            // Reset kecamatan dan kelurahan select
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            if (kabupaten) {
                const url = `/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`;
                console.log('Fetching kecamatan from:', url);
                console.log('Encoded kabupaten:', encodeURIComponent(kabupaten));
                
                fetch(url)
                    .then(response => {
                        console.log('Kecamatan response:', response.status, response.ok);
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Kecamatan data:', data);
                        data.forEach(kecamatan => {
                            const option = document.createElement('option');
                            option.value = kecamatan;
                            option.textContent = kecamatan;
                            kecamatanSelect.appendChild(option);
                        });
                        console.log('Kecamatan dropdown populated with', data.length, 'options');
                    })
                    .catch(error => {
                        console.error('Error fetching kecamatan:', error);
                    });
            }
        });

        document.getElementById('kecamatan')?.addEventListener('change', function() {
            const kecamatan = this.value;
            const kabupaten = document.getElementById('kabupaten').value;
            console.log('Kecamatan selected:', kecamatan, 'for kabupaten:', kabupaten);
            const kelurahanSelect = document.getElementById('kelurahan');
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            if (kecamatan && kabupaten) {
                const url = `/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`;
                console.log('Fetching desa from:', url);
                console.log('Encoded kabupaten:', encodeURIComponent(kabupaten));
                console.log('Encoded kecamatan:', encodeURIComponent(kecamatan));
                
                fetch(url)
                    .then(response => {
                        console.log('Desa response:', response.status, response.ok);
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Desa data:', data);
                        data.forEach(nama_desa => {
                            const option = document.createElement('option');
                            option.value = nama_desa;
                            option.textContent = nama_desa;
                            kelurahanSelect.appendChild(option);
                        });
                        console.log('Desa dropdown populated with', data.length, 'options');
                    })
                    .catch(error => {
                        console.error('Error fetching desa:', error);
                    });
            }
        });

        // Form validation before submission
        document.getElementById('titikMasukForm')?.addEventListener('submit', function(e) {
            console.log('Form submission started...');
            
            const jenisTransportasi = document.getElementById('jenis_transportasi').value;
            const namaTempat = document.getElementById('nama_tempat').value;
            const provinsi = document.getElementById('provinsi').value;
            const kabupaten = document.getElementById('kabupaten').value;
            const kecamatan = document.getElementById('kecamatan').value;
            const kelurahan = document.getElementById('kelurahan').value;
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;
            
            console.log('Form values:', {
                jenis_transportasi: jenisTransportasi,
                nama_tempat: namaTempat,
                provinsi: provinsi,
                kabupaten: kabupaten,
                kecamatan: kecamatan,
                kelurahan: kelurahan,
                latitude: latitude,
                longitude: longitude
            });
            
            // Check if all required fields are filled
            if (!jenisTransportasi || !namaTempat || !provinsi || !kabupaten || !kecamatan || !kelurahan) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi!');
                console.error('Form validation failed: Missing required fields');
                return false;
            }
            
            console.log('Form validation passed, submitting...');
        });
    });
</script>
@endsection