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
            <form action="{{ route('admin.data.titik-masuk.store') }}" method="POST" class="space-y-6">
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
                        <input type="text" name="nama_tempat" id="nama_tempat" value="{{ old('nama_tempat') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @error('nama_tempat')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
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
                        </div>
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-black   mb-1">Kecamatan <span class="text-red-500">*</span></label>
                            <select name="kecamatan" id="kecamatan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-black   mb-1">Kelurahan/Desa <span class="text-red-500">*</span></label>
                            <select name="kelurahan" id="kelurahan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
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
        // Fetch kabupaten list from API
        fetch('/admin/api/kabupaten-list')
            .then(response => response.json())
            .then(data => {
                const kabupatenSelect = document.getElementById('kabupaten');
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                data.forEach(kab => {
                    const option = document.createElement('option');
                    option.value = kab;
                    option.textContent = kab;
                    kabupatenSelect.appendChild(option);
                });
            });

        document.getElementById('kabupaten')?.addEventListener('change', function() {
            const kabupaten = this.value;
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');

            // Reset kecamatan dan kelurahan select
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            if (kabupaten) {
                fetch(`/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
                    .then(response => response.json())
                    .then(data => {
                        // Periksa jika data tersedia dan kemudian update select kecamatan
                        console.log(data); // Debugging
                        data.forEach(kecamatan => {
                            const option = document.createElement('option');
                            option.value = kecamatan;
                            option.textContent = kecamatan;
                            kecamatanSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Error fetching kecamatan:', err));
            }
        });

        document.getElementById('kecamatan')?.addEventListener('change', function() {
            const kecamatan = this.value;
            const kabupaten = document.getElementById('kabupaten').value;
            const kelurahanSelect = document.getElementById('kelurahan');
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            if (kecamatan && kabupaten) {
                fetch(`/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`)
                    .then(response => response.json())
                    .then(data => {
                        // Periksa jika data tersedia dan update select kelurahan
                        console.log(data); // Debugging
                        data.forEach(desa => {
                            const option = document.createElement('option');
                            option.value = desa;
                            option.textContent = desa;
                            kelurahanSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Error fetching desa:', err));
            }
        });
    });
</script>
@endsection