@extends('layouts.admin-master')

@section('title', 'Edit Akun Media Sosial')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Edit Akun Media Sosial</h2>
            <form action="{{ route('admin.data.medsos.update', $medsos->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama Media Sosial <span class="text-red-500">*</span></label>
                    <select id="nama_media_sosial" name="nama_media_sosial" class="w-full border-gray-300 rounded px-3 py-2"
                        required>
                        <option value="">Pilih Media Sosial</option>
                        <option value="Instagram"
                            {{ old('nama_media_sosial', $medsos->nama_media_sosial) == 'Instagram' ? 'selected' : '' }}>
                            Instagram</option>
                        <option value="Facebook"
                            {{ old('nama_media_sosial', $medsos->nama_media_sosial) == 'Facebook' ? 'selected' : '' }}>
                            Facebook</option>
                        <option value="Tiktok"
                            {{ old('nama_media_sosial', $medsos->nama_media_sosial) == 'Tiktok' ? 'selected' : '' }}>Tiktok
                        </option>
                        <option value="Telegram"
                            {{ old('nama_media_sosial', $medsos->nama_media_sosial) == 'Telegram' ? 'selected' : '' }}>
                            Telegram</option>
                        <option value="Lainnya"
                            {{ old('nama_media_sosial', $medsos->nama_media_sosial) == 'Lainnya' ? 'selected' : '' }}>
                            Lainnya</option>
                    </select>
                    <input type="text" id="nama_media_sosial_lainnya" name="nama_media_sosial_lainnya"
                        class="w-full border-gray-300 rounded px-3 py-2 mt-2" placeholder="Nama Media Sosial"
                        value="{{ old('nama_media_sosial_lainnya', $medsos->nama_media_sosial_lainnya) }}"
                        style="display: {{ old('nama_media_sosial', $medsos->nama_media_sosial) == 'Lainnya' ? 'block' : 'none' }};">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Jenis Akun <span class="text-red-500">*</span></label>
                    <div class="mt-1">
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_akun" value="personal" id="jenis_personal"
                                    class="form-radio text-blue-600"
                                    {{ old('jenis_akun', $medsos->jenis_akun) == 'personal' ? 'checked' : '' }}>
                                <span class="ml-2">Personal</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="jenis_akun" value="kelompok" id="jenis_kelompok"
                                    class="form-radio text-blue-600"
                                    {{ old('jenis_akun', $medsos->jenis_akun) == 'kelompok' ? 'checked' : '' }}>
                                <span class="ml-2">Kelompok/Komunitas</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="personal-section"
                    style="display: {{ old('jenis_akun', $medsos->jenis_akun) == 'personal' ? 'block' : 'none' }};">
                    <label class="block font-semibold mb-1">Profil Individu</label>
                    <div class="mt-1 relative">
                        <input type="text" id="search_nik" name="search_nik"
                            class="w-full border-gray-300 rounded px-3 py-2"
                            placeholder="Masukkan NIK untuk mencari profil individu"
                            value="{{ $medsos->individu ? $medsos->individu->nama . ' (' . $medsos->individu->nik . ')' : '' }}">
                        <div id="search-results"
                            class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded shadow-lg hidden">
                            <!-- Hasil pencarian akan muncul di sini -->
                        </div>
                    </div>
                    <input type="hidden" id="selected_individu_id" name="individu_id"
                        value="{{ old('individu_id', $medsos->individu_id) }}">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama Akun <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_akun" value="{{ old('nama_akun', $medsos->nama_akun) }}"
                        class="w-full border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Link Akun</label>
                    <input type="url" name="link_akun" value="{{ old('link_akun', $medsos->link_akun) }}"
                        class="w-full border-gray-300 rounded px-3 py-2">
                </div>
                <div class="flex gap-2 mt-6">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                    <a href="{{ route('admin.data.medsos.index') }}"
                        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const select = document.getElementById('nama_media_sosial');
        const inputLainnya = document.getElementById('nama_media_sosial_lainnya');
        const jenisPersonal = document.getElementById('jenis_personal');
        const jenisKelompok = document.getElementById('jenis_kelompok');
        const personalSection = document.getElementById('personal-section');
        const searchNik = document.getElementById('search_nik');
        const searchResults = document.getElementById('search-results');
        const selectedIndividuId = document.getElementById('selected_individu_id');

        // Handle media sosial selection
        select.addEventListener('change', function() {
            if (this.value === 'Lainnya') {
                inputLainnya.style.display = 'block';
                inputLainnya.required = true;
            } else {
                inputLainnya.style.display = 'none';
                inputLainnya.required = false;
                inputLainnya.value = '';
            }
        });

        // Handle jenis akun selection
        jenisPersonal.addEventListener('change', function() {
            if (this.checked) {
                personalSection.style.display = 'block';
                searchNik.required = true;
            }
        });

        jenisKelompok.addEventListener('change', function() {
            if (this.checked) {
                personalSection.style.display = 'none';
                searchNik.required = false;
                searchNik.value = '';
                selectedIndividuId.value = '';
                searchResults.classList.add('hidden');
            }
        });

        // Handle NIK search
        let searchTimeout;
        searchNik.addEventListener('input', function() {
            const nik = this.value.trim();

            clearTimeout(searchTimeout);

            if (nik.length === 16) {
                searchTimeout = setTimeout(() => {
                    searchIndividu(nik);
                }, 500);
            } else {
                searchResults.classList.add('hidden');
            }
        });

        function searchIndividu(nik) {
            fetch(`/admin/api/search-individu-by-nik?nik=${encodeURIComponent(nik)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data) {
                        showSearchResults(data.data);
                    } else {
                        searchResults.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error searching individu:', error);
                    searchResults.classList.add('hidden');
                });
        }

        function showSearchResults(individu) {
            searchResults.innerHTML = `
            <div class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-200" onclick="selectIndividu(${individu.id}, '${individu.nama}', '${individu.nik}')">
                <div class="font-medium text-gray-900">${individu.nama}</div>
                <div class="text-sm text-gray-500">NIK: ${individu.nik}</div>
                <div class="text-sm text-gray-500">${individu.kabupaten}, ${individu.kecamatan}</div>
            </div>
        `;
            searchResults.classList.remove('hidden');
        }

        function selectIndividu(id, nama, nik) {
            searchNik.value = `${nama} (${nik})`;
            selectedIndividuId.value = id;
            searchResults.classList.add('hidden');
        }

        // Hide search results when clicking outside
        document.addEventListener('click', function(event) {
            if (!searchNik.contains(event.target) && !searchResults.contains(event.target)) {
                searchResults.classList.add('hidden');
            }
        });
    </script>
@endsection
