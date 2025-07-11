@extends('layouts.superadmin-master')

@section('title', 'Input Data Individu TSK')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Input Data Individu TSK</h1>
                <a href="{{ route('super-admin.input.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-blue-800">Form untuk menambahkan data individu TSK (Tersangka) baru ke dalam sistem.</span>
                </div>
            </div>

            <form method="POST" action="{{ route('super-admin.data.individu.store') }}" class="space-y-6">
                @csrf

                <!-- Data Pribadi -->
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="nama_lengkap" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">NIK *</label>
                            <input type="text" name="nik" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                            <select name="agama" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Agama</option>
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

                <!-- Alamat -->
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Alamat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten/Kota</label>
                            <select name="kabupaten" id="kabupaten" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kabupaten/Kota</option>
                                <option value="Surabaya">Surabaya</option>
                                <option value="Malang">Malang</option>
                                <option value="Sidoarjo">Sidoarjo</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Desa/Kelurahan</label>
                            <select name="desa_id" id="desa" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Desa/Kelurahan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Data Kasus -->
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Kasus</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kasus</label>
                            <select name="jenis_kasus" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Jenis Kasus</option>
                                <option value="Narkoba">Narkoba</option>
                                <option value="Narkotika">Narkotika</option>
                                <option value="Psikotropika">Psikotropika</option>
                                <option value="Prekursor">Prekursor</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Kasus</label>
                            <select name="status_kasus" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Status</option>
                                <option value="Proses">Dalam Proses</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Batal">Dibatalkan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Penangkapan</label>
                            <input type="date" name="tanggal_penangkapan" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Penangkapan</label>
                            <input type="text" name="lokasi_penangkapan" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="bg-white p-6 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Keterangan Tambahan</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" rows="4" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan keterangan tambahan jika diperlukan..."></textarea>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('super-admin.input.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle kabupaten change
    document.getElementById('kabupaten').addEventListener('change', function() {
        const kabupaten = this.value;
        const kecamatanSelect = document.getElementById('kecamatan');
        const desaSelect = document.getElementById('desa');

        // Reset kecamatan and desa
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';

        if (kabupaten) {
            // Add kecamatan options based on kabupaten
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

    // Handle kecamatan change
    document.getElementById('kecamatan').addEventListener('change', function() {
        const kecamatan = this.value;
        const desaSelect = document.getElementById('desa');

        // Reset desa
        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';

        if (kecamatan) {
            // Add sample desa options (in real app, this would be fetched from API)
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
