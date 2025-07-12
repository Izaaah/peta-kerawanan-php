@extends('layouts.superadmin-master')

@section('title', 'Tambah Data Individu TSK')

@section('content')
<div class="px-4 pt-2 pb-6">
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

    <div class="bg-white rounded-lg shadow p-8 max-w-5xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
            <div class="lg:col-span-5">
                <!-- Form Input -->
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
                            <!-- Input Dinamis Nomor Telepon -->
                            <div class="md:col-span-2" id="telepon-wrapper">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telepon</label>
                                <div id="telepon-fields">
                                    <div class="flex items-center gap-2 mt-1 telepon-row">
                                        <input type="number" name="telepon[]" maxlength="20" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Nomor Telepon">
                                    </div>
                                </div>
                            </div>
                            <!-- Input Dinamis No Rekening -->
                            <div class="md:col-span-2" id="rekening-wrapper">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. Rekening</label>
                                <div id="rekening-fields">
                                    <div class="flex items-center gap-2 mt-1 rekening-row">
                                        <input type="number" name="rekening[]" maxlength="30" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="No. Rekening">
                                    </div>
                                </div>
                            </div>
                            <!-- Input Dinamis No E-Wallet -->
                            <div class="md:col-span-2" id="ewallet-wrapper">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. E-Wallet</label>
                                <div id="ewallet-fields">
                                    <div class="flex items-center gap-2 mt-1 ewallet-row">
                                        <input type="number" name="ewallet[]" maxlength="30" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="No. E-Wallet">
                                    </div>
                                </div>
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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="kabupaten" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kabupaten</label>
                                    <select name="kabupaten" id="kabupaten" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kabupaten</option>
                                        @foreach($kabupatenList as $kabupaten)
                                            <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="kecamatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kecamatan</label>
                                    <select name="kecamatan" id="kecamatan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="kelurahan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kelurahan/Desa</label>
                                    <select name="kelurahan" id="kelurahan" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Kelurahan/Desa</option>
                                    </select>
                                </div>
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
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 text-xs">
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
        const kabupaten = document.getElementById('kabupaten').value;
        const kelurahanSelect = document.getElementById('kelurahan');
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

        if (kecamatan && kabupaten) {
            fetch(`/super-admin/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`)
                .then(response => response.json())
                .then(data => {
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
        const lastInput = rows[rows.length-1].querySelector('input');
        if (lastInput.value.trim() !== '' && rows.length < 10) {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 mt-1 telepon-row';
            div.innerHTML = `<input type="text" name="telepon[]" maxlength="20" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="Nomor Telepon">
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
        const lastInput = rows[rows.length-1].querySelector('input');
        if (lastInput.value.trim() !== '' && rows.length < 10) {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 mt-1 rekening-row';
            div.innerHTML = `<input type="number" name="rekening[]" maxlength="30" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="No. Rekening">
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
        const lastInput = rows[rows.length-1].querySelector('input');
        if (lastInput.value.trim() !== '' && rows.length < 10) {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 mt-1 ewallet-row';
            div.innerHTML = `<input type="number" name="ewallet[]" maxlength="30" class="block w-full rounded-md border-gray-300 shadow-sm" placeholder="No. E-Wallet">
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
});
</script>
@endsection
