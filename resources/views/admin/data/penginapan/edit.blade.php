@extends('layouts.admin-master')

@section('title', 'Edit Penginapan')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Edit Data Penginapan</h2>
            <a href="{{ route('admin.data.penginapan.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white rounded shadow p-6">
            <form action="{{ route('admin.data.penginapan.update', $penginapan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Penginapan *</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $penginapan->nama) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('nama')
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
                                    {{ old('jenis', $penginapan->jenis) == $value ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_pengelola" class="block text-sm font-medium text-gray-700 mb-2">Nama Pengelola
                            *</label>
                        <input type="text" name="nama_pengelola" id="nama_pengelola"
                            value="{{ old('nama_pengelola', $penginapan->nama_pengelola) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('nama_pengelola')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $penginapan->no_hp) }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('no_hp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Terstruktur -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                        <select id="provinsi" name="provinsi"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @php $provSel = old('provinsi', $penginapan->provinsi ?? ''); @endphp
                            <option value="">Pilih Provinsi</option>
                            <option value="Jawa Timur" {{ $provSel === 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur
                            </option>
                            <option value="lainnya" {{ $provSel === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div id="wilayah-jatim" class="space-y-4 hidden md:col-span-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten/Kota</label>
                            <select id="kabupaten" name="kabupaten"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                            <select id="kecamatan" name="kecamatan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan/Desa</label>
                            <select id="kelurahan" name="kelurahan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                        </div>
                    </div>

                    <div id="wilayah-lainnya" class="hidden md:col-span-2">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                <input type="text" name="provinsi_lain"
                                    value="{{ old('provinsi_lain', $penginapan->provinsi_lain ?? '') }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                                <input type="text" name="kabupaten_lain"
                                    value="{{ old('kabupaten_lain', $penginapan->kabupaten_lain ?? '') }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                <input type="text" name="kecamatan_lain"
                                    value="{{ old('kecamatan_lain', $penginapan->kecamatan_lain ?? '') }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan/Desa</label>
                                <input type="text" name="kelurahan_lain"
                                    value="{{ old('kelurahan_lain', $penginapan->kelurahan_lain ?? '') }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2">
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
                        <textarea name="lokasi" id="lokasi" rows="3"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>{{ old('lokasi', $penginapan->lokasi) }}</textarea>
                        @error('lokasi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('admin.data.penginapan.index') }}"
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
        document.addEventListener('DOMContentLoaded', async function() {
            const provinsi = document.getElementById('provinsi');
            const kabupaten = document.getElementById('kabupaten');
            const kecamatan = document.getElementById('kecamatan');
            const kelurahan = document.getElementById('kelurahan');
            const wilayahJatim = document.getElementById('wilayah-jatim');
            const wilayahLainnya = document.getElementById('wilayah-lainnya');

            const selectedKab = @json(old('kabupaten', $penginapan->kabupaten ?? ''));
            const selectedKec = @json(old('kecamatan', $penginapan->kecamatan ?? ''));
            const selectedKel = @json(old('kelurahan', $penginapan->kelurahan ?? ''));

            async function loadKabupaten() {
                kabupaten.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                const res = await fetch('/admin/api/kabupaten-list');
                const list = await res.json();
                (list || []).forEach(kab => {
                    const opt = document.createElement('option');
                    opt.value = kab;
                    opt.textContent = kab;
                    if (kab === selectedKab) opt.selected = true;
                    kabupaten.appendChild(opt);
                });
            }

            async function loadKecamatan(kab) {
                kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
                const res = await fetch(`/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kab)}`);
                const list = await res.json();
                (list || []).forEach(kec => {
                    const opt = document.createElement('option');
                    opt.value = kec;
                    opt.textContent = kec;
                    if (kec === selectedKec) opt.selected = true;
                    kecamatan.appendChild(opt);
                });
            }

            async function loadKelurahan(kab, kec) {
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                const res = await fetch(
                    `/admin/api/desa-list?kabupaten=${encodeURIComponent(kab)}&kecamatan=${encodeURIComponent(kec)}`
                    );
                const list = await res.json();
                (list || []).forEach(des => {
                    const opt = document.createElement('option');
                    opt.value = des;
                    opt.textContent = des;
                    if (des === selectedKel) opt.selected = true;
                    kelurahan.appendChild(opt);
                });
            }

            provinsi.addEventListener('change', function() {
                if (this.value === 'Jawa Timur') {
                    wilayahJatim.classList.remove('hidden');
                    wilayahLainnya.classList.add('hidden');
                    loadKabupaten();
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
                loadKecamatan(kab);
            });

            kecamatan.addEventListener('change', function() {
                const kab = kabupaten.value;
                const kec = this.value;
                if (!kab || !kec) return;
                loadKelurahan(kab, kec);
            });

            // Prefill when opening page
            if (provinsi.value === 'Jawa Timur') {
                wilayahJatim.classList.remove('hidden');
                await loadKabupaten();
                if (selectedKab) {
                    await loadKecamatan(selectedKab);
                    if (selectedKec) {
                        await loadKelurahan(selectedKab, selectedKec);
                    }
                }
            } else if (provinsi.value === 'lainnya') {
                wilayahLainnya.classList.remove('hidden');
            }
        });
    </script>
@endpush
