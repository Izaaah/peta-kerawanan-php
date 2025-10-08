@extends('layouts.admin-master')

@section('title', 'Edit Data Individu TSK')
@section('content')
    @include('components.admin-navbar')

    <div class="mx-auto px-4 py-3">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 light:text-white">Edit Data Individu</h1>
                <p class="text-sm text-gray-500">Silakan perbarui data individu dengan informasi yang akurat.</p>
            </div>
            <a href="{{ route('admin.data.individu.show', $individu->id) }}"
                class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
            <div class="lg:col-span-5">
                <!-- Form Input -->
                <div class="bg-white light:bg-gray-800 shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-blue-600 mb-4">Formulir Edit Data Individu</h2>

                    @if (session('error'))
                        <div class="bg-red-100 text-red-800 text-sm p-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
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

                    <form action="{{ route('admin.data.individu.update', $individu->id) }}" method="POST" id="individuForm"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2 mb-4">
                                <label for="nik" class="block text-base font-medium text-black">NIK <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nik" id="nik" maxlength="16" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                    value="{{ old('nik', $individu->nik) }}" pattern="[0-9]{16}"
                                    title="NIK harus berupa 16 digit angka">
                                <div class="mt-1 flex justify-between items-center">
                                    <p class="text-sm text-gray-500">NIK harus berupa 16 digit angka</p>
                                    <p class="text-sm text-gray-400" id="nik-counter">{{ strlen($individu->nik) }}/16</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="nkk" class="block text-base font-medium text-black">Nomor Kartu
                                    Keluarga <span class="text-red-500">*</span></label>
                                <input type="text" name="nkk" id="nkk" maxlength="16" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                    value="{{ old('nkk', $individu->nkk) }}" pattern="[0-9]{16}"
                                    title="Nomor KK harus berupa 16 digit angka">
                                <div class="mt-1 flex justify-between items-center">
                                    <p class="text-sm text-gray-500">Nomor KK harus berupa 16 digit angka</p>
                                    <p class="text-sm text-gray-400" id="nkk-counter">{{ strlen($individu->nkk) }}/16</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="jenis_kelamin" class="block text-base font-medium text-black">Jenis
                                    Kelamin <span class="text-red-500">*</span></label>
                                <select name="jenis_kelamin" id="jenis_kelamin" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L"
                                        {{ old('jenis_kelamin', $individu->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                        Laki-laki (L)</option>
                                    <option value="P"
                                        {{ old('jenis_kelamin', $individu->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                        Perempuan (P)</option>
                                </select>
                            </div>

                            <div class="md:col-span-2 mb-4">
                                <label for="nama" class="block text-base font-medium text-black">Nama
                                    Lengkap</label>
                                <input type="text" name="nama" id="nama" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base uppercase"
                                    value="{{ old('nama', $individu->nama) }}">
                            </div>

                            <div class="mb-4">
                                <label for="tempat_lahir" class="block text-base font-medium text-black">Tempat Lahir
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                    value="{{ old('tempat_lahir', $individu->tempat_lahir) }}"
                                    placeholder="Masukkan tempat lahir">
                            </div>

                            <div class="mb-4">
                                <label for="tgl_lahir" class="block text-base font-medium text-black">Tanggal Lahir
                                    <span class="text-red-500">*</span></label>
                                <input type="date" name="tgl_lahir" id="tgl_lahir" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                    value="{{ old('tgl_lahir', $individu->tgl_lahir) }}">
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
                                    @if ($individu->telepon->count() > 0)
                                        @foreach ($individu->telepon as $telepon)
                                            <div class="flex items-center gap-2 mt-1 telepon-row">
                                                <input type="number" name="telepon[]" maxlength="20"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                                    value="{{ $telepon->nomor_telepon }}"
                                                    placeholder="Masukkan nomor telepon">
                                                <button type="button"
                                                    class="hapus-telepon bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus Telepon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    @else
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
                                    @endif
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
                                    @if ($individu->rekening->count() > 0)
                                        @foreach ($individu->rekening as $rekening)
                                            <div class="flex items-center gap-2 mt-1 rekening-row">
                                                <input type="number" name="rekening[]" maxlength="30"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                                    value="{{ $rekening->no_rekening }}"
                                                    placeholder="Masukkan nomor rekening">
                                                <button type="button"
                                                    class="hapus-rekening bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus Rekening">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    @else
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
                                    @endif
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
                                    @if ($individu->ewallet->count() > 0)
                                        @foreach ($individu->ewallet as $ewallet)
                                            <div class="flex items-center gap-2 mt-1 ewallet-row">
                                                <input type="number" name="ewallet[]" maxlength="30"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-base"
                                                    value="{{ $ewallet->no_ewallet }}"
                                                    placeholder="Masukkan nomor e-wallet">
                                                <button type="button"
                                                    class="hapus-ewallet bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-8 h-8 flex items-center justify-center"
                                                    title="Hapus E-Wallet">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    @else
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
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label for="provinsi" class="block text-sm font-medium text-black">Provinsi</label>
                                <select name="provinsi" id="provinsi" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="Jawa Timur"
                                        {{ old('provinsi', $individu->provinsi) == 'Jawa Timur' ? 'selected' : '' }}>Jawa
                                        Timur</option>
                                    <option value="lainnya"
                                        {{ old('provinsi', $individu->provinsi) == 'lainnya' ? 'selected' : '' }}>Lainnya
                                    </option>
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
                                                    {{ old('kabupaten', $individu->kabupaten) == $kabupaten ? 'selected' : '' }}>
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
                            </div>

                            <div id="wilayah-lainnya" class="hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-black   mb-1">Provinsi</label>
                                        <input type="text" name="provinsi_lain" id="provinsi_lain"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                            value="{{ old('provinsi_lain', $individu->provinsi_lain) }}"
                                            placeholder="Provinsi">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-black   mb-1">Kabupaten</label>
                                        <input type="text" name="kabupaten_lain"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                            value="{{ old('kabupaten_lain', $individu->kabupaten_lain) }}"
                                            placeholder="Kabupaten">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-black   mb-1">Kecamatan</label>
                                        <input type="text" name="kecamatan_lain"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                            value="{{ old('kecamatan_lain', $individu->kecamatan_lain) }}"
                                            placeholder="Kecamatan">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-black   mb-1">Kelurahan/Desa</label>
                                        <input type="text" name="kelurahan_lain"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                            value="{{ old('kelurahan_lain', $individu->kelurahan_lain) }}"
                                            placeholder="Kelurahan/Desa">
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label for="alamat" class="block text-sm font-medium text-black  ">Alamat
                                    Lengkap (Dusun/Jalan/RT/RW)</label>
                                <textarea name="alamat" id="alamat" rows="2" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('alamat', $individu->alamat) }}</textarea>
                            </div>

                            <div>
                                <label for="nama_ayah" class="block text-sm font-medium text-black  ">Nama
                                    Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm uppercase"
                                    value="{{ old('nama_ayah', $individu->nama_ayah) }}">
                            </div>

                            <div>
                                <label for="nik_ayah" class="block text-sm font-medium text-black  ">NIK
                                    Ayah</label>
                                <input type="text" name="nik_ayah" id="nik_ayah" maxlength="16"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    value="{{ old('nik_ayah', $individu->nik_ayah) }}">
                            </div>

                            <div>
                                <label for="nama_ibu" class="block text-sm font-medium text-black  ">Nama
                                    Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm uppercase"
                                    value="{{ old('nama_ibu', $individu->nama_ibu) }}">
                            </div>

                            <div>
                                <label for="nik_ibu" class="block text-sm font-medium text-black  ">NIK
                                    Ibu</label>
                                <input type="text" name="nik_ibu" id="nik_ibu" maxlength="16"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    value="{{ old('nik_ibu', $individu->nik_ibu) }}">
                            </div>

                            <div>
                                <label for="peran_jaringan" class="block text-sm font-medium text-black  ">Peran
                                    dalam Jaringan</label>
                                <select name="peran_jaringan" id="peran_jaringan" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Pilih Peran</option>
                                    <option value="informan"
                                        {{ old('peran_jaringan', $individu->peran_jaringan) == 'informan' ? 'selected' : '' }}>
                                        Informan</option>
                                    <option value="kurir"
                                        {{ old('peran_jaringan', $individu->peran_jaringan) == 'kurir' ? 'selected' : '' }}>
                                        Kurir</option>
                                    <option value="gudang"
                                        {{ old('peran_jaringan', $individu->peran_jaringan) == 'gudang' ? 'selected' : '' }}>
                                        Gudang</option>
                                    <option value="bandar"
                                        {{ old('peran_jaringan', $individu->peran_jaringan) == 'bandar' ? 'selected' : '' }}>
                                        Bandar</option>
                                    <option value="Penyalahguna"
                                        {{ old('peran_jaringan', $individu->peran_jaringan) == 'Penyalahguna' ? 'selected' : '' }}>
                                        Penyalahguna</option>
                                    <option value="Korban Penyalahguna"
                                        {{ old('peran_jaringan', $individu->peran_jaringan) == 'Korban Penyalahguna' ? 'selected' : '' }}>
                                        Korban Penyalahguna</option>
                                    <option value="Pecandu"
                                        {{ old('peran_jaringan', $individu->peran_jaringan) == 'Pecandu' ? 'selected' : '' }}>
                                        Pecandu</option>
                                    <option value="Lain-lain"
                                        {{ old('peran_jaringan', $individu->peran_jaringan) == 'Lain-lain' ? 'selected' : '' }}>
                                        Lain-lain</option>
                                </select>
                            </div>

                            <div>
                                <label for="modus_operasi" class="block text-sm font-medium text-black  ">Modus
                                    Operandi/Uraian Singkat Peristiwa</label>
                                <textarea name="modus_operasi" id="modus_operasi" rows="2"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('modus_operasi', $individu->modus_operasi) }}</textarea>
                            </div>

                            <!-- Input Dinamis Jenis Narkotika -->
                            <div class="md:col-span-2" id="jenis-narkotika-wrapper">
                                <label class="block text-sm font-medium text-black  ">Jenis Narkotika</label>
                                <div id="jenis-narkotika-fields">
                                    @if ($individu->jenis_narkotika)
                                        @foreach (explode(',', $individu->jenis_narkotika) as $jenis)
                                            <div class="flex items-center gap-2 mt-1 jenis-narkotika-row">
                                                <input type="text" name="jenis_narkotika[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm"
                                                    value="{{ trim($jenis) }}">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex items-center gap-2 mt-1 jenis-narkotika-row">
                                            <input type="text" name="jenis_narkotika[]"
                                                class="block w-full rounded-md border-gray-300 shadow-sm">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label for="skala_kelas" class="block text-sm font-medium text-black  ">Jumlah
                                    Barang Bukti</label>
                                <div class="flex items-center">
                                    <input type="text" id="angka" name="angka"
                                        class="mt-1 block w-1/2 rounded-md border-gray-300 shadow-sm"
                                        value="{{ old('angka', $individu->jumlah_barang_bukti) }}" />
                                    <select name="satuan" id="satuan"
                                        class="mt-1 block w-1/2 rounded-md border-gray-300 shadow-sm ml-2">
                                        <option value="">Pilih Satuan</option>
                                        <option value="Gram"
                                            {{ old('satuan', $individu->satuan_barang_bukti) == 'Gram' ? 'selected' : '' }}>
                                            Gram</option>
                                        <option value="Ons"
                                            {{ old('satuan', $individu->satuan_barang_bukti) == 'Ons' ? 'selected' : '' }}>
                                            Ons</option>
                                        <option value="Kg"
                                            {{ old('satuan', $individu->satuan_barang_bukti) == 'Kg' ? 'selected' : '' }}>
                                            Kg</option>
                                        <option value="Ton"
                                            {{ old('satuan', $individu->satuan_barang_bukti) == 'Ton' ? 'selected' : '' }}>
                                            Ton</option>
                                        <option value="Butir"
                                            {{ old('satuan', $individu->satuan_barang_bukti) == 'Butir' ? 'selected' : '' }}>
                                            Butir</option>
                                        <option value="Batang"
                                            {{ old('satuan', $individu->satuan_barang_bukti) == 'Batang' ? 'selected' : '' }}>
                                            Batang</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-black  ">Status</label>
                                <select name="status" id="status" required
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm appearance-none">
                                    <option value="">Pilih Status</option>
                                    <option value="Voluntary"
                                        {{ old('status', $individu->status) == 'Voluntary' ? 'selected' : '' }}>
                                        Voluntary
                                        (Sukarela)</option>
                                    <option value="Compulsary"
                                        {{ old('status', $individu->status) == 'Compulsary' ? 'selected' : '' }}>
                                        Compulsary
                                        (Upaya Paksa)</option>
                                    <option value="Proses Hukum Lanjut"
                                        {{ old('status', $individu->status) == 'Proses Hukum Lanjut' ? 'selected' : '' }}>
                                        Proses Hukum Lanjut</option>
                                    <option value="Narapidana"
                                        {{ old('status', $individu->status) == 'Narapidana' ? 'selected' : '' }}>
                                        Narapidana
                                    </option>
                                </select>
                            </div>

                            <!-- Pilihan Resisivis -->
                            <div class="md:col-span-2" id="residivis-wrapper">
                                <label class="block text-sm font-medium text-black mb-1">Residivis</label>
                                <div class="flex items-center gap-4 mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="residivis" value="1"
                                            class="form-radio text-blue-600" id="residivis-ya"
                                            {{ old('residivis', $individu->residivis) == '1' ? 'checked' : '' }}>
                                        <span class="ml-2">Ya</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="residivis" value="0"
                                            class="form-radio text-blue-600" id="residivis-tidak"
                                            {{ old('residivis', $individu->residivis) == '0' ? 'checked' : '' }}>
                                        <span class="ml-2">Tidak</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <button type="reset"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-md">Reset</button>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md inline-flex items-center">
                                <i class="fas fa-save mr-2"></i> Update Data
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
                            <li>Pilih status sesuai dengan kondisi terkini individu.</li>
                            <li>Desa akan dipetakan berdasarkan kecamatan dan kelurahan.</li>
                        </ul>
                    </div>
                    <div class="bg-yellow-50 text-black text-xs p-2 rounded flex items-center">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <span class="ml-2">Pastikan data yang diubah sudah benar sebelum menyimpan.</span>
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

            // Initialize provinsi selection on page load
            if (provinsiSelect && provinsiSelect.value === 'lainnya') {
                wilayahJatim.classList.add('hidden');
                wilayahLainnya.classList.remove('hidden');
            }

            // Handle kabupaten selection
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');

            kabupatenSelect?.addEventListener('change', function() {
                const kabupaten = this.value;
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                if (kabupaten) {
                    fetch(`/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            data.forEach(kecamatan => {
                                const option = document.createElement('option');
                                option.value = kecamatan;
                                option.textContent = kecamatan;
                                kecamatanSelect.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching kecamatan:', error);
                            kecamatanSelect.innerHTML =
                                '<option value="">Error loading kecamatan</option>';
                        });
                }
            });

            // Handle kecamatan selection
            kecamatanSelect?.addEventListener('change', function() {
                const kabupaten = kabupatenSelect.value;
                const kecamatan = this.value;
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                if (kabupaten && kecamatan) {
                    fetch(
                            `/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`
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
                            kelurahanSelect.innerHTML = '<option value="">Error loading desa</option>';
                        });
                }
            });

            // Load existing kecamatan and kelurahan if they exist
            const existingKabupaten = '{{ $individu->kabupaten }}';
            const existingKecamatan = '{{ $individu->kecamatan }}';
            const existingKelurahan = '{{ $individu->kelurahan }}';

            if (existingKabupaten && existingKecamatan) {
                // Load kecamatan first
                fetch(`/api/kecamatan-list?kabupaten=${encodeURIComponent(existingKabupaten)}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(kecamatan => {
                            const option = document.createElement('option');
                            option.value = kecamatan;
                            option.textContent = kecamatan;
                            if (kecamatan === existingKecamatan) {
                                option.selected = true;
                            }
                            kecamatanSelect.appendChild(option);
                        });

                        // Then load kelurahan
                        if (existingKelurahan) {
                            fetch(
                                    `/api/desa-list?kabupaten=${encodeURIComponent(existingKabupaten)}&kecamatan=${encodeURIComponent(existingKecamatan)}`
                                )
                                .then(response => response.json())
                                .then(data => {
                                    data.forEach(desa => {
                                        const option = document.createElement('option');
                                        option.value = desa;
                                        option.textContent = desa;
                                        if (desa === existingKelurahan) {
                                            option.selected = true;
                                        }
                                        kelurahanSelect.appendChild(option);
                                    });
                                });
                        }
                    });
            }

            // Restrict input to numbers only for NIK and NKK
            ['nik', 'nkk'].forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.addEventListener('input', function() {
                        this.value = this.value.replace(/[^0-9]/g, '');
                    });
                }
            });

            // JavaScript untuk Telepon, Rekening, dan E-Wallet (sama seperti create)
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
    </script>
@endsection
