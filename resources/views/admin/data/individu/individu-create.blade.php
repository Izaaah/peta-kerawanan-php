@extends('layouts.admin-master')

@section('title', 'Tambah Data Individu TSK')
@section('content')
    <div class="mx-auto px-4 py-3">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 light:text-white">Tambah Profil Individu</h1>
                <p class="text-sm text-gray-500">Silakan lengkapi formulir berikut dengan data yang akurat.</p>
            </div>
            <a href="{{ route('admin.data.individu') }}"
                class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="">
            <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
                <div class="lg:col-span-5">
                    <!-- Form Input -->
                    <div class="bg-white light:bg-gray-800 shadow rounded-lg p-6">
                        <h2 class="text-lg font-semibold text-blue-600 mb-4">Formulir Data Individu</h2>

                        @if (session('error'))
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

                        <form action="{{ route('admin.data.individu.store') }}" method="POST" id="individuForm"
                            enctype="multipart/form-data" onsubmit="return validateNik()">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-2 mb-4">
                                    <label for="nik" class="block text-base font-medium text-black">NIK <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="nik" id="nik" maxlength="16" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                        value="{{ old('nik') }}" pattern="[0-9]{16}"
                                        title="NIK harus berupa 16 digit angka">
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-sm text-gray-500">NIK harus berupa 16 digit angka</p>
                                        <p class="text-sm text-gray-400" id="nik-counter">0/16</p>
                                    </div>
                                    <!-- Loading notification -->
                                    <div id="nik-loading-notification"
                                        class="hidden mt-2 p-3 bg-blue-50 border border-blue-200 rounded-md">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg class="animate-spin h-5 w-5 text-blue-400"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-blue-700">Memeriksa NIK...</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Duplicate notification -->
                                    <div id="nik-duplicate-notification"
                                        class="hidden mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <h3 class="text-sm font-medium text-black">NIK Sudah Terdaftar</h3>
                                                <div class="mt-2 text-sm text-black">
                                                    <p id="duplicate-message"></p>
                                                    <div id="duplicate-data"
                                                        class="mt-2 text-xs bg-white p-2 rounded border"></div>
                                                </div>
                                                <div class="mt-3 flex space-x-2">
                                                    <button type="button" id="submit-for-verification"
                                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        <i class="fas fa-paper-plane mr-1"></i>
                                                        Kirim untuk Verifikasi Edit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Available NIK notification -->
                                    <div id="nik-available-notification"
                                        class="hidden mt-2 p-3 bg-green-50 border border-green-200 rounded-md">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <h3 class="text-sm font-medium text-green-800">NIK Belum Terdaftar</h3>
                                                <div class="mt-2 text-sm text-green-700">
                                                    <p>NIK ini belum terdaftar dalam sistem. Anda dapat melanjutkan mengisi
                                                        data.</p>
                                                </div>
                                                <div class="mt-3 flex space-x-2">
                                                    <button type="button" id="close-available-notification"
                                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-green-800 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                        <i class="fas fa-times mr-1"></i>
                                                        Tutup
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="nkk" class="block text-base font-medium text-black">Nomor Kartu
                                        Keluarga <span class="text-red-500">*</span></label>
                                    <input type="text" name="nkk" id="nkk" maxlength="16" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                        value="{{ old('nkk') }}" pattern="[0-9]{16}"
                                        title="Nomor KK harus berupa 16 digit angka">
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-sm text-gray-500">Nomor KK harus berupa 16 digit angka</p>
                                        <p class="text-sm text-gray-400" id="nkk-counter">0/16</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="jenis_kelamin" class="block text-base font-medium text-black">Jenis
                                        Kelamin <span class="text-red-500">*</span></label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                            Laki-laki (L)</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                            Perempuan (P)</option>
                                    </select>
                                </div>
                                <div class="md:col-span-2 mb-4">
                                    <label for="nama" class="block text-base font-medium text-black">Nama
                                        Lengkap</label>
                                    <input type="text" name="nama" id="nama" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base uppercase"
                                        value="{{ old('nama') }}">
                                </div>
                                <div class="mb-4">
                                    <label for="tempat_lahir" class="block text-base font-medium text-black">Tempat Lahir
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                        value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir">
                                </div>

                                <div class="mb-4">
                                    <label for="tgl_lahir" class="block text-base font-medium text-black">Tanggal Lahir
                                        <span class="text-red-500">*</span></label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                        value="{{ old('tgl_lahir') }}">
                                </div>
                                <!-- Input Dinamis Nomor Telepon -->
                                <div class="md:col-span-2 mb-4" id="telepon-wrapper">
                                    <div class="flex items-center justify-between mb-1">
                                        <label class="block text-base font-medium text-black">Nomor Telepon</label>
                                        <button type="button" id="tambah-telepon"
                                            class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                            <i class="fas fa-plus mr-1"></i>
                                            Tambah Telepon
                                        </button>
                                    </div>
                                    <div id="telepon-fields">
                                        <div class="flex items-center gap-2 mt-1 telepon-row">
                                            <input type="number" name="telepon[]" maxlength="20"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                                placeholder="Masukkan nomor telepon">
                                            <button type="button"
                                                class="hapus-telepon bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                title="Hapus Telepon">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Input Dinamis No Rekening -->
                                <div class="md:col-span-2 mb-4" id="rekening-wrapper">
                                    <div class="flex items-center justify-between mb-1">
                                        <label class="block text-base font-medium text-black">No. Rekening</label>
                                        <button type="button" id="tambah-rekening"
                                            class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                            <i class="fas fa-plus mr-1"></i>
                                            Tambah Rekening
                                        </button>
                                    </div>
                                    <div id="rekening-fields">
                                        <div class="flex items-center gap-2 mt-1 rekening-row">
                                            <input type="number" name="rekening[]" maxlength="30"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                                placeholder="Masukkan nomor rekening">
                                            <button type="button"
                                                class="hapus-rekening bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                title="Hapus Rekening">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Input Dinamis No E-Wallet -->
                                <div class="md:col-span-2 mb-4" id="ewallet-wrapper">
                                    <div class="flex items-center justify-between mb-1">
                                        <label class="block text-base font-medium text-black">No. E-Wallet</label>
                                        <button type="button" id="tambah-ewallet"
                                            class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                            <i class="fas fa-plus mr-1"></i>
                                            Tambah E-Wallet
                                        </button>
                                    </div>
                                    <div id="ewallet-fields">
                                        <div class="flex items-center gap-2 mt-1 ewallet-row">
                                            <input type="number" name="ewallet[]" maxlength="30"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                                placeholder="Masukkan nomor e-wallet">
                                            <button type="button"
                                                class="hapus-ewallet bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                title="Hapus E-Wallet">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label for="provinsi" class="block text-sm font-medium text-black">Provinsi</label>
                                    <select name="provinsi" id="provinsi" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="Jawa Timur" selected>Jawa Timur</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div id="wilayah-jatim">
                                    <div>
                                        <label for="kabupaten"
                                            class="block text-sm font-medium text-black   mb-1">Kabupaten</label>
                                        <select name="kabupaten" id="kabupaten"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Kabupaten</option>
                                            @if (isset($kabupatenList))
                                                @foreach ($kabupatenList as $kabupaten)
                                                    <option value="{{ $kabupaten }}"
                                                        {{ old('kabupaten') == $kabupaten ? 'selected' : '' }}>
                                                        {{ $kabupaten }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div>
                                        <label for="kecamatan"
                                            class="block text-sm font-medium text-black   mb-1">Kecamatan</label>
                                        <select name="kecamatan" id="kecamatan"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="kelurahan"
                                            class="block text-sm font-medium text-black   mb-1">Kelurahan/Desa</label>
                                        <select name="kelurahan" id="kelurahan"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Kelurahan/Desa</option>
                                        </select>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div id="wilayah-lainnya" class="hidden">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-black   mb-1">Provinsi</label>
                                            <input type="text" name="provinsi_lain" id="provinsi_lain"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                                placeholder="Provinsi">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-black   mb-1">Kabupaten</label>
                                            <input type="text" name="kabupaten_lain"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                                placeholder="Kabupaten">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-black   mb-1">Kecamatan</label>
                                            <input type="text" name="kecamatan_lain"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                                placeholder="Kecamatan">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-black   mb-1">Kelurahan/Desa</label>
                                            <input type="text" name="kelurahan_lain"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                                placeholder="Kelurahan/Desa">
                                        </div>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <label for="alamat" class="block text-sm font-medium text-black  ">Alamat
                                        Lengkap (Dusun/Jalan/RT/RW)</label>
                                    <textarea name="alamat" id="alamat" rows="2" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                                </div>
                                <div>
                                    <label for="nama_ayah" class="block text-sm font-medium text-black  ">Nama
                                        Ayah</label>
                                    <input type="text" name="nama_ayah" id="nama_ayah"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm uppercase">
                                </div>
                                <div>
                                    <label for="nik_ayah" class="block text-sm font-medium text-black  ">NIK
                                        Ayah</label>
                                    <input type="text" name="nik_ayah" id="nik_ayah" maxlength="16"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" pattern="[0-9]{16}"
                                        title="NIK Ayah harus berupa 16 digit angka">
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-sm text-gray-500">NIK harus berupa 16 digit angka</p>
                                        <p class="text-sm text-gray-400" id="nik-ayah-counter">0/16</p>
                                    </div>
                                </div>
                                <div>
                                    <label for="nama_ibu" class="block text-sm font-medium text-black  ">Nama
                                        Ibu</label>
                                    <input type="text" name="nama_ibu" id="nama_ibu"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm uppercase">
                                </div>
                                <div>
                                    <label for="nik_ibu" class="block text-sm font-medium text-black  ">NIK
                                        Ibu</label>
                                    <input type="text" name="nik_ibu" id="nik_ibu" maxlength="16"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" pattern="[0-9]{16}"
                                        title="NIK Ibu harus berupa 16 digit angka">
                                    <div class="mt-1 flex justify-between items-center">
                                        <p class="text-sm text-gray-500">NIK harus berupa 16 digit angka</p>
                                        <p class="text-sm text-gray-400" id="nik-ibu-counter">0/16</p>
                                    </div>
                                </div>
                                <!-- Input Dinamis Nama Keluarga Lain + NIK -->
                                <div class="md:col-span-2" id="keluarga-lain-wrapper">
                                    <div class="flex items-center justify-between mb-1">
                                        <label class="block text-sm font-medium text-black">Nama Keluarga Lain &
                                            NIK</label>
                                        <button type="button" id="tambah-keluarga-lain"
                                            class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                            <i class="fas fa-plus mr-1"></i>
                                            Tambah Keluarga
                                        </button>
                                    </div>
                                    <div id="keluarga-lain-fields">
                                        <div class="keluarga-lain-row mt-1">
                                            <div class="flex flex-col md:flex-row gap-2">
                                                <input type="text" name="nama_keluarga_lain[]" maxlength="100"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm uppercase"
                                                    placeholder="Nama Keluarga Lain">
                                                <div class="flex-1">
                                                    <input type="text" name="nik_keluarga_lain[]" maxlength="16"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm nik-keluarga-lain"
                                                        placeholder="NIK Keluarga Lain (16 digit)" pattern="[0-9]{16}"
                                                        title="NIK harus berupa 16 digit angka">
                                                    <p class="text-xs text-gray-500 mt-1">NIK harus 16 digit angka</p>
                                                </div>
                                                <button type="button"
                                                    class="hapus-keluarga-lain bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center self-start"
                                                    title="Hapus Keluarga">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="peran_jaringan" class="block text-sm font-medium text-black  ">Peran
                                        dalam Jaringan</label>
                                    <select name="peran_jaringan" id="peran_jaringan" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="">Pilih Peran</option>
                                        <option value="informan">Informan</option>
                                        <option value="kurir">Kurir</option>
                                        <option value="gudang">Gudang</option>
                                        <option value="bandar">Bandar</option>
                                        <option value="Penyalahguna">Penyalahguna</option>
                                        <option value="Korban Penyalahguna">Korban Penyalahguna</option>
                                        <option value="Pecandu">Pecandu</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="modus_operasi" class="block text-sm font-medium text-black  ">Modus
                                        Operandi/Uraian Singkat Peristiwa</label>
                                    <textarea name="modus_operasi" id="modus_operasi" rows="2"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                                </div>
                                <!-- Input Dinamis Jenis Narkotika -->
                                <div class="md:col-span-2" id="jenis-narkotika-wrapper">
                                    <label class="block text-sm font-medium text-black  ">Jenis Narkotika</label>
                                    <div id="jenis-narkotika-fields">
                                        <div class="flex items-center gap-2 mt-1 jenis-narkotika-row">
                                            <input type="text" name="jenis_narkotika[]"
                                                class="block w-full rounded-md border-gray-300 shadow-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="skala_kelas" class="block text-sm font-medium text-black  ">Jumlah
                                                Barang Bukti</label>
                                            <div class="flex items-center">
                                                <input type="text" id="angka" name="angka"
                                                    class="mt-1 block w-1/2 rounded-md border-gray-300 shadow-sm"
                                                    required />
                                                <select name="satuan" id="satuan"
                                                    class="mt-1 block w-1/2 rounded-md border-gray-300 shadow-sm ml-2"
                                                    required>
                                                    <option value="">Pilih Satuan</option>
                                                    <option value="Gram">Gram</option>
                                                    <option value="Ons">Ons</option>
                                                    <option value="Kg">Kg</option>
                                                    <option value="Ton">Ton</option>
                                                    <option value="Butir">Butir</option>
                                                    <option value="Batang">Batang</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="status"
                                                class="block text-sm font-medium text-black  ">Status</label>
                                            <select name="status" id="status" required
                                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm appearance-none">
                                                <option value="">Pilih Status</option>
                                                <option value="Voluntary">Voluntary (Sukarela)</option>
                                                <option value="Compulsary">Compulsary (Upaya Paksa)</option>
                                                <option value="Proses Hukum Lanjut">Proses Hukum Lanjut</option>
                                                <option value="Narapidana">Narapidana</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div id="voluntary-detail"
                                    class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200">
                                    <div class="mb-4">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">Nama IPWL</label>
                                            <a href="{{ route('admin.data.lrehab.create') }}"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors"
                                                target="_blank">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah Lembaga Rehabilitasi
                                            </a>
                                        </div>
                                        <div id="ipwl-container">
                                            <select name="ipwl_id" id="ipwl_id"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Pilih Lembaga IPWL</option>
                                                @if (isset($ipwlList) && $ipwlList->count() > 0)
                                                    @foreach ($ipwlList as $ipwl)
                                                        <option value="{{ $ipwl->id }}">{{ $ipwl->nama }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @if (!isset($ipwlList) || $ipwlList->count() == 0)
                                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                                                    <p class="text-sm text-yellow-800 mb-2">Belum ada lembaga
                                                        rehabilitasi dengan sertifikasi IPWL.</p>
                                                    <a href="{{ route('admin.data.lrehab.create') }}"
                                                        class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                                        <i class="fas fa-plus mr-1"></i>
                                                        Tambah Lembaga Rehabilitasi
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div id="compulsary-detail"
                                    class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200">


                                    <!-- Nomor Kasus Section -->
                                    <div class="mb-2" id="noKasus-wrapper">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">a. Nomor Kasus
                                                (LKN/LI/LP)</label>
                                            <button type="button" id="tambah-noKasus"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah LKN
                                            </button>
                                        </div>
                                        <div id="noKasus-fields">
                                            <div class="flex items-center gap-2 mt-1 noKasus-row">
                                                <input type="text" name="no_kasus[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="Masukkan nomor kasus">
                                                <button type="button"
                                                    class="hapus-noKasus bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus LKN">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tanggal Kasus Section -->
                                    <div class="mb-2" id="tgl-kasus-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">b. Tanggal
                                            Kasus</label>
                                        <div id="tgl-kasus-fields">
                                            <div class="flex items-center gap-2 mt-1 tgl-kasus-row">
                                                <input type="date" name="tanggal_kasus"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Satuan Kerja Section -->
                                    <div class="mb-2" id="satker-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">c. Satuan Kerja
                                            yang menangani</label>
                                        <div id="satker-fields">
                                            <div class="flex items-center gap-2 mt-1 satker-row">
                                                <input type="text" name="satuan_kerja"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="Masukkan satuan kerja">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- APH Section -->
                                    <div class="mb-2" id="aph-m-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">d. APH yang
                                            menangani</label>
                                        <div id="aph-m-fields">
                                            <div class="flex items-center gap-2 mt-1 aph-m-row">
                                                <input type="text" name="aph_menangani[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="Masukkan APH yang menangani">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pasal Section -->
                                    <div class="mb-2" id="pasal-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">e. Pasal yang
                                            disangkakan</label>
                                        <div id="pasal-fields">
                                            <div class="flex items-center gap-2 mt-1 pasal-row">
                                                <input type="text" name="pasal_disangkakan[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="Masukkan pasal yang disangkakan">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Search IPWL Section -->
                                    <div class="mb-4">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">f. Rekomendasi
                                                IPWL</label>
                                            <a href="{{ route('admin.data.lrehab.create') }}"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors"
                                                target="_blank">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah Lembaga Rehabilitasi
                                            </a>
                                        </div>
                                        <div id="ipwl-compulsary-container">
                                            <select name="ipwl_compulsary_id" id="ipwl_compulsary_id"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Pilih Lembaga IPWL</option>
                                                @if (isset($ipwlList) && $ipwlList->count() > 0)
                                                    @foreach ($ipwlList as $ipwl)
                                                        <option value="{{ $ipwl->id }}">{{ $ipwl->nama }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @if (!isset($ipwlList) || $ipwlList->count() == 0)
                                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                                                    <p class="text-sm text-yellow-800 mb-2">Belum ada lembaga
                                                        rehabilitasi dengan sertifikasi IPWL.</p>
                                                    <a href="{{ route('admin.data.lrehab.create') }}"
                                                        class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                                        <i class="fas fa-plus mr-1"></i>
                                                        Tambah Lembaga Rehabilitasi
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Rekomendasi Section -->
                                    <div class="mb-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <label class="block text-xs font-medium text-black">g.
                                                Rekomendasi</label>
                                            <button type="button" id="tambah-rekomendasi"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah Rekomendasi
                                            </button>
                                        </div>
                                        <div id="rekomendasi-fields">
                                            <div class="rekomendasi-row flex items-center gap-2 mt-1">
                                                <input type="text" name="rekomendasi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                    placeholder="Masukkan rekomendasi">
                                                <button type="button"
                                                    class="hapus-rekomendasi bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus Rekomendasi">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TKP Section -->
                                    <div class="mb-2" id="tkp-wrapper">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">h. TKP</label>
                                            <button type="button" id="tambah-tkp"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah TKP
                                            </button>
                                        </div>
                                        <div id="tkp-compulsary-fields">
                                            <div class="tkp-row space-y-2 mt-1">
                                                <select name="tkp_provinsi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-provinsi">
                                                    <option value="Jawa Timur">Jawa Timur</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                                <select name="tkp_kabupaten[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-kabupaten">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                    @foreach ($kabupatenList as $kabupaten)
                                                        <option value="{{ $kabupaten }}">{{ $kabupaten }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <select name="tkp_kecamatan[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-kecamatan">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                                <select name="tkp_desa[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-desa">
                                                    <option value="">Pilih Desa/Kelurahan</option>
                                                </select>
                                                <input type="text" name="tkp_lokasi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="Detail Lokasi (opsional)">
                                                <button type="button"
                                                    class="hapus-tkp-row bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center self-center"
                                                    title="Hapus TKP">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="prosesHukum-detail"
                                    class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200">
                                    <div class="mb-2" id="noKasus-prosesHukum-wrapper">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">a. Nomor Kasus
                                                (LKN/LI/LP)</label>
                                            <button type="button" id="tambah-noKasus-prosesHukum"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah LKN
                                            </button>
                                        </div>
                                        <div id="noKasus-prosesHukum-fields">
                                            <div class="flex items-center gap-2 mt-1 noKasus-prosesHukum-row">
                                                <input type="text" name="noKasus_prosesHukum[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="Masukkan nomor kasus">
                                                <button type="button"
                                                    class="hapus-noKasus-prosesHukum bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus LKN">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Putusan Pengadilan Section -->
                                    <div class="mb-4">
                                        <label class="block text-xs font-medium text-black mb-1">b. Putusan
                                            Pengadilan</label>
                                        <div id="putusan-pengadilan-fields">
                                            <div class="putusan-pengadilan-row flex items-center gap-2 mt-1">
                                                <input type="file" name="putusan_pengadilan[]"
                                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                                <button type="button"
                                                    class="hapus-putusan-pengadilan bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus File">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" id="tambah-putusan-pengadilan"
                                            class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                            <i class="fas fa-plus mr-1"></i>
                                            Tambah File Putusan
                                        </button>
                                    </div>

                                    <div class="mb-2" id="tgl-kasus-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">c. Tanggal
                                            Kasus</label>
                                        <div id="tgl-kasus-fields">
                                            <div class="flex items-center gap-2 mt-1 tgl-kasus-row">
                                                <input type="date" name="tgl-kasus"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="satker-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">c. Satuan Kerja
                                            yang menangani</label>
                                        <div id="satker-fields">
                                            <div class="flex items-center gap-2 mt-1 satker-row">
                                                <input type="text" name="satker"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="aph-m-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">d. APH yang
                                            menangani</label>
                                        <div id="aph-m-fields">
                                            <div class="flex items-center gap-2 mt-1 aph-m-row">
                                                <input type="text" name="aph_menangani[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="pasal-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">e. Pasal yang
                                            disangkakan</label>
                                        <div id="pasal-fields">
                                            <div class="flex items-center gap-2 mt-1 pasal-row">
                                                <input type="text" name="pasal_disangkakan[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="tkp-wrapper">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">f. TKP</label>
                                            <button type="button" id="tambah-tkp-prosesHukum"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah TKP
                                            </button>
                                        </div>
                                        <div id="tkp-prosesHukum-fields">
                                            <div class="tkp-row space-y-2 mt-1">
                                                <select name="tkp_provinsi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-provinsi">
                                                    <option value="Jawa Timur">Jawa Timur</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                                <select name="tkp_kabupaten[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-kabupaten">
                                                    <option value="">Kabupaten</option>
                                                    @foreach ($kabupatenList as $kabupaten)
                                                        <option value="{{ $kabupaten }}">{{ $kabupaten }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <select name="tkp_kecamatan[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-kecamatan">
                                                    <option value="">Kecamatan</option>
                                                </select>
                                                <select name="tkp_desa[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-desa">
                                                    <option value="">Desa/Kelurahan</option>
                                                </select>
                                                <input type="text" name="tkp_lokasi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="Detail Lokasi (opsional)">
                                                <button type="button"
                                                    class="hapus-tkp-row bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center self-center"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="narapidana-detail"
                                    class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200">
                                    <div class="mb-2" id="noKasus-narapidana-wrapper">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">a. Nomor Kasus
                                                (LKN/LI/LP)</label>
                                            <button type="button" id="tambah-noKasus-narapidana"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah LKN
                                            </button>
                                        </div>
                                        <div id="noKasus-narapidana-fields">
                                            <div class="flex items-center gap-2 mt-1 noKasus-narapidana-row">
                                                <input type="text" name="noKasus_narapidana[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="Masukkan nomor kasus">
                                                <button type="button"
                                                    class="hapus-noKasus-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus LKN">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="tgl-kasus-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">b. Tanggal
                                            Kasus</label>
                                        <div id="tgl-kasus-fields">
                                            <div class="flex items-center gap-2 mt-1 tgl-kasus-row">
                                                <input type="date" name="tgl-kasus"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="satker-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">c. Satuan Kerja
                                            yang menangani</label>
                                        <div id="satker-fields">
                                            <div class="flex items-center gap-2 mt-1 satker-row">
                                                <input type="text" name="satker"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="aph-m-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">d. APH yang
                                            menangani</label>
                                        <div id="aph-m-fields">
                                            <div class="flex items-center gap-2 mt-1 aph-m-row">
                                                <input type="text" name="aph_menangani[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="pasal-wrapper">
                                        <label class="block text-xs font-medium text-black mb-1">e. Pasal yang
                                            disangkakan</label>
                                        <div id="pasal-fields">
                                            <div class="flex items-center gap-2 mt-1 pasal-row">
                                                <input type="text" name="pasal_disangkakan[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="tkp-wrapper">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">f. TKP</label>
                                            <button type="button" id="tambah-tkp-narapidana"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah TKP
                                            </button>
                                        </div>
                                        <div id="tkp-narapidana-fields">
                                            <div class="tkp-row space-y-2 mt-1">
                                                <select name="tkp_provinsi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-provinsi">
                                                    <option value="Jawa Timur">Jawa Timur</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                                <select name="tkp_kabupaten[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-kabupaten">
                                                    <option value="">Kabupaten</option>
                                                    @foreach ($kabupatenList as $kabupaten)
                                                        <option value="{{ $kabupaten }}">{{ $kabupaten }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <select name="tkp_kecamatan[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-kecamatan">
                                                    <option value="">Kecamatan</option>
                                                </select>
                                                <select name="tkp_desa[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm tkp-desa">
                                                    <option value="">Desa/Kelurahan</option>
                                                </select>
                                                <input type="text" name="tkp_lokasi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    placeholder="Detail Lokasi (opsional)">
                                                <button type="button"
                                                    class="hapus-tkp-row bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center self-center"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pilihan Resisivis -->
                            <div class="md:col-span-2" id="residivis-wrapper">
                                <label class="block text-sm font-medium text-black mb-1">Residivis</label>
                                <div class="flex items-center gap-4 mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="residivis" value="1"
                                            class="form-radio text-blue-600" id="residivis-ya">
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="residivis" value="0"
                                            class="form-radio text-blue-600" id="residivis-tidak" checked>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                                <div id="residivis-detail"
                                    class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200">
                                    <div class="mb-4" id="file-wrapper">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">a. File Putusan
                                                Pengadilan</label>
                                            <button type="button" id="tambah-file-residivis"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah File
                                            </button>
                                        </div>
                                        <div id="file-fields">
                                            <div class="flex items-center gap-2 mt-1 file-residivis-row">
                                                <input type="file" name="file_residivis[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                                <button type="button"
                                                    class="hapus-file-residivis bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus File">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2" id="vonis-wrapper">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">b. Vonis Kasus
                                                Terakhir</label>
                                            <button type="button" id="tambah-vonis-residivis"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah Vonis
                                            </button>
                                        </div>
                                        <div id="vonis-fields">
                                            <div class="flex items-center gap-2 mt-1 vonis-residivis-row">
                                                <input type="text" name="vonis_residivis[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                                <button type="button"
                                                    class="hapus-vonis-residivis bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus Vonis">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="lapas-wrapper">
                                        <div class="flex items-center justify-between mb-1">
                                            <label class="block text-xs font-medium text-black">c. Lapas
                                                Akhir</label>
                                            <button type="button" id="tambah-lapas-residivis"
                                                class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                                <i class="fas fa-plus mr-1"></i>
                                                Tambah Lapas
                                            </button>
                                        </div>
                                        <div id="lapas-fields">
                                            <div class="flex items-center gap-2 mt-1 lapas-residivis-row">
                                                <input type="text" name="lapas_akhir_residivis[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm">
                                                <button type="button"
                                                    class="hapus-lapas-residivis bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus Lapas">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Input Dinamis Keterangan + Upload Foto (ikon upload saja) -->
                            <div class="md:col-span-2" id="foto-wrapper">
                                <label class="block text-sm font-medium text-black">Keterangan & Upload
                                    Foto</label>
                                <div id="foto-fields">
                                    <div class="flex items-center gap-2 mt-1 foto-row">
                                        <input type="text" name="keterangan_foto[]" maxlength="100"
                                            class="block w-40 rounded-md border-gray-300 shadow-sm"
                                            placeholder="Keterangan Foto">

                                        {{-- Tombol untuk memilih file --}}
                                        <button type="button"
                                            class="upload-foto-btn flex items-center justify-center w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-full border border-gray-300"
                                            title="Upload Foto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12" />
                                            </svg>
                                        </button>

                                        <input type="file" name="foto[]" accept="image/*" class="hidden foto-input">
                                        <img src="" alt="Preview"
                                            class="hidden w-32 h-32 object-cover rounded-md border border-gray-200 foto-preview">

                                        <button type="button"
                                            class="hapus-foto bg-red-100 hover:bg-red-200 text-red-600 rounded px-2 py-1 text-xs self-center">Hapus</button>
                                    </div>
                                </div>
                            </div>

                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <button type="reset"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-md">Reset</button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md inline-flex items-center">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                        {{-- <a href="{{ route('admin.data.individu') }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md inline-flex items-center">
                                    <i class="fas fa-save mr-2"></i> Simpan
                                </a> --}}
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
                    <div class="bg-yellow-50 text-black text-xs p-2 rounded flex items-center">
                        <i class="fas fa-exclamation-triangle mr-1"></i> <span class="ml-2">Jika NIK sudah
                            terdaftar,
                            maka akan ada tombol untuk verifikasi akses edit data ke super-admin.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle provinsi selection
            const provinsiSelect = document.getElementById('provinsi');
            const wilayahJatim = document.getElementById('wilayah-jatim');
            const wilayahLainnya = document.getElementById('wilayah-lainnya');

            provinsiSelect?.addEventListener('change', function() {
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

            if (kabupatenSelect && kecamatanSelect && kelurahanSelect) {
                kabupatenSelect.addEventListener('change', function() {
                    const kabupaten = this.value;
                    console.log('Kabupaten selected:', kabupaten); // Debug log
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                    if (kabupaten) {
                        const url = `/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`;
                        console.log('Fetching URL:', url); // Debug log

                        fetch(url)
                            .then(response => {
                                console.log('Response status:', response.status); // Debug log
                                if (!response.ok) {
                                    throw new Error(`Network response was not ok: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Kecamatan data received:', data); // Debug log
                                if (data && data.length > 0) {
                                    data.forEach(kecamatan => {
                                        const option = document.createElement('option');
                                        option.value = kecamatan;
                                        option.textContent = kecamatan;
                                        kecamatanSelect.appendChild(option);
                                    });
                                } else {
                                    console.warn('No kecamatan data found for:', kabupaten);
                                    // Try to fetch all kecamatan as fallback
                                    fetch('/admin/api/kecamatan-list')
                                        .then(response => response.json())
                                        .then(allData => {
                                            console.log('Fallback: All kecamatan data:', allData);
                                            if (allData && allData.length > 0) {
                                                allData.forEach(kecamatan => {
                                                    const option = document.createElement(
                                                        'option');
                                                    option.value = kecamatan;
                                                    option.textContent = kecamatan;
                                                    kecamatanSelect.appendChild(option);
                                                });
                                            } else {
                                                kecamatanSelect.innerHTML =
                                                    '<option value="">Tidak ada data kecamatan</option>';
                                            }
                                        })
                                        .catch(() => {
                                            kecamatanSelect.innerHTML =
                                                '<option value="">Tidak ada data kecamatan</option>';
                                        });
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching kecamatan:', error);
                                kecamatanSelect.innerHTML =
                                    '<option value="">Error loading kecamatan</option>';
                            });
                    }
                });

                // Handle kecamatan selection
                kecamatanSelect.addEventListener('change', function() {
                    const kabupaten = kabupatenSelect.value;
                    const kecamatan = this.value;
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                    if (kabupaten && kecamatan) {
                        fetch(
                                `/admin/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`
                            )
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                data.forEach(desa => {
                                    const option = document.createElement('option');
                                    option.value = desa;
                                    option.textContent = desa;
                                    kelurahanSelect.appendChild(option);
                                });
                            })
                            .catch(error => {
                                console.error('Error fetching desa:', error);
                                kelurahanSelect.innerHTML =
                                    '<option value="">Error loading desa</option>';
                            });
                    }
                });
            }

            // Fungsionalitas pencarian otomatis NIK
            let nikCheckTimeout;
            const nikInput = document.getElementById('nik');
            const loadingNotification = document.getElementById('nik-loading-notification');
            const duplicateNotification = document.getElementById('nik-duplicate-notification');
            const availableNotification = document.getElementById('nik-available-notification');
            const duplicateMessage = document.getElementById('duplicate-message');
            const duplicateData = document.getElementById('duplicate-data');
            const submitForVerificationBtn = document.getElementById('submit-for-verification');
            const closeAvailableBtn = document.getElementById('close-available-notification');
            const form = document.getElementById('individuForm');
            const nikCounter = document.getElementById('nik-counter');
            const nkkInput = document.getElementById('nkk');
            const nkkCounter = document.getElementById('nkk-counter');

            // Restrict input to numbers only
            nikInput.addEventListener('input', function() {
                // Remove any non-numeric characters
                this.value = this.value.replace(/[^0-9]/g, '');

                const nik = this.value.trim();

                // Update counter
                updateNikCounter(nik.length);

                if (nikCheckTimeout) {
                    clearTimeout(nikCheckTimeout);
                }

                if (nik.length === 0) {
                    hideAllNotifications();
                    return;
                }

                // Show loading immediately when 16 digits are reached
                if (nik.length === 16) {
                    showLoadingNotification();
                    checkNikDuplicate(nik);
                } else if (nik.length < 16) {
                    hideAllNotifications();
                }
            });

            // Restrict NKK input to numbers only
            nkkInput.addEventListener('input', function() {
                // Remove any non-numeric characters
                this.value = this.value.replace(/[^0-9]/g, '');

                const nkk = this.value.trim();

                // Update counter
                updateNkkCounter(nkk.length);
            });

            // Prevent non-numeric input on keypress for NIK
            nikInput.addEventListener('keypress', function(e) {
                // Allow: backspace, delete, tab, escape, enter
                if ([46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
                    // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                    (e.keyCode === 65 && e.ctrlKey === true) ||
                    (e.keyCode === 67 && e.ctrlKey === true) ||
                    (e.keyCode === 86 && e.ctrlKey === true) ||
                    (e.keyCode === 88 && e.ctrlKey === true)) {
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode >
                        105)) {
                    e.preventDefault();
                }
            });

            // Prevent non-numeric input on keypress for NKK
            nkkInput.addEventListener('keypress', function(e) {
                // Allow: backspace, delete, tab, escape, enter
                if ([46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
                    // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                    (e.keyCode === 65 && e.ctrlKey === true) ||
                    (e.keyCode === 67 && e.ctrlKey === true) ||
                    (e.keyCode === 86 && e.ctrlKey === true) ||
                    (e.keyCode === 88 && e.ctrlKey === true)) {
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode >
                        105)) {
                    e.preventDefault();
                }
            });

            function checkNikDuplicate(nik) {
                fetch(`/admin/api/check-nik?nik=${encodeURIComponent(nik)}`)
                    .then(response => response.json())
                    .then(data => {
                        hideLoadingNotification();
                        if (data.exists) {
                            showDuplicateNotification(data);
                        } else {
                            showAvailableNotification();
                        }
                    })
                    .catch(error => {
                        console.error('Error checking NIK:', error);
                        hideLoadingNotification();
                        hideAllNotifications();
                    });
            }

            function showDuplicateNotification(data) {
                duplicateMessage.textContent = data.message;

                const existingData = data.data;
                duplicateData.innerHTML = `
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div><strong>Nama:</strong> ${existingData.nama}</div>
                <div><strong>NIK:</strong> ${existingData.nik}</div>
                <div><strong>NKK:</strong> ${existingData.nkk}</div>
                <div><strong>Status:</strong> ${existingData.status}</div>
                <div><strong>Peran:</strong> ${existingData.peran_jaringan}</div>
                <div><strong>Residivis:</strong> ${existingData.residivis ? 'Ya' : 'Tidak'}</div>
                <div><strong>Alamat:</strong> ${existingData.alamat}</div>
                <div><strong>Lokasi:</strong> ${existingData.kecamatan}, ${existingData.kabupaten}</div>
            </div>
        `;

                duplicateNotification.classList.remove('hidden');
                duplicateNotification.dataset.existingData = JSON.stringify(data.data);

                // Menghapus required fields jika NIK terduplikasi
                const fieldsToUnrequire = [
                    'nama', 'nkk', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'provinsi',
                    'kabupaten', 'kecamatan', 'kelurahan', 'alamat', 'peran_jaringan', 'status',
                    'angka', 'satuan'
                ];

                fieldsToUnrequire.forEach(function(fieldId) {
                    const field = document.getElementById(fieldId);
                    if (field) {
                        field.removeAttribute('required'); // Hapus atribut required
                    }
                });
            }

            function hideDuplicateNotification() {
                duplicateNotification.classList.add('hidden');
                delete duplicateNotification.dataset.existingData;
            }

            function showLoadingNotification() {
                hideAllNotifications();
                loadingNotification.classList.remove('hidden');
            }

            function hideLoadingNotification() {
                loadingNotification.classList.add('hidden');
            }

            function showAvailableNotification() {
                hideAllNotifications();
                availableNotification.classList.remove('hidden');
                // Pastikan field tetap required untuk NIK yang tidak duplikat
                restoreRequiredFields();
            }

            function hideAvailableNotification() {
                availableNotification.classList.add('hidden');
            }

            function hideAllNotifications() {
                loadingNotification.classList.add('hidden');
                duplicateNotification.classList.add('hidden');
                availableNotification.classList.add('hidden');
                delete duplicateNotification.dataset.existingData;

                // Mengembalikan required fields jika NIK tidak duplikat
                restoreRequiredFields();
            }

            function restoreRequiredFields() {
                const fieldsToRequire = [
                    'nama', 'nkk', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'provinsi',
                    'kabupaten', 'kecamatan', 'kelurahan', 'alamat', 'peran_jaringan', 'status',
                    'angka', 'satuan'
                ];

                fieldsToRequire.forEach(function(fieldId) {
                    const field = document.getElementById(fieldId);
                    if (field) {
                        field.setAttribute('required', 'required');
                    }
                });
            }

            // Update NIK counter
            function updateNikCounter(length) {
                nikCounter.textContent = `${length}/16`;

                if (length === 16) {
                    nikCounter.className = 'text-sm text-green-600 font-medium';
                } else if (length > 0) {
                    nikCounter.className = 'text-sm text-blue-600 font-medium';
                } else {
                    nikCounter.className = 'text-sm text-gray-400';
                }
            }

            // Update NKK counter
            function updateNkkCounter(length) {
                nkkCounter.textContent = `${length}/16`;

                if (length === 16) {
                    nkkCounter.className = 'text-sm text-green-600 font-medium';
                } else if (length > 0) {
                    nkkCounter.className = 'text-sm text-blue-600 font-medium';
                } else {
                    nkkCounter.className = 'text-sm text-gray-400';
                }
            }

            // Validasi dan counter untuk NIK Ayah
            const nikAyahInput = document.getElementById('nik_ayah');
            const nikAyahCounter = document.getElementById('nik-ayah-counter');

            if (nikAyahInput && nikAyahCounter) {
                nikAyahInput.addEventListener('input', function() {
                    // Remove any non-numeric characters
                    this.value = this.value.replace(/[^0-9]/g, '');

                    const length = this.value.trim().length;
                    nikAyahCounter.textContent = `${length}/16`;

                    if (length === 16) {
                        nikAyahCounter.className = 'text-sm text-green-600 font-medium';
                    } else if (length > 0) {
                        nikAyahCounter.className = 'text-sm text-blue-600 font-medium';
                    } else {
                        nikAyahCounter.className = 'text-sm text-gray-400';
                    }
                });

                // Prevent non-numeric input on keypress for NIK Ayah
                nikAyahInput.addEventListener('keypress', function(e) {
                    if ([46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
                        (e.keyCode === 65 && e.ctrlKey === true) ||
                        (e.keyCode === 67 && e.ctrlKey === true) ||
                        (e.keyCode === 86 && e.ctrlKey === true) ||
                        (e.keyCode === 88 && e.ctrlKey === true)) {
                        return;
                    }
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode >
                            105)) {
                        e.preventDefault();
                    }
                });
            }

            // Validasi dan counter untuk NIK Ibu
            const nikIbuInput = document.getElementById('nik_ibu');
            const nikIbuCounter = document.getElementById('nik-ibu-counter');

            if (nikIbuInput && nikIbuCounter) {
                nikIbuInput.addEventListener('input', function() {
                    // Remove any non-numeric characters
                    this.value = this.value.replace(/[^0-9]/g, '');

                    const length = this.value.trim().length;
                    nikIbuCounter.textContent = `${length}/16`;

                    if (length === 16) {
                        nikIbuCounter.className = 'text-sm text-green-600 font-medium';
                    } else if (length > 0) {
                        nikIbuCounter.className = 'text-sm text-blue-600 font-medium';
                    } else {
                        nikIbuCounter.className = 'text-sm text-gray-400';
                    }
                });

                // Prevent non-numeric input on keypress for NIK Ibu
                nikIbuInput.addEventListener('keypress', function(e) {
                    if ([46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
                        (e.keyCode === 65 && e.ctrlKey === true) ||
                        (e.keyCode === 67 && e.ctrlKey === true) ||
                        (e.keyCode === 86 && e.ctrlKey === true) ||
                        (e.keyCode === 88 && e.ctrlKey === true)) {
                        return;
                    }
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode >
                            105)) {
                        e.preventDefault();
                    }
                });
            }

            // Event delegation untuk validasi NIK Keluarga Lain (dinamis)
            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('nik-keluarga-lain')) {
                    // Remove any non-numeric characters
                    e.target.value = e.target.value.replace(/[^0-9]/g, '');
                }
            });

            document.addEventListener('keypress', function(e) {
                if (e.target.classList.contains('nik-keluarga-lain')) {
                    if ([46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
                        (e.keyCode === 65 && e.ctrlKey === true) ||
                        (e.keyCode === 67 && e.ctrlKey === true) ||
                        (e.keyCode === 86 && e.ctrlKey === true) ||
                        (e.keyCode === 88 && e.ctrlKey === true)) {
                        return;
                    }
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode >
                            105)) {
                        e.preventDefault();
                    }
                }
            });

            // Validate NIK and NKK before form submission
            function validateNik() {
                const nik = nikInput.value.trim();
                const nkk = nkkInput.value.trim();

                // Validate NIK
                if (nik.length !== 16) {
                    alert('NIK harus berupa 16 digit angka');
                    nikInput.focus();
                    return false;
                }

                if (!/^[0-9]{16}$/.test(nik)) {
                    alert('NIK hanya boleh berisi angka');
                    nikInput.focus();
                    return false;
                }

                // Validate NKK
                if (nkk.length !== 16) {
                    alert('Nomor KK harus berupa 16 digit angka');
                    nkkInput.focus();
                    return false;
                }

                if (!/^[0-9]{16}$/.test(nkk)) {
                    alert('Nomor KK hanya boleh berisi angka');
                    nkkInput.focus();
                    return false;
                }

                return true;
            }

            // Menangani tombol kirim untuk verifikasi
            submitForVerificationBtn.addEventListener('click', function(event) {
                event.preventDefault();

                // Pastikan form tidak dikirim jika NIK duplikat
                if (duplicateNotification.classList.contains('hidden')) {
                    alert('NIK tidak terdaftar, mohon periksa kembali!');
                    return; // Jika NIK tidak ditemukan, form tidak dikirim
                }

                // Mengambil data yang ada untuk verifikasi
                const existingData = JSON.parse(duplicateNotification.dataset.existingData || '{}');
                const formData = new FormData(form);

                // Menambahkan data yang ada untuk verifikasi
                formData.append('existing_data', JSON.stringify(existingData));
                formData.append('submit_for_verification', '1');

                // Menambahkan CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                console.log('CSRF Token:', csrfToken); // Debug log
                formData.append('_token', csrfToken);

                // Show loading state
                submitForVerificationBtn.disabled = true;
                submitForVerificationBtn.innerHTML =
                    '<i class="fas fa-spinner fa-spin mr-1"></i> Mengirim...';

                // Kirim form untuk verifikasi
                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                        }
                    })
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            // Show success message and redirect
                            alert(
                                'Permintaan verifikasi edit telah dikirim ke Super Admin. Data akan ditinjau dan diproses.'
                            );
                            window.location.href = data.redirect || '/admin/data/individu';
                        } else {
                            // Handle errors
                            alert(data.message ||
                                'Terjadi kesalahan saat mengirim permintaan verifikasi edit.');
                        }
                    })
                    .catch(error => {
                        console.error('Error details:', error);
                        alert('Terjadi kesalahan: ' + error.message + '. Silakan coba lagi.');
                    })
                    .finally(() => {
                        // Restore button state
                        submitForVerificationBtn.disabled = false;
                        submitForVerificationBtn.innerHTML =
                            '<i class="fas fa-paper-plane mr-1"></i> Kirim untuk Verifikasi';
                    });
            });

            // Menangani tombol close notifikasi available
            closeAvailableBtn.addEventListener('click', function() {
                hideAvailableNotification();
            });

            // Note: clearNikBtn functionality removed as element doesn't exist


            // Initialize provinsi selection on page load
            if (provinsiSelect && provinsiSelect.value === 'lainnya') {
                wilayahJatim.classList.add('hidden');
                wilayahLainnya.classList.remove('hidden');
            }

            // Handle TKP dropdown functionality
            // Event delegation for TKP kabupaten changes
            document.addEventListener('change', function(e) {
                console.log('Event triggered on:', e.target); // Debug log
                console.log('Event target classes:', e.target.classList); // Debug log

                if (e.target.classList.contains('tkp-kabupaten')) {
                    console.log('TKP kabupaten change detected!'); // Debug log
                    const kabupaten = e.target.value;
                    console.log('TKP Kabupaten selected:', kabupaten); // Debug log

                    const tkpRow = e.target.closest('.tkp-row');
                    console.log('TKP Row found:', tkpRow); // Debug log

                    const kecamatanSelect = tkpRow.querySelector('.tkp-kecamatan');
                    const desaSelect = tkpRow.querySelector('.tkp-desa');

                    console.log('Kecamatan select element:', kecamatanSelect); // Debug log
                    console.log('Desa select element:', desaSelect); // Debug log

                    // Clear kecamatan and desa options
                    if (kecamatanSelect) {
                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    }
                    if (desaSelect) {
                        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                    }

                    if (kabupaten) {
                        const url = `/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`;
                        console.log('TKP Fetching URL:', url); // Debug log

                        fetch(url)
                            .then(response => {
                                console.log('TKP Response status:', response.status); // Debug log
                                if (!response.ok) {
                                    throw new Error(`Network response was not ok: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('TKP Kecamatan data received:', data); // Debug log
                                if (data && data.length > 0) {
                                    data.forEach(kecamatan => {
                                        const option = document.createElement('option');
                                        option.value = kecamatan;
                                        option.textContent = kecamatan;
                                        if (kecamatanSelect) {
                                            kecamatanSelect.appendChild(option);
                                        }
                                    });
                                    console.log('TKP Options added to kecamatan select'); // Debug log
                                } else {
                                    console.warn('TKP No kecamatan data found for:', kabupaten);
                                    if (kecamatanSelect) {
                                        kecamatanSelect.innerHTML =
                                            '<option value="">Tidak ada data kecamatan</option>';
                                    }
                                }
                            })
                            .catch(error => {
                                console.error('TKP Error fetching kecamatan:', error);
                                if (kecamatanSelect) {
                                    kecamatanSelect.innerHTML =
                                        '<option value="">Error loading kecamatan</option>';
                                }
                            });
                    }
                }
            });

            // Event delegation for TKP kecamatan changes
            document.addEventListener('change', function(e) {
                console.log('TKP Kecamatan event triggered on:', e.target); // Debug log

                if (e.target.classList.contains('tkp-kecamatan')) {
                    console.log('TKP kecamatan change detected!'); // Debug log
                    const tkpRow = e.target.closest('.tkp-row');
                    const kabupatenSelect = tkpRow.querySelector('.tkp-kabupaten');
                    const kabupaten = kabupatenSelect.value;
                    const kecamatan = e.target.value;
                    const desaSelect = tkpRow.querySelector('.tkp-desa');

                    console.log('TKP Kabupaten:', kabupaten, 'Kecamatan:', kecamatan); // Debug log
                    console.log('TKP Desa select element:', desaSelect); // Debug log

                    // Clear desa options
                    if (desaSelect) {
                        desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                    }

                    if (kabupaten && kecamatan) {
                        const url =
                            `/admin/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`;
                        console.log('TKP Desa Fetching URL:', url); // Debug log

                        fetch(url)
                            .then(response => {
                                console.log('TKP Desa Response status:', response.status); // Debug log
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('TKP Desa data received:', data); // Debug log
                                if (data && data.length > 0) {
                                    data.forEach(desa => {
                                        const option = document.createElement('option');
                                        option.value = desa;
                                        option.textContent = desa;
                                        if (desaSelect) {
                                            desaSelect.appendChild(option);
                                        }
                                    });
                                    console.log('TKP Desa options added'); // Debug log
                                } else {
                                    console.warn('TKP No desa data found');
                                    if (desaSelect) {
                                        desaSelect.innerHTML =
                                            '<option value="">Tidak ada data desa</option>';
                                    }
                                }
                            })
                            .catch(error => {
                                console.error('TKP Error fetching desa:', error);
                                if (desaSelect) {
                                    desaSelect.innerHTML =
                                        '<option value="">Error loading desa</option>';
                                }
                            });
                    }
                }
            });
        });

        // Test API endpoint
        console.log('Testing API endpoint...');
        fetch('/admin/api/kecamatan-list?kabupaten=Kediri')
            .then(response => {
                console.log('API Test Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('API Test Data received:', data);
            })
            .catch(error => {
                console.error('API Test Error:', error);
            });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trigger input file saat tombol diklik
            document.querySelectorAll('.upload-foto-btn').forEach((btn, index) => {
                btn.addEventListener('click', function() {
                    const input = btn.parentElement.querySelector('.foto-input');
                    input.click();
                });
            });

            // Preview gambar
            document.querySelectorAll('.foto-input').forEach((input) => {
                input.addEventListener('change', function() {
                    const preview = input.parentElement.querySelector('.foto-preview');
                    const file = input.files[0];

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });

            // Tombol hapus
            document.querySelectorAll('.hapus-foto').forEach((btn) => {
                btn.addEventListener('click', function() {
                    const row = btn.closest('.foto-row');
                    row.remove();
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Ambil elemen radio button "Ya" dan "Tidak"
            const residivisYa = document.getElementById('residivis-ya');
            const residivisTidak = document.getElementById('residivis-tidak');
            const residivisDetail = document.getElementById('residivis-detail');

            // Tambahkan event listener untuk perubahan pada radio button
            residivisYa.addEventListener('change', function() {
                if (residivisYa.checked) {
                    // Tampilkan elemen residivis-detail jika "Ya" dipilih
                    residivisDetail.classList.remove('hidden');
                }
            });

            residivisTidak.addEventListener('change', function() {
                if (residivisTidak.checked) {
                    // Sembunyikan elemen residivis-detail jika "Tidak" dipilih
                    residivisDetail.classList.add('hidden');
                }
            });

            // Inisialisasi: Jika radio button "Tidak" sudah terpilih, sembunyikan residivis-detail
            if (residivisTidak.checked) {
                residivisDetail.classList.add('hidden');
            }

            const voluntaryTrue = document.getElementById('voluntary-true');
            const compulsaryTrue = document.getElementById('compulsary-true');
            const proserHukumTrue = document.getElementById('prosesHukum-true');
            const narapidanaTrue = document.getElementById('narapidana-true');

            const statusSelect = document.getElementById('status');
            const voluntaryDetail = document.getElementById('voluntary-detail');
            const compulsaryDetail = document.getElementById('compulsary-detail');
            const prosesHukumDetail = document.getElementById('prosesHukum-detail');
            const narapidanaDetail = document.getElementById('narapidana-detail');

            // Event listener untuk perubahan pada elemen select (status)
            statusSelect.addEventListener('change', function() {
                const selectedValue = this.value;

                // Sembunyikan semua detail terlebih dahulu
                voluntaryDetail.classList.add('hidden');
                compulsaryDetail.classList.add('hidden');
                prosesHukumDetail.classList.add('hidden');
                narapidanaDetail.classList.add('hidden');

                // Tampilkan detail sesuai dengan status yang dipilih
                if (selectedValue === 'Voluntary') {
                    voluntaryDetail.classList.remove('hidden');
                } else if (selectedValue === 'Compulsary') {
                    compulsaryDetail.classList.remove('hidden');
                } else if (selectedValue === 'Proses Hukum Lanjut') {
                    prosesHukumDetail.classList.remove('hidden');
                } else if (selectedValue === 'Narapidana') {
                    narapidanaDetail.classList.remove('hidden');
                }
            });

        });

        // JavaScript untuk Telepon, Rekening, dan E-Wallet
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah Telepon
            document.getElementById('tambah-telepon')?.addEventListener('click', function() {
                const container = document.getElementById('telepon-fields');
                const newRow = document.createElement('div');
                newRow.className = 'flex items-center gap-2 mt-1 telepon-row';
                newRow.innerHTML = `
                    <input type="number" name="telepon[]" maxlength="20"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                        placeholder="Masukkan nomor telepon">
                    <button type="button"
                        class="hapus-telepon bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus Telepon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus Telepon (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-telepon')) {
                    const row = e.target.closest('.telepon-row');
                    if (row && document.querySelectorAll('.telepon-row').length > 1) {
                        row.remove();
                    }
                }
            });

            // Tambah Rekening
            document.getElementById('tambah-rekening')?.addEventListener('click', function() {
                const container = document.getElementById('rekening-fields');
                const newRow = document.createElement('div');
                newRow.className = 'flex items-center gap-2 mt-1 rekening-row';
                newRow.innerHTML = `
                    <input type="number" name="rekening[]" maxlength="30"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                        placeholder="Masukkan nomor rekening">
                    <button type="button"
                        class="hapus-rekening bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus Rekening">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus Rekening (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-rekening')) {
                    const row = e.target.closest('.rekening-row');
                    if (row && document.querySelectorAll('.rekening-row').length > 1) {
                        row.remove();
                    }
                }
            });

            // Tambah E-Wallet
            document.getElementById('tambah-ewallet')?.addEventListener('click', function() {
                const container = document.getElementById('ewallet-fields');
                const newRow = document.createElement('div');
                newRow.className = 'flex items-center gap-2 mt-1 ewallet-row';
                newRow.innerHTML = `
                    <input type="number" name="ewallet[]" maxlength="30"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                        placeholder="Masukkan nomor e-wallet">
                    <button type="button"
                        class="hapus-ewallet bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus E-Wallet">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus E-Wallet (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-ewallet')) {
                    const row = e.target.closest('.ewallet-row');
                    if (row && document.querySelectorAll('.ewallet-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk Rekomendasi
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah Rekomendasi
            document.getElementById('tambah-rekomendasi')?.addEventListener('click', function() {
                const container = document.getElementById('rekomendasi-fields');
                const newRow = document.createElement('div');
                newRow.className = 'rekomendasi-row flex items-center gap-2 mt-1';
                newRow.innerHTML = `
                    <input type="text" name="rekomendasi[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan rekomendasi">
                    <button type="button"
                        class="hapus-rekomendasi bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus Rekomendasi">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus Rekomendasi (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-rekomendasi')) {
                    const row = e.target.closest('.rekomendasi-row');
                    if (row && document.querySelectorAll('.rekomendasi-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk Putusan Pengadilan
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah File Putusan Pengadilan
            document.getElementById('tambah-putusan-pengadilan')?.addEventListener('click', function() {
                const container = document.getElementById('putusan-pengadilan-fields');
                const newRow = document.createElement('div');
                newRow.className = 'putusan-pengadilan-row flex items-center gap-2 mt-1';
                newRow.innerHTML = `
                    <input type="file" name="putusan_pengadilan[]"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <button type="button"
                        class="hapus-putusan-pengadilan bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus File">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus File Putusan Pengadilan (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-putusan-pengadilan')) {
                    const row = e.target.closest('.putusan-pengadilan-row');
                    if (row && document.querySelectorAll('.putusan-pengadilan-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk Nomor Kasus (LKN) - Compulsary
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah Nomor Kasus Compulsary
            document.getElementById('tambah-noKasus')?.addEventListener('click', function() {
                const container = document.getElementById('noKasus-fields');
                const newRow = document.createElement('div');
                newRow.className = 'noKasus-row flex items-center gap-2 mt-1';
                newRow.innerHTML = `
                    <input type="text" name="no_kasus[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm"
                        placeholder="Masukkan nomor kasus">
                    <button type="button"
                        class="hapus-noKasus bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus LKN">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus Nomor Kasus Compulsary (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-noKasus')) {
                    const row = e.target.closest('.noKasus-row');
                    if (row && document.querySelectorAll('.noKasus-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk Nomor Kasus (LKN) - Proses Hukum
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah Nomor Kasus Proses Hukum
            document.getElementById('tambah-noKasus-prosesHukum')?.addEventListener('click', function() {
                const container = document.getElementById('noKasus-prosesHukum-fields');
                const newRow = document.createElement('div');
                newRow.className = 'noKasus-prosesHukum-row flex items-center gap-2 mt-1';
                newRow.innerHTML = `
                    <input type="text" name="noKasus_prosesHukum[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm"
                        placeholder="Masukkan nomor kasus">
                    <button type="button"
                        class="hapus-noKasus-prosesHukum bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus LKN">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus Nomor Kasus Proses Hukum (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-noKasus-prosesHukum')) {
                    const row = e.target.closest('.noKasus-prosesHukum-row');
                    if (row && document.querySelectorAll('.noKasus-prosesHukum-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk Nomor Kasus (LKN) - Narapidana
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah Nomor Kasus Narapidana
            document.getElementById('tambah-noKasus-narapidana')?.addEventListener('click', function() {
                const container = document.getElementById('noKasus-narapidana-fields');
                const newRow = document.createElement('div');
                newRow.className = 'noKasus-narapidana-row flex items-center gap-2 mt-1';
                newRow.innerHTML = `
                    <input type="text" name="noKasus_narapidana[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm"
                        placeholder="Masukkan nomor kasus">
                    <button type="button"
                        class="hapus-noKasus-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus LKN">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus Nomor Kasus Narapidana (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-noKasus-narapidana')) {
                    const row = e.target.closest('.noKasus-narapidana-row');
                    if (row && document.querySelectorAll('.noKasus-narapidana-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk Residivis - File Putusan
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah File Residivis
            document.getElementById('tambah-file-residivis')?.addEventListener('click', function() {
                const container = document.getElementById('file-fields');
                const newRow = document.createElement('div');
                newRow.className = 'file-residivis-row flex items-center gap-2 mt-1';
                newRow.innerHTML = `
                    <input type="file" name="file_residivis[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm">
                    <button type="button"
                        class="hapus-file-residivis bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus File">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus File Residivis (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-file-residivis')) {
                    const row = e.target.closest('.file-residivis-row');
                    if (row && document.querySelectorAll('.file-residivis-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk Residivis - Vonis
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah Vonis Residivis
            document.getElementById('tambah-vonis-residivis')?.addEventListener('click', function() {
                const container = document.getElementById('vonis-fields');
                const newRow = document.createElement('div');
                newRow.className = 'vonis-residivis-row flex items-center gap-2 mt-1';
                newRow.innerHTML = `
                    <input type="text" name="vonis_residivis[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm"
                        placeholder="Masukkan vonis">
                    <button type="button"
                        class="hapus-vonis-residivis bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus Vonis">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus Vonis Residivis (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-vonis-residivis')) {
                    const row = e.target.closest('.vonis-residivis-row');
                    if (row && document.querySelectorAll('.vonis-residivis-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk Residivis - Lapas
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah Lapas Residivis
            document.getElementById('tambah-lapas-residivis')?.addEventListener('click', function() {
                const container = document.getElementById('lapas-fields');
                const newRow = document.createElement('div');
                newRow.className = 'lapas-residivis-row flex items-center gap-2 mt-1';
                newRow.innerHTML = `
                    <input type="text" name="lapas_akhir_residivis[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm"
                        placeholder="Masukkan lapas akhir">
                    <button type="button"
                        class="hapus-lapas-residivis bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                        title="Hapus Lapas">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
                container.appendChild(newRow);
            });

            // Hapus Lapas Residivis (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-lapas-residivis')) {
                    const row = e.target.closest('.lapas-residivis-row');
                    if (row && document.querySelectorAll('.lapas-residivis-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk Keluarga Lain
        document.addEventListener('DOMContentLoaded', function() {
            // Tambah Keluarga Lain
            document.getElementById('tambah-keluarga-lain')?.addEventListener('click', function() {
                const container = document.getElementById('keluarga-lain-fields');
                const newRow = document.createElement('div');
                newRow.className = 'keluarga-lain-row mt-1';
                newRow.innerHTML = `
                    <div class="flex flex-col md:flex-row gap-2">
                        <input type="text" name="nama_keluarga_lain[]" maxlength="100"
                            class="block w-full rounded-md border-gray-300 shadow-sm uppercase"
                            placeholder="Nama Keluarga Lain">
                        <div class="flex-1">
                            <input type="text" name="nik_keluarga_lain[]" maxlength="16"
                                class="block w-full rounded-md border-gray-300 shadow-sm nik-keluarga-lain"
                                placeholder="NIK Keluarga Lain (16 digit)"
                                pattern="[0-9]{16}" title="NIK harus berupa 16 digit angka">
                            <p class="text-xs text-gray-500 mt-1">NIK harus 16 digit angka</p>
                        </div>
                        <button type="button"
                            class="hapus-keluarga-lain bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center self-start"
                            title="Hapus Keluarga">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                `;
                container.appendChild(newRow);
            });

            // Hapus Keluarga Lain (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-keluarga-lain')) {
                    const row = e.target.closest('.keluarga-lain-row');
                    if (row && document.querySelectorAll('.keluarga-lain-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });

        // JavaScript untuk TKP (Tempat Kejadian Perkara)
        document.addEventListener('DOMContentLoaded', function() {
            // Function to create TKP row HTML
            function createTkpRow() {
                const rowId = 'tkp-row-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
                return `
                    <select name="tkp_provinsi[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm tkp-provinsi">
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                    <select name="tkp_kabupaten[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm tkp-kabupaten"
                        data-row-id="${rowId}">
                        <option value="">Pilih Kabupaten/Kota</option>
                        @foreach ($kabupatenList as $kabupaten)
                            <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                        @endforeach
                    </select>
                    <select name="tkp_kecamatan[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm tkp-kecamatan"
                        data-row-id="${rowId}">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                    <select name="tkp_desa[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm tkp-desa"
                        data-row-id="${rowId}">
                        <option value="">Pilih Desa/Kelurahan</option>
                    </select>
                    <input type="text" name="tkp_lokasi[]"
                        class="block w-full rounded-md border-gray-300 shadow-sm"
                        placeholder="Detail Lokasi (opsional)">
                    <button type="button"
                        class="hapus-tkp-row bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center self-center"
                        title="Hapus TKP">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                `;
            }

            // Function to attach event listeners to TKP row
            function attachTkpEventListeners(row) {
                const kabupatenSelect = row.querySelector('.tkp-kabupaten');
                const kecamatanSelect = row.querySelector('.tkp-kecamatan');
                const desaSelect = row.querySelector('.tkp-desa');

                if (kabupatenSelect) {
                    kabupatenSelect.addEventListener('change', function() {
                        console.log('TKP Direct Event - Kabupaten selected:', this.value);
                        const kabupaten = this.value;

                        // Clear kecamatan and desa options
                        if (kecamatanSelect) {
                            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        }
                        if (desaSelect) {
                            desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                        }

                        if (kabupaten) {
                            const url =
                                `/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`;
                            console.log('TKP Direct Event - Fetching URL:', url);

                            fetch(url)
                                .then(response => {
                                    console.log('TKP Direct Event - Response status:', response.status);
                                    if (!response.ok) {
                                        throw new Error(
                                            `Network response was not ok: ${response.status}`);
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    console.log('TKP Direct Event - Kecamatan data received:', data);
                                    if (data && data.length > 0) {
                                        data.forEach(kecamatan => {
                                            const option = document.createElement('option');
                                            option.value = kecamatan;
                                            option.textContent = kecamatan;
                                            if (kecamatanSelect) {
                                                kecamatanSelect.appendChild(option);
                                            }
                                        });
                                        console.log(
                                            'TKP Direct Event - Options added to kecamatan select');
                                    } else {
                                        console.warn('TKP Direct Event - No kecamatan data found for:',
                                            kabupaten);
                                        if (kecamatanSelect) {
                                            kecamatanSelect.innerHTML =
                                                '<option value="">Tidak ada data kecamatan</option>';
                                        }
                                    }
                                })
                                .catch(error => {
                                    console.error('TKP Direct Event - Error fetching kecamatan:',
                                        error);
                                    if (kecamatanSelect) {
                                        kecamatanSelect.innerHTML =
                                            '<option value="">Error loading kecamatan</option>';
                                    }
                                });
                        }
                    });
                }

                if (kecamatanSelect) {
                    kecamatanSelect.addEventListener('change', function() {
                        console.log('TKP Direct Event - Kecamatan selected:', this.value);
                        const kabupaten = kabupatenSelect ? kabupatenSelect.value : '';
                        const kecamatan = this.value;

                        // Clear desa options
                        if (desaSelect) {
                            desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                        }

                        if (kabupaten && kecamatan) {
                            const url =
                                `/admin/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`;
                            console.log('TKP Direct Event - Desa Fetching URL:', url);

                            fetch(url)
                                .then(response => {
                                    console.log('TKP Direct Event - Desa Response status:', response
                                        .status);
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    console.log('TKP Direct Event - Desa data received:', data);
                                    if (data && data.length > 0) {
                                        data.forEach(desa => {
                                            const option = document.createElement('option');
                                            option.value = desa;
                                            option.textContent = desa;
                                            if (desaSelect) {
                                                desaSelect.appendChild(option);
                                            }
                                        });
                                        console.log('TKP Direct Event - Desa options added');
                                    } else {
                                        console.warn('TKP Direct Event - No desa data found');
                                        if (desaSelect) {
                                            desaSelect.innerHTML =
                                                '<option value="">Tidak ada data desa</option>';
                                        }
                                    }
                                })
                                .catch(error => {
                                    console.error('TKP Direct Event - Error fetching desa:', error);
                                    if (desaSelect) {
                                        desaSelect.innerHTML =
                                            '<option value="">Error loading desa</option>';
                                    }
                                });
                        }
                    });
                }
            }

            // Tambah TKP for Compulsary
            document.getElementById('tambah-tkp')?.addEventListener('click', function() {
                const container = document.getElementById('tkp-compulsary-fields');
                const newRow = document.createElement('div');
                newRow.className = 'tkp-row space-y-2 mt-1';
                newRow.innerHTML = createTkpRow();
                container.appendChild(newRow);
                attachTkpEventListeners(newRow);
            });

            // Tambah TKP for Proses Hukum
            document.getElementById('tambah-tkp-prosesHukum')?.addEventListener('click', function() {
                const container = document.getElementById('tkp-prosesHukum-fields');
                const newRow = document.createElement('div');
                newRow.className = 'tkp-row space-y-2 mt-1';
                newRow.innerHTML = createTkpRow();
                container.appendChild(newRow);
                attachTkpEventListeners(newRow);
            });

            // Tambah TKP for Narapidana
            document.getElementById('tambah-tkp-narapidana')?.addEventListener('click', function() {
                const container = document.getElementById('tkp-narapidana-fields');
                const newRow = document.createElement('div');
                newRow.className = 'tkp-row space-y-2 mt-1';
                newRow.innerHTML = createTkpRow();
                container.appendChild(newRow);
                attachTkpEventListeners(newRow);
            });

            // Hapus TKP (delegated event listener)
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hapus-tkp-row')) {
                    const row = e.target.closest('.tkp-row');
                    if (row && document.querySelectorAll('.tkp-row').length > 1) {
                        row.remove();
                    }
                }
            });

            // Attach event listeners to existing TKP rows on page load
            document.querySelectorAll('.tkp-row').forEach(row => {
                attachTkpEventListeners(row);
            });
        });
    </script>

@endsection
