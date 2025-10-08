@extends('layouts.admin-master')

@section('title', 'Edit THM')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Edit Data Tempat Hiburan Malam (THM)</h2>
            <form action="{{ route('admin.data.thm.update', $thm->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama THM</label>
                    <input type="text" name="nama_thm" value="{{ old('nama_thm', $thm->nama_thm) }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                    @error('nama_thm')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address Section -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold mb-3"><i class="fas fa-map-marker-alt mr-2"></i>Alamat THM</h3>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Provinsi <span class="text-red-500">*</span></label>
                    <select name="provinsi" id="provinsi" class="w-full border-gray-300 rounded px-3 py-2" required>
                        <option value="">Pilih Provinsi</option>
                        <option value="Jawa Timur" {{ old('provinsi', $thm->provinsi) == 'Jawa Timur' ? 'selected' : '' }}>
                            Jawa Timur</option>
                        <option value="lainnya" {{ old('provinsi', $thm->provinsi) == 'lainnya' ? 'selected' : '' }}>Lainnya
                        </option>
                    </select>
                    @error('provinsi')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div id="wilayah-jatim">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block font-semibold mb-1">Kabupaten/Kota <span
                                    class="text-red-500">*</span></label>
                            <select name="kabupaten" id="kabupaten" class="w-full border-gray-300 rounded px-3 py-2"
                                required>
                                <option value="">Pilih Kabupaten/Kota</option>
                                @if (isset($kabupatenList))
                                    @foreach ($kabupatenList as $kabupaten)
                                        <option value="{{ $kabupaten }}"
                                            {{ old('kabupaten', $thm->kabupaten) == $kabupaten ? 'selected' : '' }}>
                                            {{ $kabupaten }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kabupaten')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-semibold mb-1">Kecamatan <span class="text-red-500">*</span></label>
                            <select name="kecamatan" id="kecamatan" class="w-full border-gray-300 rounded px-3 py-2"
                                required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-semibold mb-1">Kelurahan/Desa <span
                                    class="text-red-500">*</span></label>
                            <select name="kelurahan" id="kelurahan" class="w-full border-gray-300 rounded px-3 py-2"
                                required>
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                            @error('kelurahan')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="wilayah-lainnya" class="hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-semibold mb-1">Provinsi</label>
                            <input type="text" name="provinsi_lain" id="provinsi_lain"
                                class="w-full border-gray-300 rounded px-3 py-2" placeholder="Provinsi"
                                value="{{ old('provinsi_lain', $thm->provinsi) }}">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Kabupaten</label>
                            <input type="text" name="kabupaten_lain" class="w-full border-gray-300 rounded px-3 py-2"
                                placeholder="Kabupaten" value="{{ old('kabupaten_lain', $thm->kabupaten) }}">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Kecamatan</label>
                            <input type="text" name="kecamatan_lain" class="w-full border-gray-300 rounded px-3 py-2"
                                placeholder="Kecamatan" value="{{ old('kecamatan_lain', $thm->kecamatan) }}">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Kelurahan/Desa</label>
                            <input type="text" name="kelurahan_lain" class="w-full border-gray-300 rounded px-3 py-2"
                                placeholder="Kelurahan/Desa" value="{{ old('kelurahan_lain', $thm->kelurahan) }}">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Alamat Lengkap (Jalan/RT/RW) <span
                            class="text-red-500">*</span></label>
                    <textarea name="alamat" id="alamat" rows="2" class="w-full border-gray-300 rounded px-3 py-2" required
                        placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('alamat', $thm->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Ketua THM</label>
                    <input type="text" name="ketua_thm" value="{{ old('ketua_thm', $thm->ketua_thm) }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                    @error('ketua_thm')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">No HP Ketua</label>
                    <input type="text" name="no_hp_ketua" value="{{ old('no_hp_ketua', $thm->no_hp_ketua) }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                    @error('no_hp_ketua')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-2 mt-6">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    <a href="{{ route('admin.data.thm.index') }}"
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
                                if (kecamatan === '{{ old('kecamatan', $thm->kecamatan) }}') {
                                    option.selected = true;
                                }
                                kecamatanSelect.appendChild(option);
                            });

                            // Trigger kecamatan change to load desa
                            if (kecamatanSelect.value) {
                                kecamatanSelect.dispatchEvent(new Event('change'));
                            }
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
                                if (desa === '{{ old('kelurahan', $thm->kelurahan) }}') {
                                    option.selected = true;
                                }
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

            // Load initial data if kabupaten is selected
            if (kabupatenSelect.value) {
                kabupatenSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endpush
