@extends('layouts.admin-master')

@section('title', 'Edit Ekspedisi')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Edit Data Ekspedisi</h2>
            <a href="{{ route('admin.data.ekspedisi.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white rounded shadow p-6">
            <form action="{{ route('admin.data.ekspedisi.update', $ekspedisi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Ekspedisi *</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $ekspedisi->nama) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address Section -->
                    <div class="md:col-span-2">
                        <h6 class="text-lg font-semibold text-primary mb-4"><i class="fas fa-map-marker-alt mr-2"></i>Alamat
                        </h6>
                    </div>

                    <div>
                        <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">Provinsi <span
                                class="text-red-500">*</span></label>
                        <select name="provinsi" id="provinsi" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Provinsi</option>
                            <option value="Jawa Timur"
                                {{ old('provinsi', $ekspedisi->provinsi ?? '') == 'Jawa Timur' ? 'selected' : '' }}>Jawa
                                Timur</option>
                            <option value="lainnya"
                                {{ old('provinsi', $ekspedisi->provinsi ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                        @error('provinsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="wilayah-jatim">
                        <div>
                            <label for="kabupaten" class="block text-sm font-medium text-gray-700 mb-2">Kabupaten/Kota <span
                                    class="text-red-500">*</span></label>
                            <select name="kabupaten" id="kabupaten"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kabupaten/Kota</option>
                                @if (isset($kabupatenList))
                                    @foreach ($kabupatenList as $kabupaten)
                                        <option value="{{ $kabupaten }}"
                                            {{ old('kabupaten', $ekspedisi->kabupaten ?? '') == $kabupaten ? 'selected' : '' }}>
                                            {{ $kabupaten }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kabupaten')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-2">Kecamatan <span
                                    class="text-red-500">*</span></label>
                            <select name="kecamatan" id="kecamatan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kecamatan</option>
                                @if (isset($ekspedisi->kecamatan) && $ekspedisi->kecamatan)
                                    <option value="{{ $ekspedisi->kecamatan }}" selected>{{ $ekspedisi->kecamatan }}
                                    </option>
                                @endif
                            </select>
                            @error('kecamatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700 mb-2">Kelurahan/Desa <span
                                    class="text-red-500">*</span></label>
                            <select name="kelurahan" id="kelurahan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kelurahan/Desa</option>
                                @if (isset($ekspedisi->kelurahan) && $ekspedisi->kelurahan)
                                    <option value="{{ $ekspedisi->kelurahan }}" selected>{{ $ekspedisi->kelurahan }}
                                    </option>
                                @endif
                            </select>
                            @error('kelurahan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div id="wilayah-lainnya" class="hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                <input type="text" name="provinsi_lain" id="provinsi_lain"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Provinsi"
                                    value="{{ old('provinsi_lain', $ekspedisi->provinsi_lain ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                                <input type="text" name="kabupaten_lain"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Kabupaten"
                                    value="{{ old('kabupaten_lain', $ekspedisi->kabupaten_lain ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                <input type="text" name="kecamatan_lain"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Kecamatan"
                                    value="{{ old('kecamatan_lain', $ekspedisi->kecamatan_lain ?? '') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan/Desa</label>
                                <input type="text" name="kelurahan_lain"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="Kelurahan/Desa"
                                    value="{{ old('kelurahan_lain', $ekspedisi->kelurahan_lain ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap
                            (Jalan/RT/RW) <span class="text-red-500">*</span></label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('alamat', $ekspedisi->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="manager" class="block text-sm font-medium text-gray-700 mb-2">Manager *</label>
                        <input type="text" name="manager" id="manager"
                            value="{{ old('manager', $ekspedisi->manager) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('manager')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                        <input type="text" name="no_hp" id="no_hp"
                            value="{{ old('no_hp', $ekspedisi->no_hp) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('no_hp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">Jenis *</label>
                        <select name="jenis" id="jenis"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="">Pilih Jenis</option>
                            @foreach ($jenisOptions as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('jenis', $ekspedisi->jenis) == $value ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>{{ old('alamat', $ekspedisi->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.data.ekspedisi.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                </div>
            </form>
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
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            data.forEach(kecamatan => {
                                const option = document.createElement('option');
                                option.value = kecamatan;
                                option.textContent = kecamatan;
                                kecamatanSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching kecamatan:', error);
                            console.log('Trying kabupaten:', kabupaten);
                        });
                }
            });

            // Handle kecamatan selection
            kecamatanSelect.addEventListener('change', function() {
                const kabupaten = kabupatenSelect.value;
                const kecamatan = this.value;
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                if (kabupaten && kecamatan) {
                    fetch(
                            `/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            data.forEach(desa => {
                                const option = document.createElement('option');
                                option.value = desa;
                                option.textContent = desa;
                                kelurahanSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching desa:', error);
                            console.log('Trying kabupaten:', kabupaten, 'kecamatan:', kecamatan);
                        });
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
