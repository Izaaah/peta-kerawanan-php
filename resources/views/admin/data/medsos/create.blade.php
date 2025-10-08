@extends('layouts.admin-master')

@section('title', 'Tambah Akun Media Sosial')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Tambah Akun Media Sosial</h1>
                <p class="text-sm text-gray-500">Form untuk input data akun media sosial</p>
            </div>
            <a href="{{ route('admin.data.medsos.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
            <div class="order-2 lg:order-1 lg:col-span-2">
                <form action="{{ route('admin.data.medsos.store') }}" method="POST" class="space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="bg-white shadow rounded p-6 space-y-4">
                        <h6 class="text-lg font-semibold text-primary"><i class="fas fa-hashtag mr-2"></i>Data Akun Media
                            Sosial</h6>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Media Sosial <span
                                    class="text-red-500">*</span></label>
                            <select id="nama_media_sosial" name="nama_media_sosial"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="" disabled selected>Pilih Media Sosial</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Tiktok">Tiktok</option>
                                <option value="Telegram">Telegram</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <input type="text" id="nama_media_sosial_lainnya" name="nama_media_sosial_lainnya"
                                class="w-full border-gray-300 rounded-md px-3 py-2 mt-2" placeholder="Nama Media Sosial"
                                style="display: none;">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Akun <span
                                    class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jenis_akun" value="personal" id="jenis_personal"
                                            class="form-radio text-blue-600" required>
                                        <span class="ml-2">Personal</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jenis_akun" value="kelompok" id="jenis_kelompok"
                                            class="form-radio text-blue-600" required>
                                        <span class="ml-2">Kelompok/Komunitas</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="personal-section" style="display: none;">
                            <label class="block text-sm font-medium text-gray-700">Cari Profil Individu <span
                                    class="text-red-500">*</span></label>
                            <div class="mt-1 relative">
                                <input type="text" id="search_nik" name="search_nik"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan NIK untuk mencari profil individu">
                                <div id="search-results"
                                    class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                                    <!-- Hasil pencarian akan muncul di sini -->
                                </div>
                            </div>
                            <input type="hidden" id="selected_individu_id" name="individu_id">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Akun <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama_akun"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Link Akun</label>
                            <input type="url" name="link_akun"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 placeholder:text-gray-400"
                                placeholder="contoh=https://www....com/nama_akun">
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
                            <li>Pastikan nama media sosial/akun sudah benar</li>
                            <li>Jika memilih "Lainnya", isi nama media sosial secara manual</li>
                            <li>Link akun opsional, namun disarankan diisi untuk verifikasi</li>
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
                                <a href="{{ route('admin.data.medsos.template') }}"
                                    class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-file-csv mr-1"></i>
                                    Download
                                </a>
                            </div>
                        </div>

                        <form action="{{ route('admin.data.medsos.import') }}" method="POST"
                            enctype="multipart/form-data"
                            class="flex flex-col sm:flex-row items-center sm:space-x-4 space-y-4 sm:space-y-0">
                            @csrf
                            <input type="file" name="file" accept=".csv,.txt" required
                                class="block w-full text-sm text-gray-500">
                            <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center">
                                <i class="fas fa-file-csv mr-2"></i>Input
                            </button>
                        </form>

                        @error('file')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                        @if (session('success'))
                            <div class="mt-2 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="mt-2 p-2 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const select = document.getElementById('nama_media_sosial');
        const inputLainnya = document.getElementById('nama_media_sosial_lainnya');
        const jenisPersonal = document.getElementById('jenis_personal');
        const jenisKelompok = document.getElementById('jenis_kelompok');
        const personalSection = document.getElementById('personal-section');
        const searchNik = document.getElementById('search_nik');
        const searchResults = document.getElementById('search-results');
        const selectedIndividuId = document.getElementById('selected_individu_id');

        // Handle media sosial selection
        select.addEventListener('change', function() {
            if (this.value === 'Lainnya') {
                inputLainnya.style.display = 'block';
                inputLainnya.required = true;
            } else {
                inputLainnya.style.display = 'none';
                inputLainnya.required = false;
                inputLainnya.value = '';
            }
        });

        // Form validation before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            if (select.value === 'Lainnya' && !inputLainnya.value.trim()) {
                e.preventDefault();
                alert('Nama media sosial harus diisi jika memilih "Lainnya"');
                inputLainnya.focus();
                return false;
            }

            if (jenisPersonal.checked && !selectedIndividuId.value) {
                e.preventDefault();
                alert('Profil individu harus dipilih untuk akun personal');
                searchNik.focus();
                return false;
            }
        });

        // Handle jenis akun selection
        jenisPersonal.addEventListener('change', function() {
            if (this.checked) {
                personalSection.style.display = 'block';
                searchNik.required = true;
            }
        });

        jenisKelompok.addEventListener('change', function() {
            if (this.checked) {
                personalSection.style.display = 'none';
                searchNik.required = false;
                searchNik.value = '';
                selectedIndividuId.value = '';
                searchResults.classList.add('hidden');
            }
        });

        // Handle NIK search
        let searchTimeout;
        searchNik.addEventListener('input', function() {
            const nik = this.value.trim();

            // Clear previous timeout
            clearTimeout(searchTimeout);

            // Hide results immediately when typing
            searchResults.classList.add('hidden');

            // Show appropriate message based on NIK length
            if (nik.length > 0 && nik.length < 16) {
                searchResults.innerHTML =
                    '<div class="p-3 text-center text-yellow-600">NIK harus 16 digit (masih kurang ' + (16 - nik
                        .length) + ' digit)</div>';
                searchResults.classList.remove('hidden');
            } else if (nik.length === 16) {
                searchResults.innerHTML = '<div class="p-3 text-center text-gray-500">Mencari...</div>';
                searchResults.classList.remove('hidden');
            }

            if (nik.length === 16) {
                searchTimeout = setTimeout(() => {
                    searchIndividu(nik);
                }, 500);
            } else if (nik.length === 0) {
                searchResults.classList.add('hidden');
            }
        });

        function searchIndividu(nik) {
            console.log('Searching for NIK:', nik); // Debug log

            fetch(`/admin/api/search-individu-by-nik?nik=${encodeURIComponent(nik)}`)
                .then(response => {
                    console.log('Response status:', response.status); // Debug log
                    return response.json();
                })
                .then(data => {
                    console.log('Search result:', data); // Debug log
                    if (data.success && data.data) {
                        showSearchResults(data.data);
                    } else {
                        searchResults.innerHTML =
                            '<div class="p-3 text-center text-red-500">Individu tidak ditemukan</div>';
                        searchResults.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error searching individu:', error);
                    searchResults.innerHTML =
                        '<div class="p-3 text-center text-red-500">Error saat mencari individu</div>';
                    searchResults.classList.remove('hidden');
                });
        }

        function showSearchResults(individu) {
            searchResults.innerHTML = `
                <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-200" onclick="selectIndividu(${individu.id}, '${individu.nama}', '${individu.nik}')">
                    <div class="font-medium text-gray-900">${individu.nama}</div>
                    <div class="text-sm text-gray-500">NIK: ${individu.nik}</div>
                    <div class="text-sm text-gray-500">${individu.kabupaten}, ${individu.kecamatan}</div>
                </div>
            `;
            searchResults.classList.remove('hidden');
        }

        function selectIndividu(id, nama, nik) {
            searchNik.value = `${nama} (${nik})`;
            selectedIndividuId.value = id;
            searchResults.classList.add('hidden');
        }

        // Hide search results when clicking outside
        document.addEventListener('click', function(event) {
            if (!searchNik.contains(event.target) && !searchResults.contains(event.target)) {
                searchResults.classList.add('hidden');
            }
        });

        window.addEventListener('DOMContentLoaded', function() {
            if (select.value === 'Lainnya') {
                inputLainnya.style.display = 'block';
                inputLainnya.required = true;
            }
        });
    </script>
@endsection
