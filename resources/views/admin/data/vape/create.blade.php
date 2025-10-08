@extends('layouts.admin-master')

@section('title', 'Tambah Penjual Vape')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Tambah Penjual Vape</h1>
                <p class="text-sm text-gray-500">Form untuk input data penjual vape</p>
            </div>
            <a href="{{ route('admin.data.vape.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
            <div class="order-2 lg:order-1 lg:col-span-2">
                <form action="{{ route('admin.data.vape.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="bg-white shadow rounded p-6 space-y-4">
                        <h6 class="text-lg font-semibold text-primary"><i class="fas fa-smoking mr-2"></i>Data Penjual Vape
                        </h6>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Toko <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama_toko"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi <span
                                    class="text-red-500">*</span></label>
                            <select id="provinsi" name="provinsi"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Provinsi</option>
                                <option value="Jawa Timur">Jawa Timur</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div id="wilayah-jatim" class="space-y-4 hidden">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                                <select id="kabupaten" name="kabupaten"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    @if (isset($kabupatenList))
                                        @foreach ($kabupatenList as $kab)
                                            <option value="{{ $kab }}">{{ $kab }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                <select id="kecamatan" name="kecamatan"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                <select id="kelurahan" name="kelurahan"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                            </div>
                        </div>

                        <div id="wilayah-lainnya" class="hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                                    <input type="text" name="provinsi_lain"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                                    <input type="text" name="kabupaten_lain"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                    <input type="text" name="kecamatan_lain"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                    <input type="text" name="kelurahan_lain"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lokasi <span
                                    class="text-red-500">*</span></label>
                            <textarea name="lokasi"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pemilik <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="pemilik"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="no_hp"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Liquid Dicurigai</label>
                            <div id="liquid-container">
                                <div class="liquid-item flex items-center space-x-2 mb-2">
                                    <input type="text" name="liquid_dicurigai[]"
                                        class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Masukkan jenis liquid dicurigai">
                                    <button type="button" onclick="removeLiquidItem(this)"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" onclick="addLiquidItem()"
                                class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                <i class="fas fa-plus mr-2"></i>Tambah Liquid
                            </button>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Distributor</label>
                            <textarea name="distributor"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
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
                            <li>Pastikan semua data penjual vape yang diinput sudah benar</li>
                            <li>Nama pemilik dan nomor HP harus valid</li>
                            <li>Data digunakan untuk keperluan verifikasi dan pelaporan</li>
                            <li>Isi data liquid dicurigai dan distributor jika ada</li>
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
                                <a href="{{ route('admin.data.vape.template') }}"
                                    class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-file-csv mr-1"></i>
                                    Download
                                </a>
                            </div>
                        </div>

                        <form action="{{ route('admin.data.vape.import') }}" method="POST" enctype="multipart/form-data"
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
        document.addEventListener('DOMContentLoaded', function() {
            const provinsi = document.getElementById('provinsi');
            const kabupaten = document.getElementById('kabupaten');
            const kecamatan = document.getElementById('kecamatan');
            const kelurahan = document.getElementById('kelurahan');
            const wilayahJatim = document.getElementById('wilayah-jatim');
            const wilayahLainnya = document.getElementById('wilayah-lainnya');

            provinsi.addEventListener('change', function() {
                console.log('Provinsi selected:', this.value);
                if (this.value === 'Jawa Timur') {
                    wilayahJatim.classList.remove('hidden');
                    wilayahLainnya.classList.add('hidden');
                    // Reset dropdowns
                    kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kelurahan.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                    // Kabupaten sudah ter-populate dari controller, tidak perlu fetch lagi
                    console.log('Jawa Timur selected, showing wilayah-jatim');
                } else if (this.value === 'lainnya') {
                    wilayahJatim.classList.add('hidden');
                    wilayahLainnya.classList.remove('hidden');
                    console.log('Lainnya selected, showing wilayah-lainnya');
                } else {
                    wilayahJatim.classList.add('hidden');
                    wilayahLainnya.classList.add('hidden');
                    console.log('No provinsi selected, hiding both');
                }
            });

            kabupaten.addEventListener('change', function() {
                const kab = this.value;
                console.log('Kabupaten selected:', kab);
                kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                if (!kab) return;

                const url = `/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kab)}`;
                console.log('Fetching URL:', url);

                fetch(url)
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(list => {
                        console.log('Kecamatan list received:', list);
                        (list || []).forEach(kec => {
                            const opt = document.createElement('option');
                            opt.value = kec;
                            opt.textContent = kec;
                            kecamatan.appendChild(opt);
                        });
                    })
                    .catch(error => {
                        console.error('Error loading kecamatan:', error);
                        kecamatan.innerHTML = '<option value="">Error loading kecamatan</option>';
                    });
            });

            kecamatan.addEventListener('change', function() {
                const kab = kabupaten.value;
                const kec = this.value;
                console.log('Kecamatan selected:', kec, 'for kabupaten:', kab);
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                if (!kab || !kec) return;

                const url =
                    `/admin/api/desa-list?kabupaten=${encodeURIComponent(kab)}&kecamatan=${encodeURIComponent(kec)}`;
                console.log('Fetching URL:', url);

                fetch(url)
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }
                        return response.json();
                    })
                    .then(list => {
                        console.log('Desa list received:', list);
                        (list || []).forEach(desa => {
                            const opt = document.createElement('option');
                            opt.value = desa;
                            opt.textContent = desa;
                            kelurahan.appendChild(opt);
                        });
                    })
                    .catch(error => {
                        console.error('Error loading desa:', error);
                        kelurahan.innerHTML = '<option value="">Error loading desa</option>';
                    });
            });
        });

        function addLiquidItem() {
            const container = document.getElementById('liquid-container');
            const newItem = document.createElement('div');
            newItem.className = 'liquid-item flex items-center space-x-2 mb-2';
            newItem.innerHTML = `
            <input type="text" name="liquid_dicurigai[]"
                class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                placeholder="Masukkan jenis liquid dicurigai">
            <button type="button" onclick="removeLiquidItem(this)"
                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                <i class="fas fa-trash"></i>
            </button>
        `;
            container.appendChild(newItem);
        }

        function removeLiquidItem(button) {
            const container = document.getElementById('liquid-container');
            if (container.children.length > 1) {
                button.parentElement.remove();
            }
        }
    </script>
@endsection
