@extends('layouts.admin-master')

@section('title', 'Edit Data Transportasi')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Edit Data Transportasi</h2>
            <a href="{{ route('admin.data.transportasi.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded shadow p-6">
            <form action="{{ route('admin.data.transportasi.update', $transportasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="jenis_transportasi" class="block text-sm font-medium text-gray-700 mb-2">Jenis
                            Transportasi *</label>
                        <select name="jenis_transportasi" id="jenis_transportasi"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="">Pilih Jenis Transportasi</option>
                            @foreach ($jenisTransportasiOptions as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('jenis_transportasi', $transportasi->jenis_transportasi) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_transportasi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_pihak" class="block text-sm font-medium text-gray-700 mb-2">Nama Pihak *</label>
                        <input type="text" name="nama_pihak" id="nama_pihak"
                            value="{{ old('nama_pihak', $transportasi->nama_pihak) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('nama_pihak')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Terstruktur -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                        <select id="provinsi" name="provinsi"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Pilih Provinsi</option>
                            <option value="Jawa Timur"
                                {{ old('provinsi', $transportasi->provinsi) == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur
                            </option>
                            <option value="lainnya"
                                {{ old('provinsi', $transportasi->provinsi) == 'lainnya' ? 'selected' : '' }}>Lainnya
                            </option>
                        </select>
                    </div>

                    <div id="wilayah-jatim" class="md:col-span-2 space-y-4 hidden">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                            <select id="kabupaten" name="kabupaten"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            @error('kabupaten')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            @error('kecamatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                            <select id="kelurahan" name="kelurahan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                            @error('kelurahan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div id="wilayah-lainnya" class="md:col-span-2 hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                                <input type="text" name="provinsi_lain"
                                    value="{{ old('provinsi_lain', $transportasi->provinsi_lain) }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                                <input type="text" name="kabupaten_lain"
                                    value="{{ old('kabupaten_lain', $transportasi->kabupaten_lain) }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                <input type="text" name="kecamatan_lain"
                                    value="{{ old('kecamatan_lain', $transportasi->kecamatan_lain) }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                <input type="text" name="kelurahan_lain"
                                    value="{{ old('kelurahan_lain', $transportasi->kelurahan_lain) }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>{{ old('alamat', $transportasi->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_manager" class="block text-sm font-medium text-gray-700 mb-2">Nama
                            Kepala/Manager</label>
                        <input type="text" name="nama_manager" id="nama_manager"
                            value="{{ old('nama_manager', $transportasi->nama_manager) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('nama_manager')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan"
                            value="{{ old('jabatan', $transportasi->jabatan) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('jabatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                        <input type="text" name="no_hp" id="no_hp"
                            value="{{ old('no_hp', $transportasi->no_hp) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('no_hp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.data.transportasi.index') }}"
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
            const provinsi = document.getElementById('provinsi');
            const kabupaten = document.getElementById('kabupaten');
            const kecamatan = document.getElementById('kecamatan');
            const kelurahan = document.getElementById('kelurahan');
            const wilayahJatim = document.getElementById('wilayah-jatim');
            const wilayahLainnya = document.getElementById('wilayah-lainnya');

            const defaultProv = @json(old('provinsi', $transportasi->provinsi));
            const defaultKab = @json(old('kabupaten', $transportasi->kabupaten));
            const defaultKec = @json(old('kecamatan', $transportasi->kecamatan));
            const defaultKel = @json(old('kelurahan', $transportasi->kelurahan));

            function showJatim() {
                wilayahJatim.classList.remove('hidden');
                wilayahLainnya.classList.add('hidden');
                kabupaten.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                fetch('/admin/api/kabupaten-list')
                    .then(r => r.json())
                    .then(list => {
                        (list || []).forEach(kab => {
                            const opt = document.createElement('option');
                            opt.value = kab;
                            opt.textContent = kab;
                            if (defaultKab && defaultKab === kab) opt.selected = true;
                            kabupaten.appendChild(opt);
                        });
                        if (defaultKab) loadKecamatan(defaultKab, true);
                    });
            }

            function loadKecamatan(kab, preselect = false) {
                kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                fetch(`/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kab)}`)
                    .then(r => r.json())
                    .then(list => {
                        (list || []).forEach(kec => {
                            const opt = document.createElement('option');
                            opt.value = kec;
                            opt.textContent = kec;
                            if (preselect && defaultKec && defaultKec === kec) opt.selected = true;
                            kecamatan.appendChild(opt);
                        });
                        if (preselect && defaultKec) loadKelurahan(kab, defaultKec, true);
                    });
            }

            function loadKelurahan(kab, kec, preselect = false) {
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                fetch(
                        `/admin/api/desa-list?kabupaten=${encodeURIComponent(kab)}&kecamatan=${encodeURIComponent(kec)}`)
                    .then(r => r.json())
                    .then(list => {
                        (list || []).forEach(des => {
                            const opt = document.createElement('option');
                            opt.value = des;
                            opt.textContent = des;
                            if (preselect && defaultKel && defaultKel === des) opt.selected = true;
                            kelurahan.appendChild(opt);
                        });
                    });
            }

            provinsi.addEventListener('change', function() {
                if (this.value === 'Jawa Timur') {
                    showJatim();
                } else if (this.value === 'lainnya') {
                    wilayahJatim.classList.add('hidden');
                    wilayahLainnya.classList.remove('hidden');
                } else {
                    wilayahJatim.classList.add('hidden');
                    wilayahLainnya.classList.add('hidden');
                }
            });

            kabupaten.addEventListener('change', function() {
                const kab = this.value;
                if (!kab) return;
                loadKecamatan(kab, false);
            });

            kecamatan.addEventListener('change', function() {
                const kab = kabupaten.value;
                const kec = this.value;
                if (!kab || !kec) return;
                loadKelurahan(kab, kec, false);
            });

            if (defaultProv === 'Jawa Timur') {
                showJatim();
            } else if (defaultProv === 'lainnya') {
                wilayahJatim.classList.add('hidden');
                wilayahLainnya.classList.remove('hidden');
            }
        });
    </script>
@endpush
