@extends('layouts.admin-master')

@section('title', 'Tambah Lembaga Rehabilitasi')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Tambah Lembaga Rehabilitasi</h1>
                <p class="text-sm text-gray-500">Form untuk input data lembaga rehabilitasi</p>
            </div>
            <a href="{{ route('admin.data.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
            <div class="order-2 lg:order-1 lg:col-span-2">
                <form action="{{ route('admin.data.lrehab.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="bg-white shadow rounded p-6 space-y-4">
                        <h6 class="text-lg font-semibold text-primary"><i class="fas fa-hospital-user mr-2"></i>Data Lembaga
                            Rehabilitasi</h6>
                        <div>
                            <label for="jenis_lrehab" class="block text-sm font-medium text-gray-700">Jenis Lembaga
                                Rehabilitasi <span class="text-red-500">*</span></label>
                            <select name="jenis_lrehab" id="jenis_lrehab" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Jenis Lembaga</option>
                                <option value="LRIP" {{ old('jenis_lrehab') == 'LRIP' ? 'selected' : '' }}>LRIP (Lembaga
                                    Rehabilitasi Instansi Pemerintah)</option>
                                <option value="LRKM" {{ old('jenis_lrehab') == 'LRKM' ? 'selected' : '' }}>LRKM (Lembaga
                                    Rehabilitasi Komunitas Masyarakat)</option>
                            </select>
                        </div>

                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lembaga<span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <div>
                            <label for="nama_ketua" class="block text-sm font-medium text-gray-700">Nama Ketua <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="nama_ketua" name="nama_ketua" value="{{ old('nama_ketua') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- Address Section -->
                        <div class="col-span-2">
                            <h6 class="text-lg font-semibold text-primary mb-4"><i
                                    class="fas fa-map-marker-alt mr-2"></i>Alamat</h6>
                        </div>

                        <div>
                            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi <span
                                    class="text-red-500">*</span></label>
                            <select name="provinsi" id="provinsi" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Provinsi</option>
                                <option value="Jawa Timur" {{ old('provinsi') == 'Jawa Timur' ? 'selected' : '' }}>Jawa
                                    Timur</option>
                                <option value="lainnya" {{ old('provinsi') == 'lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                        </div>

                        <div id="wilayah-jatim">
                            <div>
                                <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten/Kota <span
                                        class="text-red-500">*</span></label>
                                <select name="kabupaten" id="kabupaten"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    @if (isset($kabupatenList))
                                        @foreach ($kabupatenList as $kabupaten)
                                            <option value="{{ $kabupaten }}"
                                                {{ old('kabupaten') == $kabupaten ? 'selected' : '' }}>{{ $kabupaten }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div>
                                <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan <span
                                        class="text-red-500">*</span></label>
                                <select name="kecamatan" id="kecamatan"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>

                            <div>
                                <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan/Desa <span
                                        class="text-red-500">*</span></label>
                                <select name="kelurahan" id="kelurahan"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                            </div>
                        </div>

                        <div id="wilayah-lainnya" class="hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                                    <input type="text" name="provinsi_lain" id="provinsi_lain"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                        placeholder="Provinsi" value="{{ old('provinsi_lain') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                                    <input type="text" name="kabupaten_lain"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                        placeholder="Kabupaten" value="{{ old('kabupaten_lain') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                    <input type="text" name="kecamatan_lain"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                        placeholder="Kecamatan" value="{{ old('kecamatan_lain') }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                    <input type="text" name="kelurahan_lain"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                        placeholder="Kelurahan/Desa" value="{{ old('kelurahan_lain') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap
                                (Jalan/RT/RW) <span class="text-red-500">*</span></label>
                            <textarea name="alamat" id="alamat" rows="3" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('alamat') }}</textarea>
                        </div>

                        <!-- Sertifikasi Section -->
                        <div class="col-span-2">
                            <h6 class="text-lg font-semibold text-primary mb-4"><i
                                    class="fas fa-certificate mr-2"></i>Sertifikasi</h6>
                        </div>

                        <div class="col-span-2">
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="sertifikasi[]" value="IPWL" id="ipwl"
                                        class="mr-2" {{ in_array('IPWL', old('sertifikasi', [])) ? 'checked' : '' }}>
                                    <label for="ipwl" class="text-sm font-medium text-gray-700">IPWL</label>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" name="sertifikasi[]" value="SNI_Nasional" id="sni_nasional"
                                        class="mr-2"
                                        {{ in_array('SNI_Nasional', old('sertifikasi', [])) ? 'checked' : '' }}>
                                    <label for="sni_nasional" class="text-sm font-medium text-gray-700">SNI
                                        Nasional</label>
                                    <input type="text" name="nomor_sni_nasional" id="nomor_sni_nasional"
                                        placeholder="Nomor Sertifikat" value="{{ old('nomor_sni_nasional') }}"
                                        class="ml-4 mt-1 block w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" name="sertifikasi[]" value="SNI_Reguler" id="sni_reguler"
                                        class="mr-2"
                                        {{ in_array('SNI_Reguler', old('sertifikasi', [])) ? 'checked' : '' }}>
                                    <label for="sni_reguler" class="text-sm font-medium text-gray-700">SNI Reguler</label>
                                    <input type="text" name="nomor_sni_reguler" id="nomor_sni_reguler"
                                        placeholder="Nomor Sertifikat" value="{{ old('nomor_sni_reguler') }}"
                                        class="ml-4 mt-1 block w-1/2 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>
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
                            <li>Pastikan semua data lembaga rehabilitasi yang diinput sudah benar</li>
                            <li>Pilih jenis lembaga sesuai kategori yang tersedia</li>
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
                                <a href="{{ route('admin.data.lrehab.template') }}"
                                    class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-file-csv mr-1"></i>
                                    Download
                                </a>
                            </div>
                        </div>

                        <form action="{{ route('admin.data.lrehab.import') }}" method="POST"
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
        document.addEventListener('DOMContentLoaded', function() {
            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');
            const wilayahJatim = document.getElementById('wilayah-jatim');
            const wilayahLainnya = document.getElementById('wilayah-lainnya');

            // Handle province selection
            provinsiSelect.addEventListener('change', function() {
                const selectedProvinsi = this.value;

                if (selectedProvinsi === 'Jawa Timur') {
                    wilayahJatim.classList.remove('hidden');
                    wilayahLainnya.classList.add('hidden');
                    // Reset other dropdowns
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                } else if (selectedProvinsi === 'lainnya') {
                    wilayahJatim.classList.add('hidden');
                    wilayahLainnya.classList.remove('hidden');
                    // Reset all dropdowns
                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                } else {
                    wilayahJatim.classList.add('hidden');
                    wilayahLainnya.classList.add('hidden');
                    // Reset all dropdowns
                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                }
            });

            // Handle kabupaten selection
            kabupatenSelect.addEventListener('change', function() {
                const selectedKabupaten = this.value;

                if (selectedKabupaten) {
                    fetch(`/api/kecamatan-list?kabupaten=${encodeURIComponent(selectedKabupaten)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                            data.forEach(kecamatan => {
                                const option = document.createElement('option');
                                option.value = kecamatan;
                                option.textContent = kecamatan;
                                kecamatanSelect.appendChild(option);
                            });
                            // Reset kelurahan
                            kelurahanSelect.innerHTML =
                                '<option value="">Pilih Kelurahan/Desa</option>';
                        })
                        .catch(error => {
                            console.error('Error fetching kecamatan:', error);
                            kecamatanSelect.innerHTML =
                                '<option value="">Error loading kecamatan</option>';
                        });
                } else {
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                }
            });

            // Handle kecamatan selection
            kecamatanSelect.addEventListener('change', function() {
                const selectedKabupaten = kabupatenSelect.value;
                const selectedKecamatan = this.value;

                if (selectedKabupaten && selectedKecamatan) {
                    fetch(
                            `/api/desa-list?kabupaten=${encodeURIComponent(selectedKabupaten)}&kecamatan=${encodeURIComponent(selectedKecamatan)}`
                        )
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            kelurahanSelect.innerHTML =
                                '<option value="">Pilih Kelurahan/Desa</option>';
                            data.forEach(kelurahan => {
                                const option = document.createElement('option');
                                option.value = kelurahan;
                                option.textContent = kelurahan;
                                kelurahanSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching kelurahan:', error);
                            kelurahanSelect.innerHTML =
                                '<option value="">Error loading kelurahan</option>';
                        });
                } else {
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                }
            });

            // Initialize form state
            const initialProvinsi = provinsiSelect.value;
            if (initialProvinsi === 'Jawa Timur') {
                wilayahJatim.classList.remove('hidden');
            } else if (initialProvinsi === 'lainnya') {
                wilayahLainnya.classList.remove('hidden');
            }
        });
    </script>
@endsection
