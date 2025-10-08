@extends('layouts.admin-master')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Edit Data LSM Narkotika</h2>
            <form action="{{ route('admin.data.lsm.update', $lsm->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama LSM</label>
                    <input type="text" name="nama_lsm" value="{{ old('nama_lsm', $lsm->nama_lsm) }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Provinsi</label>
                        <select id="provinsi" name="provinsi" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="">Pilih Provinsi</option>
                            <option value="Jawa Timur"
                                {{ old('provinsi', $lsm->provinsi) == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Kabupaten/Kota</label>
                        <select id="kabupaten" name="kabupaten" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="">Pilih Kabupaten/Kota</option>
                            @isset($kabupatenList)
                                @foreach ($kabupatenList as $kab)
                                    <option value="{{ $kab }}"
                                        {{ old('kabupaten', $lsm->kabupaten) == $kab ? 'selected' : '' }}>{{ $kab }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="{{ old('kecamatan', $lsm->kecamatan) }}">
                                {{ old('kecamatan', $lsm->kecamatan) ?: 'Pilih Kecamatan' }}</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Kelurahan/Desa</label>
                        <select id="kelurahan" name="kelurahan" class="w-full border-gray-300 rounded px-3 py-2">
                            <option value="{{ old('kelurahan', $lsm->kelurahan) }}">
                                {{ old('kelurahan', $lsm->kelurahan) ?: 'Pilih Kelurahan/Desa' }}</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Alamat</label>
                    <textarea name="alamat" class="w-full border-gray-300 rounded px-3 py-2" required>{{ old('alamat', $lsm->alamat) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">No. Telp</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp', $lsm->no_telp) }}"
                        class="w-full border-gray-300 rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Ketua LSM</label>
                    <input type="text" name="ketua_lsm" value="{{ old('ketua_lsm', $lsm->ketua_lsm) }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">No. HP Ketua</label>
                    <input type="text" name="no_hp_ketua" value="{{ old('no_hp_ketua', $lsm->no_hp_ketua) }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="flex gap-2 mt-6">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    <a href="{{ route('admin.data.lsm.index') }}"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        const kabupatenSelect = document.getElementById('kabupaten');
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');

        function loadKecamatan(initial = false) {
            const kab = kabupatenSelect.value;
            if (!kab) {
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                return;
            }
            fetch(`/api/kecamatan-list?kabupaten=${encodeURIComponent(kab)}`)
                .then(res => res.json())
                .then(data => {
                    const current = '{{ old('kecamatan', $lsm->kecamatan) }}';
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    (data || []).forEach(kec => {
                        const opt = document.createElement('option');
                        opt.value = kec;
                        opt.textContent = kec;
                        if (current === kec) opt.selected = true;
                        kecamatanSelect.appendChild(opt);
                    });
                    if (initial && current) loadKelurahan(true);
                });
        }

        function loadKelurahan(initial = false) {
            const kab = kabupatenSelect.value;
            const kec = kecamatanSelect.value;
            if (!kab || !kec) {
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                return;
            }
            fetch(`/api/desa-list?kabupaten=${encodeURIComponent(kab)}&kecamatan=${encodeURIComponent(kec)}`)
                .then(res => res.json())
                .then(data => {
                    const current = '{{ old('kelurahan', $lsm->kelurahan) }}';
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                    (data || []).forEach(desa => {
                        const opt = document.createElement('option');
                        opt.value = desa;
                        opt.textContent = desa;
                        if (current === desa) opt.selected = true;
                        kelurahanSelect.appendChild(opt);
                    });
                });
        }

        kabupatenSelect && kabupatenSelect.addEventListener('change', () => loadKecamatan());
        kecamatanSelect && kecamatanSelect.addEventListener('change', () => loadKelurahan());

        document.addEventListener('DOMContentLoaded', () => {
            if (kabupatenSelect && kabupatenSelect.value) {
                loadKecamatan(true);
            }
        });
    </script>
@endsection
