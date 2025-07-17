@extends('layouts.superadmin-master')

@section('title', 'Input Data Individu TSK')

@section('content')
@include('components.superadmin-navbar')

@section('content')
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-8">
    <div class="bg-white overflow-hidden shadow rounded-xl p-6">
        <div class="mb-8 flex items-center gap-2 border-b pb-3">
            <i class="fas fa-user-plus text-blue-600 text-xl"></i>
            <h2 class="text-xl font-bold text-gray-800">Form Input Data Individu TSK</h2>
        </div>
        <form method="POST" action="{{ route('super-admin.data.individu.store') }}" class="space-y-8">
            @csrf
            {{-- Data Pribadi --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-id-card text-primary"></i>
                    <h3 class="font-semibold text-base text-primary">Data Pribadi</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-label for="nama_lengkap" value="Nama Lengkap" class="font-semibold" />
                        <x-input id="nama_lengkap" name="nama_lengkap" type="text" required autofocus class="mt-1 w-full" placeholder="Nama lengkap TSK" />
                    </div>
                    <div>
                        <x-label for="nik" value="NIK" class="font-semibold" />
                        <x-input id="nik" name="nik" type="text" maxlength="16" required class="mt-1 w-full" placeholder="Nomor Induk Kependudukan" />
                    </div>
                    <div>
                        <x-label for="tempat_lahir" value="Tempat Lahir" class="font-semibold" />
                        <x-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 w-full" placeholder="Tempat lahir" />
                    </div>
                    <div>
                        <x-label for="tanggal_lahir" value="Tanggal Lahir" class="font-semibold" />
                        <x-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 w-full" />
                    </div>
                    <div>
                        <x-label for="jenis_kelamin" value="Jenis Kelamin" class="font-semibold" />
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <x-label for="agama" value="Agama" class="font-semibold" />
                        <select name="agama" id="agama" class="form-select mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- Alamat --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-map-marker-alt text-green-600"></i>
                    <h3 class="font-semibold text-base text-green-700">Alamat</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-label for="kabupaten" value="Kabupaten/Kota" class="font-semibold" />
                        <select id="kabupaten" name="kabupaten" class="form-select mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Malang">Malang</option>
                            <option value="Sidoarjo">Sidoarjo</option>
                        </select>
                    </div>
                    <div>
                        <x-label for="kecamatan" value="Kecamatan" class="font-semibold" />
                        <select id="kecamatan" name="kecamatan" class="form-select mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <x-label for="desa_id" value="Desa/Kelurahan" class="font-semibold" />
                        <select id="desa" name="desa_id" class="form-select mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih Desa</option>
                        </select>
                    </div>
                    <div>
                        <x-label for="alamat_lengkap" value="Alamat Lengkap" class="font-semibold" />
                        <textarea name="alamat_lengkap" rows="2" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" placeholder="Alamat lengkap"></textarea>
                    </div>
                </div>
            </div>
            {{-- Data Kasus --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-balance-scale text-yellow-500"></i>
                    <h3 class="font-semibold text-base text-yellow-600">Data Kasus</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-label for="jenis_kasus" value="Jenis Kasus" class="font-semibold" />
                        <select name="jenis_kasus" id="jenis_kasus" class="form-select mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih</option>
                            <option value="Narkoba">Narkoba</option>
                            <option value="Narkotika">Narkotika</option>
                            <option value="Psikotropika">Psikotropika</option>
                            <option value="Prekursor">Prekursor</option>
                        </select>
                    </div>
                    <div>
                        <x-label for="status_kasus" value="Status Kasus" class="font-semibold" />
                        <select name="status_kasus" id="status_kasus" class="form-select mt-1 w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Batal">Batal</option>
                        </select>
                    </div>
                    <div>
                        <x-label for="tanggal_penangkapan" value="Tanggal Penangkapan" class="font-semibold" />
                        <x-input type="date" name="tanggal_penangkapan" id="tanggal_penangkapan" class="mt-1 w-full" />
                    </div>
                    <div>
                        <x-label for="lokasi_penangkapan" value="Lokasi Penangkapan" class="font-semibold" />
                        <x-input name="lokasi_penangkapan" id="lokasi_penangkapan" type="text" class="mt-1 w-full" placeholder="Lokasi penangkapan" />
                    </div>
                </div>
            </div>
            {{-- Keterangan Tambahan --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <i class="fas fa-info-circle text-sky-500"></i>
                    <h3 class="font-semibold text-base text-sky-600">Keterangan Tambahan</h3>
                </div>
                <textarea name="keterangan" id="keterangan" rows="3" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Masukkan keterangan tambahan jika diperlukan..."></textarea>
            </div>
            {{-- Tombol --}}
            <div class="flex flex-col md:flex-row justify-end gap-4 mt-8">
                <a href="{{ route('super-admin.input.index') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Batal
                </a>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold shadow">
                    <i class="fas fa-save mr-2"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
<script>
// Validasi Bootstrap
(function () {
    'use strict';
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
// Dynamic select (kabupaten -> kecamatan -> desa)
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('kabupaten').addEventListener('change', function() {
        const kabupaten = this.value;
        const kecamatanSelect = document.getElementById('kecamatan');
        const desaSelect = document.getElementById('desa');
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
        if (kabupaten) {
            const kecamatanOptions = {
                'Surabaya': ['Tegalsari', 'Genteng', 'Bubutan', 'Simokerto', 'Pabean Cantian'],
                'Malang': ['Klojen', 'Blimbing', 'Kedungkandang', 'Sukun', 'Lowokwaru'],
                'Sidoarjo': ['Tarik', 'Prambon', 'Krembung', 'Porong', 'Jabon']
            };
            const kecamatanList = kecamatanOptions[kabupaten] || [];
            kecamatanList.forEach(kecamatan => {
                const option = document.createElement('option');
                option.value = kecamatan;
                option.textContent = kecamatan;
                kecamatanSelect.appendChild(option);
            });
        }
    });
    document.getElementById('kecamatan').addEventListener('change', function() {
        const kecamatan = this.value;
        const desaSelect = document.getElementById('desa');
        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
        if (kecamatan) {
            const desaOptions = ['Desa A', 'Desa B', 'Desa C', 'Desa D', 'Desa E'];
            desaOptions.forEach(desa => {
                const option = document.createElement('option');
                option.value = desa;
                option.textContent = desa;
                desaSelect.appendChild(option);
            });
        }
    });
});
</script>
@endsection
