@extends('layouts.admin-master')

@section('title', 'Tambah THM')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Tambah Tempat Hiburan Malam (THM)</h1>
                <p class="text-sm text-gray-500">Form untuk input data THM</p>
            </div>
            <a href="{{ route('admin.data.thm.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
            <div class="order-2 lg:order-1 lg:col-span-2">
                @if (session('error'))
                    <div class="p-4 text-red-700 bg-red-100 rounded">{{ session('error') }}</div>
                @endif
                <form action="{{ route('admin.data.thm.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="bg-white shadow rounded p-6">
                        <h6 class="text-lg font-semibold text-primary mb-4"><i class="fas fa-building mr-2"></i>Data THM
                        </h6>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nama_thm" class="block text-sm font-medium text-gray-700">Nama THM <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="nama_thm" name="nama_thm" value="{{ old('nama_thm') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('nama_thm')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address Section -->
                            <div class="col-span-2">
                                <h6 class="text-lg font-semibold text-primary mb-4"><i
                                        class="fas fa-map-marker-alt mr-2"></i>Alamat THM</h6>
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
                                @error('provinsi')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="wilayah-jatim">
                                <div>
                                    <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten/Kota
                                        <span class="text-red-500">*</span></label>
                                    <select name="kabupaten" id="kabupaten"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kabupaten/Kota</option>
                                        @if (isset($kabupatenList))
                                            @foreach ($kabupatenList as $kabupaten)
                                                <option value="{{ $kabupaten }}"
                                                    {{ old('kabupaten') == $kabupaten ? 'selected' : '' }}>
                                                    {{ $kabupaten }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kabupaten')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan <span
                                            class="text-red-500">*</span></label>
                                    <select name="kecamatan" id="kecamatan"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                    @error('kecamatan')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan/Desa
                                        <span class="text-red-500">*</span></label>
                                    <select name="kelurahan" id="kelurahan"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>
                                    @error('kelurahan')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
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
                                <textarea name="alamat" id="alamat" rows="2" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="ketua_thm" class="block text-sm font-medium text-gray-700">Ketua THM <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="ketua_thm" name="ketua_thm" value="{{ old('ketua_thm') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('ketua_thm')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="no_hp_ketua" class="block text-sm font-medium text-gray-700">No HP Ketua <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="no_hp_ketua" name="no_hp_ketua"
                                    value="{{ old('no_hp_ketua') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('no_hp_ketua')
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
                            <li>Pastikan data THM yang diinput sudah benar dan lengkap</li>
                            <li>Nama dan nomor HP ketua harus valid untuk keperluan komunikasi</li>
                            <li>Data digunakan untuk keperluan monitoring dan pelaporan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle provinsi selection
            const provinsiSelect = document.getElementById('provinsi');
            const wilayahJatim = document.getElementById('wilayah-jatim');
            const wilayahLainnya = document.getElementById('wilayah-lainnya');

            provinsiSelect.addEventListener('change', function() {
                if (this.value === 'lainnya') {
                    wilayahJatim.classList.add('hidden');
                    wilayahLainnya.classList.remove('hidden');
                } else {
                    wilayahJatim.classList.remove('hidden');
                    wilayahLainnya.classList.add('hidden');
                }
            });

            // Handle kabupaten selection
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');

            kabupatenSelect.addEventListener('change', function() {
                const kabupaten = this.value;
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                if (kabupaten) {
                    fetch(`/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(kecamatan => {
                                const option = document.createElement('option');
                                option.value = kecamatan;
                                option.textContent = kecamatan;
                                kecamatanSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching kecamatan:', error));
                }
            });

            // Handle kecamatan selection
            kecamatanSelect.addEventListener('change', function() {
                const kabupaten = kabupatenSelect.value;
                const kecamatan = this.value;
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                if (kabupaten && kecamatan) {
                    fetch(
                            `/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`
                        )
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(desa => {
                                const option = document.createElement('option');
                                option.value = desa;
                                option.textContent = desa;
                                kelurahanSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching desa:', error));
                }
            });

            // Initialize provinsi selection on page load
            if (provinsiSelect.value === 'lainnya') {
                wilayahJatim.classList.add('hidden');
                wilayahLainnya.classList.remove('hidden');
            }
        });
    </script>
@endpush
