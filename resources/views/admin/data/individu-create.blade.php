@extends('layouts.admin-master')

@section('title', 'Tambah Data Individu TSK')
@include('components.admin-navbar')

@section('content')
<div class="px-4 pt-2 pb-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 light:text-white">Tambah Data Individu TSK</h1>
            <p class="text-sm text-gray-500">Silakan lengkapi formulir berikut dengan data yang akurat.</p>
        </div>
        <a href="{{ route('admin.data.individu') }}" class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-10 max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
            <div class="lg:col-span-5">
                <!-- Form Input -->
                <div class="bg-white light:bg-gray-800 shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-blue-600 mb-4">Formulir Data Individu</h2>

                    @if(session('error'))
                    <div class="bg-red-100 text-red-800 text-sm p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                    @endif

                    {{-- Tampilkan pesan sukses atau error dari session --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Tampilkan error validasi --}}
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Terjadi kesalahan saat mengisi form:</strong>
    <ul class="mb-0 mt-1">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


                    <form action="{{ route('admin.data.individu.store') }}" method="POST" id="individuForm" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2 mb-4">
                                <label for="nama" class="block text-base font-medium text-black">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base" value="{{ old('nama') }}">
                            </div>
                            <div class="mb-4">
                                <label for="nik" class="block text-base font-medium text-black">NIK</label>
                                <input type="text" name="nik" id="nik" maxlength="16" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base" value="{{ old('nik') }}">
                            </div>
                            <div class="mb-4">
                                <label for="nkk" class="block text-base font-medium text-black">Nomor KK</label>
                                <input type="text" name="nkk" id="nkk" maxlength="16" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base" value="{{ old('nkk') }}">
                            </div>
                            <!-- Input Dinamis Nomor Telepon -->
                            <div class="md:col-span-2 mb-4" id="telepon-wrapper">
                                <label class="block text-base font-medium text-black">Nomor Telepon</label>
                                <div id="telepon-fields">
                                    <div class="flex items-center gap-2 mt-1 telepon-row">
                                        <input type="number" name="telepon[]" maxlength="20" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                    </div>
                                </div>
                            </div>
                            <!-- Input Dinamis No Rekening -->
                            <div class="md:col-span-2 mb-4" id="rekening-wrapper">
                                <label class="block text-base font-medium text-black">No. Rekening</label>
                                <div id="rekening-fields">
                                    <div class="flex items-center gap-2 mt-1 rekening-row">
                                        <input type="number" name="rekening[]" maxlength="30" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base">
                                    </div>
                                </div>
                            </div>
                            <!-- Input Dinamis No E-Wallet -->
                            <div class="md:col-span-2 mb-4" id="ewallet-wrapper">
                                <label class="block text-base font-medium text-black">No. E-Wallet</label>
                                <div id="ewallet-fields">
                                    <div class="flex items-center gap-2 mt-1 ewallet-row">
                                        <input type="number" name="ewallet[]" maxlength="30" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="provinsi" class="block text-sm font-medium text-black  ">Provinsi</label>
                                <select name="provinsi" id="provinsi" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="Jawa Timur" selected>Jawa Timur</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div id="wilayah-jatim">
                                <div>
                                    <label for="kabupaten" class="block text-sm font-medium text-black   mb-1">Kabupaten</label>
                                    <select name="kabupaten" id="kabupaten" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="kecamatan" class="block text-sm font-medium text-black   mb-1">Kecamatan</label>
                                    <select name="kecamatan" id="kecamatan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="kelurahan" class="block text-sm font-medium text-black   mb-1">Kelurahan/Desa</label>
                                    <select name="kelurahan" id="kelurahan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>
                                </div>
                                {{-- </div> --}}
                            </div>
                            <div id="wilayah-lainnya" class="hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-black   mb-1">Provinsi</label>
                                        <input type="text" name="provinsi_lain" id="provinsi_lain" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Provinsi">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-black   mb-1">Kabupaten</label>
                                        <input type="text" name="kabupaten_lain" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Kabupaten">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-black   mb-1">Kecamatan</label>
                                        <input type="text" name="kecamatan_lain" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Kecamatan">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-black   mb-1">Kelurahan/Desa</label>
                                        <input type="text" name="kelurahan_lain" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Kelurahan/Desa">
                                    </div>
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label for="alamat" class="block text-sm font-medium text-black  ">Alamat Lengkap (Dusun/Jalan/RT/RW)</label>
                                <textarea name="alamat" id="alamat" rows="2" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            </div>
                            <div>
                                <label for="nama_ayah" class="block text-sm font-medium text-black  ">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label for="nik_ayah" class="block text-sm font-medium text-black  ">NIK Ayah</label>
                                <input type="text" name="nik_ayah" id="nik_ayah" maxlength="16" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label for="nama_ibu" class="block text-sm font-medium text-black  ">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label for="nik_ibu" class="block text-sm font-medium text-black  ">NIK Ibu</label>
                                <input type="text" name="nik_ibu" id="nik_ibu" maxlength="16" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <!-- Input Dinamis Nama Keluarga Lain + NIK -->
                            <div class="md:col-span-2" id="keluarga-lain-wrapper">
                                <label class="block text-sm font-medium text-black  ">Nama Keluarga Lain & NIK</label>
                                <div id="keluarga-lain-fields">
                                    <div class="flex flex-col md:flex-row gap-2 mt-1 keluarga-lain-row">
                                        <input type="text" name="nama_keluarga_lain[]" maxlength="100" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Nama Keluarga Lain">
                                        <input type="text" name="nik_keluarga_lain[]" maxlength="16" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="NIK Keluarga Lain">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="peran_jaringan" class="block text-sm font-medium text-black  ">Peran dalam Jaringan</label>
                                <select name="peran_jaringan" id="peran_jaringan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Pilih Peran</option>
                                    <option value="koordinator informan">Koordinator Informan</option>
                                    <option value="informan">Informan</option>
                                    <option value="kurir">Kurir</option>
                                    <option value="gudang">Gudang</option>
                                    <option value="broker">Broker</option>
                                    <option value="bandar">Bandar</option>
                                    <option value="beking">Beking</option>
                                    <option value="tidak tahu">Tidak Tahu</option>
                                </select>
                            </div>
                            <div>
                                <label for="modus_operasi" class="block text-sm font-medium text-black  ">Modus Operasi</label>
                                <textarea name="modus_operasi" id="modus_operasi" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            </div>
                            <!-- Input Dinamis Jenis Narkotika -->
                            <div class="md:col-span-2" id="jenis-narkotika-wrapper">
                                <label class="block text-sm font-medium text-black  ">Jenis Narkotika</label>
                                <div id="jenis-narkotika-fields">
                                    <div class="flex items-center gap-2 mt-1 jenis-narkotika-row">
                                        <input type="text" name="jenis_narkotika[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Jenis Narkotika">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="skala_kelas" class="block text-sm font-medium text-black  ">Skala Kelas</label>
                                <select name="skala_kelas" id="skala_kelas" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Pilih Skala</option>
                                    <option value="dibawah 10gr">Dibawah 10gr</option>
                                    <option value="dibawah1ons">Dibawah 1 ons</option>
                                    <option value="dibawah1kg">Dibawah 1kg</option>
                                    <option value="diatas1kg">Diatas 1kg</option>
                                    <option value="tidak tahu">Tidak Tahu</option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-black  ">Status</label>
                                <select name="status" id="status" required class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm appearance-none">
                                    <option value="">Pilih Status</option>
                                    <option value="Napi">Napi</option>
                                    <option value="Non napi">Non napi</option>
                                </select>
                            </div>
                            <!-- Pilihan Resisivis -->
                            <div class="md:col-span-2" id="residivis-wrapper">
                                <label class="block text-sm font-medium text-black   mb-1">Residivis</label>
                                <div class="flex items-center gap-4 mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="residivis" value="1" class="form-radio text-blue-600" id="residivis-ya">
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="residivis" value="0" class="form-radio text-blue-600" id="residivis-tidak" checked>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                <div id="residivis-detail" class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200">
                                    <div class="mb-2" id="aph-m-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">a. APH yang menangani</label>
                                        <div id="aph-m-fields">
                                            <div class="flex items-center gap-2 mt-1 aph-m-row">
                                                <input type="text" name="aph_menangani[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="APH yang menangani">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="pasal-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">b. Pasal yang disangkakan</label>
                                        <div id="pasal-fields">
                                            <div class="flex items-center gap-2 mt-1 pasal-row">
                                                <input type="text" name="pasal_disangkakan[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Pasal yang disangkakan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="tkp-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">c. TKP</label>
                                        <div id="tkp-fields">
                                            <div class="tkp-row space-y-2 mt-1">
                                                <select name="tkp_provinsi[]" class="block w-full rounded-md border-gray-300 shadow-sm tkp-provinsi">
                                                    <option value="Jawa Timur">Jawa Timur</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                                <select name="tkp_kabupaten[]" class="block w-full rounded-md border-gray-300 shadow-sm tkp-kabupaten">
                                                    <option value="">Kabupaten</option>
                                                    @foreach($kabupatenList as $kabupaten)
                                                    <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                                                    @endforeach
                                                </select>
                                                <select name="tkp_kecamatan[]" class="block w-full rounded-md border-gray-300 shadow-sm tkp-kecamatan">
                                                    <option value="">Kecamatan</option>
                                                </select>
                                                <select name="tkp_desa[]" class="block w-full rounded-md border-gray-300 shadow-sm tkp-desa">
                                                    <option value="">Desa/Kelurahan</option>
                                                </select>
                                                <input type="text" name="tkp_lokasi[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Detail Lokasi (opsional)">
                                                <button type="button" class="hapus-tkp-row bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center self-center" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="vonis-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">d. Vonis</label>
                                        <div id="vonis-fields">
                                            <div class="flex items-center gap-2 mt-1 vonis-row">
                                                <input type="text" name="vonis[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Vonis">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="lapas-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">e. Lapas akhir</label>
                                        <div id="lapas-fields">
                                            <div class="flex items-center gap-2 mt-1 lapas-row">
                                                <input type="text" name="lapas_akhir[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Lapas akhir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Input Dinamis Keterangan + Upload Foto (ikon upload saja) -->
                            <div class="md:col-span-2" id="foto-wrapper">
                                <label class="block text-sm font-medium text-black">Keterangan & Upload Foto</label>
                                <div id="foto-fields">
                                    <div class="flex items-center gap-2 mt-1 foto-row">
                                        <input type="text" name="keterangan_foto[]" maxlength="100" class="block w-40 rounded-md border-gray-300 shadow-sm" placeholder="Keterangan Foto">

                                        {{-- Tombol untuk memilih file --}}
                                        <button type="button" class="upload-foto-btn flex items-center justify-center w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full border border-gray-300" title="Upload Foto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12" />
                                            </svg>
                                        </button>

                                        <input type="file" name="foto[]" accept="image/*" class="hidden foto-input">
                                        <img src="" alt="Preview" class="hidden w-32 h-32 object-cover rounded-md border border-gray-200 foto-preview">

                                        <button type="button" class="hapus-foto bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs self-center">Hapus</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <button type="reset" class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-md">Reset</button>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md inline-flex items-center">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-2">
                <div class="bg-white light:bg-gray-800 shadow rounded-lg p-4 text-xs">
                    <h2 class="text-base font-semibold text-blue-600 mb-3">Informasi Penting</h2>
                    <div class="bg-blue-50 text-blue-700 text-xs p-2 rounded mb-3">
                        <ul class="list-disc pl-4">
                            <li>Data akan terhubung dengan data kasus narkoba secara otomatis.</li>
                            <li>Pilih status "Napi" jika individu terlibat kasus.</li>
                            <li>Desa akan dipetakan berdasarkan kecamatan dan kelurahan.</li>
                        </ul>
                    </div>
                    <div class="bg-yellow-50 text-yellow-700 text-xs p-2 rounded flex items-center">
                        <i class="fas fa-exclamation-triangle mr-1"></i> NIK harus unik dan tidak boleh duplikat.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('kabupaten')?.addEventListener('change', function() {
            const kabupaten = this.value;
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');

            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            if (kabupaten) {
                fetch(`/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(kecamatan => {
                            const option = document.createElement('option');
                            option.value = kecamatan;
                            option.textContent = kecamatan;
                            kecamatanSelect.appendChild(option);
                        });
                    });
            }
        });

        document.getElementById('kecamatan')?.addEventListener('change', function() {
            const kecamatan = this.value;
            const kabupaten = document.getElementById('kabupaten').value;
            const kelurahanSelect = document.getElementById('kelurahan');
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

            if (kecamatan && kabupaten) {
                fetch(`/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // debug
                        data.forEach(nama_desa => {
                            const option = document.createElement('option');
                            option.value = nama_desa;
                            option.textContent = nama_desa;
                            kelurahanSelect.appendChild(option);
                        });
                    });
            }
        });

        ['nik', 'nkk'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 16);
            });
        });

        // Dinamis input nomor telepon
        function addTeleponFieldIfNeeded() {
            const wrapper = document.getElementById('telepon-fields');
            const rows = wrapper.querySelectorAll('.telepon-row');
            const lastInput = rows[rows.length - 1].querySelector('input');
            if (lastInput.value.trim() !== '' && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 mt-1 telepon-row';
                div.innerHTML = `<input type="number" name="telepon[]" maxlength="20" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <button type="button" class="hapus-telepon bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs">Hapus</button>`;
                wrapper.appendChild(div);
                div.querySelector('input').addEventListener('input', addTeleponFieldIfNeeded);
                div.querySelector('.hapus-telepon').addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Event untuk input pertama
        document.querySelector('#telepon-fields input').addEventListener('input', addTeleponFieldIfNeeded);

        // Event hapus untuk input dinamis
        document.getElementById('telepon-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-telepon')) {
                e.target.closest('.telepon-row').remove();
            }
        });

        // Dinamis input no rekening
        function addRekeningFieldIfNeeded() {
            const wrapper = document.getElementById('rekening-fields');
            const rows = wrapper.querySelectorAll('.rekening-row');
            const lastInput = rows[rows.length - 1].querySelector('input');
            if (lastInput.value.trim() !== '' && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 mt-1 rekening-row';
                div.innerHTML = `<input type="number" name="rekening[]" maxlength="30" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <button type="button" class="hapus-rekening bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs">Hapus</button>`;
                wrapper.appendChild(div);
                div.querySelector('input').addEventListener('input', addRekeningFieldIfNeeded);
                div.querySelector('.hapus-rekening').addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Event untuk input pertama rekening
        document.querySelector('#rekening-fields input').addEventListener('input', addRekeningFieldIfNeeded);

        // Event hapus untuk input dinamis rekening
        document.getElementById('rekening-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-rekening')) {
                e.target.closest('.rekening-row').remove();
            }
        });

        // Dinamis input no ewallet
        function addEwalletFieldIfNeeded() {
            const wrapper = document.getElementById('ewallet-fields');
            const rows = wrapper.querySelectorAll('.ewallet-row');
            const lastInput = rows[rows.length - 1].querySelector('input');
            if (lastInput.value.trim() !== '' && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 mt-1 ewallet-row';
                div.innerHTML = `<input type="number" name="ewallet[]" maxlength="30" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <button type="button" class="hapus-ewallet bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs">Hapus</button>`;
                wrapper.appendChild(div);
                div.querySelector('input').addEventListener('input', addEwalletFieldIfNeeded);
                div.querySelector('.hapus-ewallet').addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Event untuk input pertama ewallet
        document.querySelector('#ewallet-fields input').addEventListener('input', addEwalletFieldIfNeeded);

        // Event hapus untuk input dinamis ewallet
        document.getElementById('ewallet-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-ewallet')) {
                e.target.closest('.ewallet-row').remove();
            }
        });

        // Dinamis input nama keluarga lain + nik
        function addKeluargaLainFieldIfNeeded() {
            const wrapper = document.getElementById('keluarga-lain-fields');
            const rows = wrapper.querySelectorAll('.keluarga-lain-row');
            const lastNama = rows[rows.length - 1].querySelector('input[name="nama_keluarga_lain[]"]');
            const lastNik = rows[rows.length - 1].querySelector('input[name="nik_keluarga_lain[]"]');
            if ((lastNama.value.trim() !== '' || lastNik.value.trim() !== '') && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'flex flex-col md:flex-row gap-2 mt-1 keluarga-lain-row';
                div.innerHTML = `<input type="text" name="nama_keluarga_lain[]" maxlength="100" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Nama Keluarga Lain">
                <input type="text" name="nik_keluarga_lain[]" maxlength="16" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="NIK Keluarga Lain">
                <button type="button" class="hapus-keluarga-lain bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs self-start md:self-center">Hapus</button>`;
                wrapper.appendChild(div);
                div.querySelector('input[name="nama_keluarga_lain[]"]').addEventListener('input', addKeluargaLainFieldIfNeeded);
                div.querySelector('input[name="nik_keluarga_lain[]"]').addEventListener('input', addKeluargaLainFieldIfNeeded);
                div.querySelector('.hapus-keluarga-lain').addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Event untuk input pertama keluarga lain
        document.querySelector('#keluarga-lain-fields input[name="nama_keluarga_lain[]"]').addEventListener('input', addKeluargaLainFieldIfNeeded);
        document.querySelector('#keluarga-lain-fields input[name="nik_keluarga_lain[]"]').addEventListener('input', addKeluargaLainFieldIfNeeded);

        // Event hapus untuk input dinamis keluarga lain
        document.getElementById('keluarga-lain-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-keluarga-lain')) {
                e.target.closest('.keluarga-lain-row').remove();
            }
        });

        // Dinamis input jenis narkotika
        function addJenisNarkotikaFieldIfNeeded() {
            const wrapper = document.getElementById('jenis-narkotika-fields');
            const rows = wrapper.querySelectorAll('.jenis-narkotika-row');
            const lastInput = rows[rows.length - 1].querySelector('input');
            if (lastInput.value.trim() !== '' && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 mt-1 jenis-narkotika-row';
                div.innerHTML = `<input type="text" name="jenis_narkotika[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Jenis Narkotika">
                <button type="button" class="hapus-jenis-narkotika bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs">Hapus</button>`;
                wrapper.appendChild(div);
                div.querySelector('input').addEventListener('input', addJenisNarkotikaFieldIfNeeded);
                div.querySelector('.hapus-jenis-narkotika').addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Event untuk input pertama jenis narkotika
        document.querySelector('#jenis-narkotika-fields input').addEventListener('input', addJenisNarkotikaFieldIfNeeded);

        // Event hapus untuk input dinamis jenis narkotika
        document.getElementById('jenis-narkotika-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-jenis-narkotika')) {
                e.target.closest('.jenis-narkotika-row').remove();
            }
        });

        // Handle provinsi change
        document.getElementById('provinsi').addEventListener('change', function() {
            const isJatim = this.value === 'Jawa Timur';
            document.getElementById('wilayah-jatim').classList.toggle('hidden', !isJatim);
            document.getElementById('wilayah-lainnya').classList.toggle('hidden', isJatim);
            // Set required attribute
            document.getElementById('kabupaten').required = isJatim;
            document.getElementById('kecamatan').required = isJatim;
            document.getElementById('kelurahan').required = isJatim;
            document.getElementById('provinsi_lain').required = !isJatim;
            document.querySelector('input[name="kabupaten_lain"]').required = !isJatim;
            document.querySelector('input[name="kecamatan_lain"]').required = !isJatim;
            document.querySelector('input[name="kelurahan_lain"]').required = !isJatim;
        });

        // JS residivis tampilkan detail jika ya
        function toggleResidivisDetail() {
            const ya = document.getElementById('residivis-ya');
            const tidak = document.getElementById('residivis-tidak');
            const detail = document.getElementById('residivis-detail');
            if (ya.checked) {
                detail.classList.remove('hidden');
                // Set required
                detail.querySelectorAll('input').forEach(i => i.required = true);
            } else {
                detail.classList.add('hidden');
                detail.querySelectorAll('input').forEach(i => i.required = false);
            }
        }
        document.getElementById('residivis-ya').addEventListener('change', toggleResidivisDetail);
        document.getElementById('residivis-tidak').addEventListener('change', toggleResidivisDetail);
        // Inisialisasi
        toggleResidivisDetail();

        // Dinamis subfield residivis
        function addDinamisFieldIfNeeded(wrapperId, rowClass, inputName, placeholder) {
            const wrapper = document.getElementById(wrapperId);
            const rows = wrapper.querySelectorAll('.' + rowClass);
            const lastInput = rows[rows.length - 1].querySelector('input');
            if (lastInput.value.trim() !== '' && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 mt-1 ' + rowClass;
                div.innerHTML = `<input type="text" name="${inputName}[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="${placeholder}">
                <button type="button" class="hapus-${rowClass} bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs">Hapus</button>`;
                wrapper.appendChild(div);
                div.querySelector('input').addEventListener('input', function() {
                    addDinamisFieldIfNeeded(wrapperId, rowClass, inputName, placeholder);
                });
                div.querySelector(`.hapus-${rowClass}`).addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Event dinamis untuk masing-masing subfield residivis
        document.querySelector('#aph-m-fields input').addEventListener('input', function() {
            addDinamisFieldIfNeeded('aph-m-fields', 'aph-m-row', 'aph_menangani', 'APH yang menangani');
        });
        document.getElementById('aph-m-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-aph-m-row')) {
                e.target.closest('.aph-m-row').remove();
            }
        });
        document.querySelector('#pasal-fields input').addEventListener('input', function() {
            addDinamisFieldIfNeeded('pasal-fields', 'pasal-row', 'pasal_disangkakan', 'Pasal yang disangkakan');
        });
        document.getElementById('pasal-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-pasal-row')) {
                e.target.closest('.pasal-row').remove();
            }
        });
        // Dinamis subfield TKP: event dinamis tetap berjalan
        function addTkpFieldIfNeeded() {
            const wrapper = document.getElementById('tkp-fields');
            const rows = wrapper.querySelectorAll('.tkp-row');
            const lastProv = rows[rows.length - 1].querySelector('.tkp-provinsi');
            const lastKab = rows[rows.length - 1].querySelector('.tkp-kabupaten');
            const lastKec = rows[rows.length - 1].querySelector('.tkp-kecamatan');
            const lastDesa = rows[rows.length - 1].querySelector('.tkp-desa');
            const lastLokasi = rows[rows.length - 1].querySelector('input');
            if ((lastProv.value || lastKab.value || lastKec.value || lastDesa.value || lastLokasi.value.trim() !== '') && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'tkp-row space-y-2 mt-1';
                div.innerHTML = `
                <select name=\"tkp_provinsi[]\" class=\"block w-full rounded-md border-gray-300 shadow-sm tkp-provinsi\">\n<option value=\"Jawa Timur\">Jawa Timur</option>\n<option value=\"lainnya\">Lainnya</option>\n</select>
                <select name=\"tkp_kabupaten[]\" class=\"block w-full rounded-md border-gray-300 shadow-sm tkp-kabupaten\">\n<option value=\"\">Pilih Kabupaten</option>\n</select>
                <select name=\"tkp_kecamatan[]\" class=\"block w-full rounded-md border-gray-300 shadow-sm tkp-kecamatan\">\n<option value=\"\">Kecamatan</option>\n</select>
                <select name=\"tkp_desa[]\" class=\"block w-full rounded-md border-gray-300 shadow-sm tkp-desa\">\n<option value=\"\">Desa/Kelurahan</option>\n</select>
                <input type=\"text\" name=\"tkp_lokasi[]\" class=\"block w-full rounded-md border-gray-300 shadow-sm\" placeholder=\"Detail Lokasi (opsional)\">
                <button type=\"button\" class=\"hapus-tkp-row bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center self-center\" title=\"Hapus\">\n<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4 w-4\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\" /></svg>\n</button>`;
                wrapper.appendChild(div);
                // Fetch kabupaten list for this row
                fetch('/api/kabupaten-list')
                    .then(response => response.json())
                    .then(data => {
                        const kabupatenSelect = div.querySelector('.tkp-kabupaten');
                        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                        data.forEach(kab => {
                            const option = document.createElement('option');
                            option.value = kab;
                            option.textContent = kab;
                            kabupatenSelect.appendChild(option);
                        });
                    });
                div.querySelector('input').addEventListener('input', addTkpFieldIfNeeded);
                div.querySelector('.tkp-provinsi').addEventListener('change', function() {
                    handleTkpProvinsiChange(div);
                });
                div.querySelector('.tkp-kabupaten').addEventListener('change', function() {
                    handleTkpKabupatenChange(div);
                });
                div.querySelector('.tkp-kecamatan').addEventListener('change', function() {
                    handleTkpKecamatanChange(div);
                });
                div.querySelector('.hapus-tkp-row').addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Event dinamis untuk input pertama TKP
        (function() {
            const firstTkp = document.querySelector('#tkp-fields .tkp-row');
            if (firstTkp) {
                // Fetch kabupaten list for first row
                fetch('/api/kabupaten-list')
                    .then(response => response.json())
                    .then(data => {
                        const kabupatenSelect = firstTkp.querySelector('.tkp-kabupaten');
                        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                        data.forEach(kab => {
                            const option = document.createElement('option');
                            option.value = kab;
                            option.textContent = kab;
                            kabupatenSelect.appendChild(option);
                        });
                    });
                firstTkp.querySelector('input').addEventListener('input', addTkpFieldIfNeeded);
                firstTkp.querySelector('.tkp-provinsi').addEventListener('change', function() {
                    handleTkpProvinsiChange(firstTkp);
                });
                firstTkp.querySelector('.tkp-kabupaten').addEventListener('change', function() {
                    handleTkpKabupatenChange(firstTkp);
                });
                firstTkp.querySelector('.tkp-kecamatan').addEventListener('change', function() {
                    handleTkpKecamatanChange(firstTkp);
                });
            }
        })();
        // Handler dinamis wilayah TKP (AJAX sama seperti wilayah utama)
        function handleTkpProvinsiChange(row) {
            const prov = row.querySelector('.tkp-provinsi').value;
            const kabupatenSelect = row.querySelector('.tkp-kabupaten');
            const kecamatanSelect = row.querySelector('.tkp-kecamatan');
            const desaSelect = row.querySelector('.tkp-desa');
            if (prov === 'Jawa Timur') {
                kabupatenSelect.disabled = false;
                kecamatanSelect.disabled = false;
                desaSelect.disabled = false;
            } else {
                kabupatenSelect.value = '';
                kecamatanSelect.value = '';
                desaSelect.value = '';
                kabupatenSelect.disabled = true;
                kecamatanSelect.disabled = true;
                desaSelect.disabled = true;
            }
        }

        function handleTkpKabupatenChange(row) {
            const kabupaten = row.querySelector('.tkp-kabupaten').value;
            const kecamatanSelect = row.querySelector('.tkp-kecamatan');
            const desaSelect = row.querySelector('.tkp-desa');
            kecamatanSelect.innerHTML = '<option value="">Kecamatan</option>';
            desaSelect.innerHTML = '<option value="">Desa/Kelurahan</option>';
            if (kabupaten) {
                fetch(`/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(kecamatan => {
                            const option = document.createElement('option');
                            option.value = kecamatan;
                            option.textContent = kecamatan;
                            kecamatanSelect.appendChild(option);
                        });
                        // Attach event handler for kecamatan change (again, in case of dynamic rows)
                        kecamatanSelect.removeEventListener('change', kecamatanSelect._tkpChangeHandler);
                        kecamatanSelect._tkpChangeHandler = function() {
                            handleTkpKecamatanChange(row);
                        };
                        kecamatanSelect.addEventListener('change', kecamatanSelect._tkpChangeHandler);
                    });
            }
        }

        function handleTkpKecamatanChange(row) {
            const kabupaten = row.querySelector('.tkp-kabupaten').value;
            const kecamatan = row.querySelector('.tkp-kecamatan').value;
            const desaSelect = row.querySelector('.tkp-desa');
            desaSelect.innerHTML = '<option value="">Desa/Kelurahan</option>';
            if (kabupaten && kecamatan) {
                fetch(`/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(nama_desa => {
                            const option = document.createElement('option');
                            option.value = nama_desa;
                            option.textContent = nama_desa;
                            desaSelect.appendChild(option);
                        });
                    });
            }
        }
        // Event hapus untuk input dinamis TKP
        document.getElementById('tkp-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-tkp-row')) {
                e.target.closest('.tkp-row').remove();
            }
        });

        // Dinamis input vonis
        function addVonisFieldIfNeeded() {
            const wrapper = document.getElementById('vonis-fields');
            const rows = wrapper.querySelectorAll('.vonis-row');
            const lastInput = rows[rows.length - 1].querySelector('input');
            if (lastInput.value.trim() !== '' && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 mt-1 vonis-row';
                div.innerHTML = `<input type="text" name="vonis[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Vonis">
                <button type="button" class="hapus-vonis bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs">Hapus</button>`;
                wrapper.appendChild(div);
                div.querySelector('input').addEventListener('input', addVonisFieldIfNeeded);
                div.querySelector('.hapus-vonis').addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Event untuk input pertama vonis
        document.querySelector('#vonis-fields input').addEventListener('input', addVonisFieldIfNeeded);

        // Event hapus untuk input dinamis vonis
        document.getElementById('vonis-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-vonis')) {
                e.target.closest('.vonis-row').remove();
            }
        });

        // Dinamis input lapas akhir
        function addLapasFieldIfNeeded() {
            const wrapper = document.getElementById('lapas-fields');
            const rows = wrapper.querySelectorAll('.lapas-row');
            const lastInput = rows[rows.length - 1].querySelector('input');
            if (lastInput.value.trim() !== '' && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 mt-1 lapas-row';
                div.innerHTML = `<input type="text" name="lapas_akhir[]" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Lapas akhir">
                <button type="button" class="hapus-lapas bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs">Hapus</button>`;
                wrapper.appendChild(div);
                div.querySelector('input').addEventListener('input', addLapasFieldIfNeeded);
                div.querySelector('.hapus-lapas').addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Event untuk input pertama lapas akhir
        document.querySelector('#lapas-fields input').addEventListener('input', addLapasFieldIfNeeded);

        // Event hapus untuk input dinamis lapas akhir
        document.getElementById('lapas-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-lapas')) {
                e.target.closest('.lapas-row').remove();
            }
        });

        // Dinamis input keterangan + upload foto (ikon upload saja) + preview
        function addFotoRowIfNeeded() {
            const wrapper = document.getElementById('foto-fields');
            const rows = wrapper.querySelectorAll('.foto-row');
            const lastKet = rows[rows.length - 1].querySelector('input[type="text"]');
            const lastFile = rows[rows.length - 1].querySelector('input[type="file"]');
            if ((lastKet.value.trim() !== '' || lastFile.value) && rows.length < 10) {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 mt-1 foto-row';
                div.innerHTML = `
                <input type=\"text\" name=\"keterangan_foto[]\" maxlength=\"100\" class=\"block w-40 rounded-md border-gray-300 shadow-sm\" placeholder=\"Keterangan Foto\">
                <button type=\"button\" class=\"upload-foto-btn flex items-center justify-center w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full border border-gray-300\" title=\"Upload Foto\">\n<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5 text-gray-500\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12\" /></svg>\n</button>
                <input type=\"file\" name=\"foto[]\" accept=\"image/*\" class=\"hidden foto-input\">
                <img src=\"\" alt=\"Preview\" class=\"hidden w-32 h-32 object-cover rounded-md border border-gray-200 foto-preview\">
                <button type=\"button\" class=\"hapus-foto bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-10 h-10 flex items-center justify-center\" title=\"Hapus\">\n<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\" /></svg>\n</button>`;
                wrapper.appendChild(div);
                div.querySelector('input[type="text"]').addEventListener('input', addFotoRowIfNeeded);
                div.querySelector('input[type="file"]').addEventListener('change', function(e) {
                    addFotoRowIfNeeded();
                    handleFotoPreview(e);
                });
                div.querySelector('.upload-foto-btn').addEventListener('click', function(e) {
                    div.querySelector('input[type="file"]').click();
                });
                div.querySelector('.hapus-foto').addEventListener('click', function() {
                    div.remove();
                });
            }
        }
        // Preview foto
        function handleFotoPreview(e) {
            const input = e.target;
            const img = input.closest('.foto-row').querySelector('.foto-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    img.src = ev.target.result;
                    img.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                img.src = '';
                img.classList.add('hidden');
            }
        }
        // Event untuk input pertama
        document.querySelector('#foto-fields input[type="text"]').addEventListener('input', addFotoRowIfNeeded);
        document.querySelector('#foto-fields input[type="file"]').addEventListener('change', function(e) {
            addFotoRowIfNeeded();
            handleFotoPreview(e);
        });
        document.querySelector('#foto-fields .upload-foto-btn').addEventListener('click', function(e) {
            this.parentElement.querySelector('input[type="file"]').click();
        });
        // Event hapus untuk input dinamis foto
        document.getElementById('foto-fields').addEventListener('click', function(e) {
            if (e.target.classList.contains('hapus-foto')) {
                e.target.closest('.foto-row').remove();
            }
        });

        // Fetch kabupaten list from API
        fetch('/api/kabupaten-list')
            .then(response => response.json())
            .then(data => {
                const kabupatenSelect = document.getElementById('kabupaten');
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                data.forEach(kab => {
                    const option = document.createElement('option');
                    option.value = kab;
                    option.textContent = kab;
                    kabupatenSelect.appendChild(option);
                });
            });

        // Debug submit form
        document.getElementById('individuForm').addEventListener('submit', function(e) {
            console.log('Form submitted!');
            // Tampilkan semua data form yang akan dikirim
            const formData = new FormData(this);
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Trigger input file saat tombol diklik
        document.querySelectorAll('.upload-foto-btn').forEach((btn, index) => {
            btn.addEventListener('click', function () {
                const input = btn.parentElement.querySelector('.foto-input');
                input.click();
            });
        });

        // Preview gambar
        document.querySelectorAll('.foto-input').forEach((input) => {
            input.addEventListener('change', function () {
                const preview = input.parentElement.querySelector('.foto-preview');
                const file = input.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Tombol hapus
        document.querySelectorAll('.hapus-foto').forEach((btn) => {
            btn.addEventListener('click', function () {
                const row = btn.closest('.foto-row');
                row.remove();
            });
        });
    });
    </script>

@endsection
