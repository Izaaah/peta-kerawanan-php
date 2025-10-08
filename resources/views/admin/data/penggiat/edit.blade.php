@extends('layouts.admin-master')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Edit Data Penggiat Narkotika</h2>
            <form action="{{ route('admin.data.penggiat.update', $penggiat->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $penggiat->nama) }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                    @error('nama')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Address Section -->
                <div class="mb-4">
                    <h6 class="text-lg font-semibold text-primary mb-4"><i class="fas fa-map-marker-alt mr-2"></i>Alamat
                    </h6>
                </div>

                <div class="mb-4">
                    <label for="provinsi" class="block font-semibold mb-1">Provinsi <span
                            class="text-red-500">*</span></label>
                    <select name="provinsi" id="provinsi" required class="w-full border-gray-300 rounded px-3 py-2">
                        <option value="">Pilih Provinsi</option>
                        <option value="Jawa Timur"
                            {{ old('provinsi', $penggiat->provinsi ?? '') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur
                        </option>
                        <option value="lainnya"
                            {{ old('provinsi', $penggiat->provinsi ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('provinsi')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div id="wilayah-jatim">
                    <div class="mb-4">
                        <label for="kabupaten" class="block font-semibold mb-1">Kabupaten/Kota <span
                                class="text-red-500">*</span></label>
                        <select name="kabupaten" id="kabupaten" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="">Pilih Kabupaten/Kota</option>
                            @if (isset($kabupatenList))
                                @foreach ($kabupatenList as $kabupaten)
                                    <option value="{{ $kabupaten }}"
                                        {{ old('kabupaten', $penggiat->kabupaten ?? '') == $kabupaten ? 'selected' : '' }}>
                                        {{ $kabupaten }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('kabupaten')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kecamatan" class="block font-semibold mb-1">Kecamatan <span
                                class="text-red-500">*</span></label>
                        <select name="kecamatan" id="kecamatan" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="">Pilih Kecamatan</option>
                            @if (isset($penggiat->kecamatan) && $penggiat->kecamatan)
                                <option value="{{ $penggiat->kecamatan }}" selected>{{ $penggiat->kecamatan }}</option>
                            @endif
                        </select>
                        @error('kecamatan')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="kelurahan" class="block font-semibold mb-1">Kelurahan/Desa <span
                                class="text-red-500">*</span></label>
                        <select name="kelurahan" id="kelurahan" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="">Pilih Kelurahan/Desa</option>
                            @if (isset($penggiat->kelurahan) && $penggiat->kelurahan)
                                <option value="{{ $penggiat->kelurahan }}" selected>{{ $penggiat->kelurahan }}</option>
                            @endif
                        </select>
                        @error('kelurahan')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div id="wilayah-lainnya" class="hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-semibold mb-1">Provinsi</label>
                            <input type="text" name="provinsi_lain" id="provinsi_lain"
                                class="w-full border-gray-300 rounded px-3 py-2" placeholder="Provinsi"
                                value="{{ old('provinsi_lain', $penggiat->provinsi_lain ?? '') }}">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Kabupaten</label>
                            <input type="text" name="kabupaten_lain" class="w-full border-gray-300 rounded px-3 py-2"
                                placeholder="Kabupaten"
                                value="{{ old('kabupaten_lain', $penggiat->kabupaten_lain ?? '') }}">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Kecamatan</label>
                            <input type="text" name="kecamatan_lain" class="w-full border-gray-300 rounded px-3 py-2"
                                placeholder="Kecamatan"
                                value="{{ old('kecamatan_lain', $penggiat->kecamatan_lain ?? '') }}">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Kelurahan/Desa</label>
                            <input type="text" name="kelurahan_lain" class="w-full border-gray-300 rounded px-3 py-2"
                                placeholder="Kelurahan/Desa"
                                value="{{ old('kelurahan_lain', $penggiat->kelurahan_lain ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Alamat Lengkap (Jalan/RT/RW) <span
                            class="text-red-500">*</span></label>
                    <textarea name="alamat" class="w-full border-gray-300 rounded px-3 py-2" required
                        placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('alamat', $penggiat->alamat) }}</textarea>
                    @error('alamat')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">No HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $penggiat->no_hp) }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                    @error('no_hp')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Kegiatan <span class="text-red-500">*</span></label>
                    <input type="text" name="kegiatan" value="{{ old('kegiatan', $penggiat->kegiatan ?? '') }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                    @error('kegiatan')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex gap-2 mt-6">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    <a href="{{ route('admin.data.penggiat.index') }}"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
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
                            `/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`)
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
