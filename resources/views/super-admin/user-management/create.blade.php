@extends('layouts.superadmin-master')

@section('content')
@include('components.superadmin-navbar')

<div class="px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Tambah Data Individu TSK</h1>
            <p class="text-sm text-gray-500">Silakan lengkapi formulir berikut dengan data yang akurat.</p>
        </div>
        <a href="{{ route('super-admin.data.individu') }}" class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Input -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-blue-600 mb-4">Formulir Data Individu</h2>

                @if(session('error'))
                    <div class="bg-red-100 text-red-800 text-sm p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('super-admin.data.individu.store') }}" method="POST" id="individuForm">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK</label>
                            <input type="text" name="nik" id="nik" maxlength="16" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="nkk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor KK</label>
                            <input type="text" name="nkk" id="nkk" maxlength="16" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Pilih Status</option>
                                <option value="Napi">Napi</option>
                                <option value="Non napi">Non napi</option>
                            </select>
                        </div>
                        <div>
                            <label for="provinsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Provinsi</label>
                            <input type="text" name="provinsi" id="provinsi" value="Jawa Timur" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="kabupaten" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Pilih Kabupaten</option>
                                @foreach($kabupatenList as $kabupaten)
                                    <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelurahan/Desa</label>
                            <select name="kelurahan" id="kelurahan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" rows="2" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>
                        <div>
                            <label for="nama_ayah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Ayah</label>
                            <input type="text" name="nama_ayah" id="nama_ayah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="nik_ayah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK Ayah</label>
                            <input type="text" name="nik_ayah" id="nik_ayah" maxlength="16" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Ibu</label>
                            <input type="text" name="nama_ibu" id="nama_ibu" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="nik_ibu" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK Ibu</label>
                            <input type="text" name="nik_ibu" id="nik_ibu" maxlength="16" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="peran_jaringan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Peran dalam Jaringan</label>
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
                            <label for="jenis_narkotika" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Narkotika</label>
                            <input type="text" name="jenis_narkotika" id="jenis_narkotika" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label for="skala_kelas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Skala Kelas</label>
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
                            <label for="sumber_informasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sumber Informasi</label>
                            <select name="sumber_informasi" id="sumber_informasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Pilih Sumber</option>
                                <option value="informan">Informan</option>
                                <option value="analisa sosmed">Analisa Sosmed</option>
                                <option value="analisa aliran dana">Analisa Aliran Dana</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="modus_operasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Modus Operasi</label>
                            <textarea name="modus_operasi" id="modus_operasi" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="residivis" id="residivis" value="1" class="rounded">
                            <label for="residivis" class="text-sm text-gray-700 dark:text-gray-300">Residivis</label>
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
        <div>
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-blue-600 mb-4">Informasi Penting</h2>
                <div class="bg-blue-100 text-blue-800 text-sm p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        <li>Data akan terhubung dengan data kasus narkoba secara otomatis.</li>
                        <li>Pilih status "Napi" jika individu terlibat kasus.</li>
                        <li>Desa akan dipetakan berdasarkan kecamatan dan kelurahan.</li>
                    </ul>
                </div>
                <div class="bg-yellow-100 text-yellow-800 text-sm p-3 rounded">
                    <i class="fas fa-exclamation-triangle mr-1"></i> NIK harus unik dan tidak boleh duplikat.
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
            fetch(`/super-admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
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
        const kelurahanSelect = document.getElementById('kelurahan');
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

        if (kecamatan) {
            fetch(`/super-admin/api/desa-data?kecamatan=${encodeURIComponent(kecamatan)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.data) {
                        data.data.forEach(desa => {
                            const option = document.createElement('option');
                            option.value = desa.nama_desa;
                            option.textContent = desa.nama_desa;
                            kelurahanSelect.appendChild(option);
                        });
                    }
                });
        }
    });

    ['nik', 'nkk'].forEach(id => {
        document.getElementById(id)?.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 16);
        });
    });
});
</script>
@endsection
