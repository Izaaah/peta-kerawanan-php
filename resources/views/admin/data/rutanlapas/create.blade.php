@extends('layouts.admin-master')

@section('title', 'Tambah Jaringan Rutan/Lapas')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Tambah Jaringan Rutan/Lapas</h1>
                <p class="text-sm text-gray-500">Form untuk input data jaringan rutan/lapas</p>
            </div>
            <a href="{{ route('admin.data.rutanlapas.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
            <div class="order-2 lg:order-1 lg:col-span-2">
                <form action="{{ route('admin.data.rutanlapas.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="bg-white shadow rounded p-6 space-y-4">
                        <h6 class="text-lg font-semibold text-primary"><i class="fas fa-network-wired mr-2"></i>Data
                            Jaringan Rutan/Lapas</h6>
                        <div>
                            <label for="search_nik" class="block text-sm font-medium text-gray-700">Cari NIK Narapidana
                                <span class="text-red-500">*</span></label>
                            <div class="mt-1 relative">
                                <input type="text" id="search_nik" name="search_nik" maxlength="16"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan NIK (16 digit) untuk mencari narapidana">
                                <div id="search-results"
                                    class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto hidden">
                                </div>
                            </div>
                            <input type="hidden" id="selected_individu_id" name="individu_id">
                            <input type="hidden" id="selected_nik" name="nik" value="{{ old('nik') }}">
                            <p id="nik-help" class="text-xs text-gray-500 mt-1">Ketik 16 digit, pencarian otomatis
                                berjalan.</p>
                        </div>
                        <div>
                            <label for="nama_napi" class="block text-sm font-medium text-gray-700">Nama Napi <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="nama_napi" name="nama_napi" value="{{ old('nama_napi') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required readonly>
                        </div>
                        <div>
                            <label for="jenis_napi" class="block text-sm font-medium text-gray-700">Jenis Napi <span
                                    class="text-red-500">*</span></label>
                            <select id="jenis_napi" name="jenis_napi"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">-- Pilih Jenis Napi --</option>
                                @foreach ($jenisNapiOptions as $jenis)
                                    <option value="{{ $jenis }}" {{ old('jenis_napi') == $jenis ? 'selected' : '' }}>
                                        {{ $jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="lapas" class="block text-sm font-medium text-gray-700">Lapas <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="lapas" name="lapas" value="{{ old('lapas') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="lokasi_lapas" class="block text-sm font-medium text-gray-700">Lokasi Lapas <span
                                    class="text-red-500">*</span></label>
                            <textarea id="lokasi_lapas" name="lokasi_lapas"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('lokasi_lapas') }}</textarea>
                        </div>
                        <div>
                            <label for="peran_dalam_jaringan" class="block text-sm font-medium text-gray-700">Peran dalam
                                Jaringan</label>
                            <select id="peran_dalam_jaringan" name="peran_dalam_jaringan"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Peran --</option>
                                <option value="Penyalahguna"
                                    {{ old('peran_dalam_jaringan') == 'Penyalahguna' ? 'selected' : '' }}>Penyalahguna
                                </option>
                                <option value="Pecandu" {{ old('peran_dalam_jaringan') == 'Pecandu' ? 'selected' : '' }}>
                                    Pecandu</option>
                                <option value="Kurir" {{ old('peran_dalam_jaringan') == 'Kurir' ? 'selected' : '' }}>Kurir
                                </option>
                                <option value="Bandar" {{ old('peran_dalam_jaringan') == 'Bandar' ? 'selected' : '' }}>
                                    Bandar</option>
                            </select>
                        </div>
                        <div>
                            <label for="status_proses" class="block text-sm font-medium text-gray-700">Status Proses <span
                                    class="text-red-500">*</span></label>
                            <select id="status_proses" name="status_proses"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                                <option value="">-- Pilih Status Proses --</option>
                                @foreach ($statusProsesOptions as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status_proses') == $status ? 'selected' : '' }}>{{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea id="keterangan" name="keterangan"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('keterangan') }}</textarea>
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
            <div class="order-1 lg:order-2 mt-6">
                <div class="bg-white shadow rounded p-4 space-y-4">
                    <div class="bg-blue-50 p-3 rounded border-l-4 border-blue-400">
                        <h6 class="font-semibold text-blue-700 mb-2"><i class="fas fa-info-circle mr-2"></i>Informasi</h6>
                        <ul class="list-disc list-inside text-sm text-blue-800 space-y-1">
                            <li>Pastikan semua data jaringan rutan/lapas yang diinput sudah benar</li>
                            <li>Isi status proses dan jenis napi sesuai kondisi sebenarnya</li>
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
                                <a href="{{ route('admin.data.rutanlapas.template') }}"
                                    class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-file-csv mr-1"></i>
                                    Download
                                </a>
                            </div>
                        </div>

                        <form action="{{ route('admin.data.rutanlapas.import') }}" method="POST"
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
    @push('scripts')
        <script>
            const searchNik = document.getElementById('search_nik');
            const searchResults = document.getElementById('search-results');
            const selectedIndividuId = document.getElementById('selected_individu_id');
            const namaNapi = document.getElementById('nama_napi');

            let searchTimeout;
            searchNik.addEventListener('input', function() {
                const nik = this.value.replace(/\D/g, '').slice(0, 16);
                this.value = nik;
                clearTimeout(searchTimeout);

                if (nik.length === 0) {
                    searchResults.classList.add('hidden');
                    return;
                }

                if (nik.length < 16) {
                    searchResults.innerHTML =
                        '<div class="p-3 text-center text-yellow-600">NIK harus 16 digit (kurang ' + (16 - nik.length) +
                        ' digit)</div>';
                    searchResults.classList.remove('hidden');
                    return;
                }

                searchResults.innerHTML = '<div class="p-3 text-center text-gray-500">Mencari...</div>';
                searchResults.classList.remove('hidden');

                searchTimeout = setTimeout(() => {
                    fetch(`/admin/api/search-individu-by-nik?nik=${encodeURIComponent(nik)}&onlyNarapidana=1`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.success && data.data) {
                                const individu = data.data;
                                selectedIndividuId.value = individu.id;
                                namaNapi.value = individu.nama;
                                document.getElementById('selected_nik').value = individu.nik;
                                searchResults.innerHTML = `
                            <div class="p-3 border-b">
                                <div class="font-medium text-gray-900">${individu.nama}</div>
                                <div class="text-sm text-gray-500">NIK: ${individu.nik}</div>
                                <div class="text-sm text-gray-500">${individu.kabupaten || ''}${individu.kecamatan ? ', ' + individu.kecamatan : ''}</div>
                            </div>
                            <div class="p-2 text-green-600 text-sm text-center">Data ditemukan dan terpilih</div>
                        `;
                            } else {
                                selectedIndividuId.value = '';
                                namaNapi.value = '';
                                searchResults.innerHTML =
                                    '<div class="p-3 text-center text-red-600">NIK tidak ditemukan. Tambah data di profil individu atau ubah status individu tersebut menjadi narapidana.</div>';
                            }
                        })
                        .catch(() => {
                            searchResults.innerHTML =
                                '<div class="p-3 text-center text-red-600">Terjadi kesalahan saat mencari</div>';
                        });
                }, 400);
            });

            // Klik di luar untuk menutup hasil
            document.addEventListener('click', function(evt) {
                if (!searchResults.contains(evt.target) && evt.target !== searchNik) {
                    searchResults.classList.add('hidden');
                }
            });
        </script>
    @endpush
@endsection
