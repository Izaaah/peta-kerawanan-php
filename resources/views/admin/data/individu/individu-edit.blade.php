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

                            <!-- Status Detail Fields akan ditambahkan di sini oleh JavaScript -->
                            <div id="voluntary-detail"
                                class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200 md:col-span-2">
                                <p class="text-sm text-gray-600 mb-2">Detail untuk status Voluntary</p>
                                <p class="text-xs text-gray-500">Field detail Voluntary (jika diperlukan)</p>
                            </div>

                            <div id="compulsary-detail"
                                class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200 md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Detail Status Compulsary (Upaya Paksa)
                                </h4>

                                @if (config('app.debug'))
                                    <div class="mb-2 p-2 bg-blue-50 text-xs">
                                        <strong>Debug Info:</strong><br>
                                        <strong>Compulsary Status:</strong>
                                        {{ $individu->compulsaryStatus ? 'EXISTS' : 'NOT EXISTS' }}<br>
                                        @if ($individu->compulsaryStatus)
                                            no_kasus = "{{ $individu->compulsaryStatus->no_kasus ?? 'null' }}"<br>
                                            tanggal_kasus = "{{ $individu->compulsaryStatus->tanggal_kasus ?? 'null' }}"<br>
                                            satuan_kerja = "{{ $individu->compulsaryStatus->satuan_kerja ?? 'null' }}"<br>
                                            aph_menangani = "{{ $individu->compulsaryStatus->aph_menangani ?? 'null' }}"<br>
                                            pasal_disangkakan = "{{ $individu->compulsaryStatus->pasal_disangkakan ?? 'null' }}"<br>
                                            rekomendasi = "{{ $individu->compulsaryStatus->rekomendasi ?? 'null' }}"<br>
                                        @endif
                                        <br>
                                        <strong>Proses Hukum Status:</strong>
                                        {{ $individu->prosesHukumStatus ? 'EXISTS' : 'NOT EXISTS' }}<br>
                                        @if ($individu->prosesHukumStatus)
                                            no_kasus = "{{ $individu->prosesHukumStatus->no_kasus ?? 'null' }}"<br>
                                            tanggal_kasus = "{{ $individu->prosesHukumStatus->tanggal_kasus ?? 'null' }}"<br>
                                            satuan_kerja = "{{ $individu->prosesHukumStatus->satuan_kerja ?? 'null' }}"<br>
                                            aph_menangani = "{{ $individu->prosesHukumStatus->aph_menangani ?? 'null' }}"<br>
                                            pasal_disangkakan = "{{ $individu->prosesHukumStatus->pasal_disangkakan ?? 'null' }}"<br>
                                            rekomendasi = "{{ $individu->prosesHukumStatus->rekomendasi ?? 'null' }}"<br>
                                        @endif
                                        <br>
                                        <strong>Narapidana Status:</strong>
                                        {{ $individu->narapidanaStatus ? 'EXISTS' : 'NOT EXISTS' }}<br>
                                        @if ($individu->narapidanaStatus)
                                            no_kasus = "{{ $individu->narapidanaStatus->no_kasus ?? 'null' }}"<br>
                                            tanggal_kasus = "{{ $individu->narapidanaStatus->tanggal_kasus ?? 'null' }}"<br>
                                            satuan_kerja = "{{ $individu->narapidanaStatus->satuan_kerja ?? 'null' }}"<br>
                                            aph_menangani = "{{ $individu->narapidanaStatus->aph_menangani ?? 'null' }}"<br>
                                            pasal_disangkakan = "{{ $individu->narapidanaStatus->pasal_disangkakan ?? 'null' }}"<br>
                                            rekomendasi = "{{ $individu->narapidanaStatus->rekomendasi ?? 'null' }}"
                                        @endif
                                    </div>
                                @endif

                                <!-- Nomor Kasus Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">a. Nomor Kasus
                                        (LKN/LI/LP)</label>
                                    <div class="space-y-2" id="compulsary-noKasus-container">
                                        @php
                                            // Use new relationship
                                            $noKasusData = $individu->compulsaryStatus?->no_kasus ?? '';
                                        @endphp
                                        @if ($noKasusData)
                                            @foreach (explode(',', $noKasusData) as $kasus)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="no_kasus[]" value="{{ trim($kasus) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan nomor kasus">
                                                    <button type="button"
                                                        class="hapus-noKasus bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="no_kasus[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan nomor kasus">
                                                <button type="button"
                                                    class="hapus-noKasus bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-noKasus"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah LKN
                                    </button>
                                </div>

                                <!-- Tanggal Kasus -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">b. Tanggal Kasus</label>
                                    <input type="date" name="tanggal_kasus"
                                        value="{{ old('tanggal_kasus', $individu->compulsaryStatus?->tanggal_kasus?->format('Y-m-d')) }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                </div>

                                <!-- Satuan Kerja -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">c. Satuan Kerja yang
                                        menangani</label>
                                    <input type="text" name="satuan_kerja"
                                        value="{{ old('satuan_kerja', $individu->compulsaryStatus?->satuan_kerja) }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                        placeholder="Masukkan satuan kerja">
                                </div>

                                <!-- APH Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">d. APH yang menangani</label>
                                    <div class="space-y-2" id="compulsary-aph-container">
                                        @php
                                            // Use new relationship
                                            $aphData = $individu->compulsaryStatus?->aph_menangani ?? '';
                                        @endphp
                                        @if ($aphData)
                                            @foreach (explode(',', $aphData) as $aph)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="aph_menangani[]"
                                                        value="{{ trim($aph) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan APH yang menangani">
                                                    <button type="button"
                                                        class="hapus-aph bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="aph_menangani[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan APH yang menangani">
                                                <button type="button"
                                                    class="hapus-aph bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-aph"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah APH
                                    </button>
                                </div>

                                <!-- Pasal Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">e. Pasal yang
                                        disangkakan</label>
                                    <div class="space-y-2" id="compulsary-pasal-container">
                                        @php
                                            // Use new relationship
                                            $pasalData = $individu->compulsaryStatus?->pasal_disangkakan ?? '';
                                        @endphp
                                        @if ($pasalData)
                                            @foreach (explode(',', $pasalData) as $pasal)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="pasal_disangkakan[]"
                                                        value="{{ trim($pasal) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan pasal yang disangkakan">
                                                    <button type="button"
                                                        class="hapus-pasal bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="pasal_disangkakan[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan pasal yang disangkakan">
                                                <button type="button"
                                                    class="hapus-pasal bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-pasal"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah Pasal
                                    </button>
                                </div>

                                <!-- IPWL Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">f. Rekomendasi IPWL</label>
                                    <select name="ipwl_compulsary_id"
                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                        <option value="">Pilih Lembaga IPWL</option>
                                        @if (isset($ipwlList) && $ipwlList->count() > 0)
                                            @foreach ($ipwlList as $ipwl)
                                                <option value="{{ $ipwl->id }}"
                                                    {{ old('ipwl_compulsary_id', $individu->compulsaryStatus?->ipwl_id) == $ipwl->id ? 'selected' : '' }}>
                                                    {{ $ipwl->nama }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <!-- Rekomendasi Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">g. Rekomendasi</label>
                                    <div class="space-y-2" id="compulsary-rekomendasi-container">
                                        @php
                                            // Use new relationship
                                            $rekomendasiData = $individu->compulsaryStatus?->rekomendasi ?? '';
                                        @endphp
                                        @if ($rekomendasiData)
                                            @foreach (explode(',', $rekomendasiData) as $rek)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="rekomendasi[]"
                                                        value="{{ trim($rek) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan rekomendasi">
                                                    <button type="button"
                                                        class="hapus-rekomendasi bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="rekomendasi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan rekomendasi">
                                                <button type="button"
                                                    class="hapus-rekomendasi bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-rekomendasi"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah Rekomendasi
                                    </button>
                                </div>

                                <!-- TKP Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">h. TKP (Tempat Kejadian
                                        Perkara)</label>
                                    <div class="space-y-2" id="compulsary-tkp-container">
                                        @php
                                            $tkpData = $individu->compulsaryStatus?->tkp_lokasi
                                                ? json_decode($individu->compulsaryStatus->tkp_lokasi, true)
                                                : [];
                                        @endphp
                                        @if ($tkpData && is_array($tkpData) && count($tkpData) > 0)
                                            @foreach ($tkpData as $index => $tkp)
                                                <div
                                                    class="p-3 border border-gray-200 rounded tkp-row-compulsary space-y-2">
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                                                        <select name="tkp_provinsi[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-provinsi-compulsary">
                                                            <option value="Jawa Timur"
                                                                {{ ($tkp['provinsi'] ?? '') == 'Jawa Timur' ? 'selected' : '' }}>
                                                                Jawa Timur</option>
                                                            <option value="lainnya"
                                                                {{ ($tkp['provinsi'] ?? '') == 'lainnya' ? 'selected' : '' }}>
                                                                Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                                                        <select name="tkp_kabupaten[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kabupaten-compulsary">
                                                            <option value="">Pilih Kabupaten</option>
                                                            @if (isset($kabupatenList))
                                                                @foreach ($kabupatenList as $kab)
                                                                    <option value="{{ $kab }}"
                                                                        {{ ($tkp['kabupaten'] ?? '') == $kab ? 'selected' : '' }}>
                                                                        {{ $kab }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                                                        <select name="tkp_kecamatan[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kecamatan-compulsary">
                                                            <option value="">Pilih Kecamatan</option>
                                                            @if (!empty($tkp['kecamatan']))
                                                                <option value="{{ $tkp['kecamatan'] }}" selected>
                                                                    {{ $tkp['kecamatan'] }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Desa/Kelurahan</label>
                                                        <select name="tkp_desa[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-desa-compulsary">
                                                            <option value="">Pilih Desa/Kelurahan</option>
                                                            @if (!empty($tkp['desa']))
                                                                <option value="{{ $tkp['desa'] }}" selected>
                                                                    {{ $tkp['desa'] }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 mb-1">Detail
                                                            Lokasi</label>
                                                        <input type="text" name="tkp_lokasi[]"
                                                            value="{{ $tkp['lokasi'] ?? '' }}"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                            placeholder="Detail Lokasi (opsional)">
                                                    </div>
                                                    <div class="flex justify-end">
                                                        <button type="button"
                                                            class="hapus-tkp-compulsary bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                            title="Hapus TKP">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="p-3 border border-gray-200 rounded tkp-row-compulsary space-y-2">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                                                    <select name="tkp_provinsi[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-provinsi-compulsary">
                                                        <option value="Jawa Timur">Jawa Timur</option>
                                                        <option value="lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                                                    <select name="tkp_kabupaten[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kabupaten-compulsary">
                                                        <option value="">Pilih Kabupaten</option>
                                                        @if (isset($kabupatenList))
                                                            @foreach ($kabupatenList as $kab)
                                                                <option value="{{ $kab }}">{{ $kab }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                                                    <select name="tkp_kecamatan[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kecamatan-compulsary">
                                                        <option value="">Pilih Kecamatan</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Desa/Kelurahan</label>
                                                    <select name="tkp_desa[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-desa-compulsary">
                                                        <option value="">Pilih Desa/Kelurahan</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-600 mb-1">Detail
                                                        Lokasi</label>
                                                    <input type="text" name="tkp_lokasi[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Detail Lokasi (opsional)">
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="button"
                                                        class="hapus-tkp-compulsary bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus TKP">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-tkp-compulsary"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah TKP
                                    </button>
                                </div>
                            </div>

                            <div id="prosesHukum-detail"
                                class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200 md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Detail Status Proses Hukum Lanjut</h4>

                                <!-- Nomor Kasus Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">a. Nomor Kasus
                                        (LKN/LI/LP)</label>
                                    <div class="space-y-2" id="prosesHukum-noKasus-container">
                                        @php
                                            // Use new relationship for Proses Hukum
                                            $noKasusData = $individu->prosesHukumStatus?->no_kasus ?? '';
                                        @endphp
                                        @if ($noKasusData)
                                            @foreach (explode(',', $noKasusData) as $kasus)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="no_kasus_proses[]"
                                                        value="{{ trim($kasus) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan nomor kasus">
                                                    <button type="button"
                                                        class="hapus-noKasus-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="no_kasus_proses[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan nomor kasus">
                                                <button type="button"
                                                    class="hapus-noKasus-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-noKasus-proses"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah LKN
                                    </button>
                                </div>

                                <!-- Tanggal Kasus -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">b. Tanggal Kasus</label>
                                    <input type="date" name="tanggal_kasus_proses"
                                        value="{{ old('tanggal_kasus_proses', $individu->prosesHukumStatus?->tanggal_kasus?->format('Y-m-d')) }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                </div>

                                <!-- Satuan Kerja -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">c. Satuan Kerja yang
                                        menangani</label>
                                    <input type="text" name="satuan_kerja_proses"
                                        value="{{ old('satuan_kerja_proses', $individu->prosesHukumStatus?->satuan_kerja) }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                        placeholder="Masukkan satuan kerja">
                                </div>

                                <!-- APH Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">d. APH yang menangani</label>
                                    <div class="space-y-2" id="prosesHukum-aph-container">
                                        @if ($individu->prosesHukumStatus?->aph_menangani)
                                            @foreach (explode(',', $individu->prosesHukumStatus->aph_menangani) as $aph)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="aph_menangani_proses[]"
                                                        value="{{ trim($aph) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan APH yang menangani">
                                                    <button type="button"
                                                        class="hapus-aph-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="aph_menangani_proses[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan APH yang menangani">
                                                <button type="button"
                                                    class="hapus-aph-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-aph-proses"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah APH
                                    </button>
                                </div>

                                <!-- Pasal Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">e. Pasal yang
                                        disangkakan</label>
                                    <div class="space-y-2" id="prosesHukum-pasal-container">
                                        @if ($individu->prosesHukumStatus?->pasal_disangkakan)
                                            @foreach (explode(',', $individu->prosesHukumStatus->pasal_disangkakan) as $pasal)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="pasal_disangkakan_proses[]"
                                                        value="{{ trim($pasal) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan pasal yang disangkakan">
                                                    <button type="button"
                                                        class="hapus-pasal-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="pasal_disangkakan_proses[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan pasal yang disangkakan">
                                                <button type="button"
                                                    class="hapus-pasal-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-pasal-proses"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah Pasal
                                    </button>
                                </div>

                                <!-- IPWL Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">f. Rekomendasi IPWL</label>
                                    <select name="ipwl_proses_id"
                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                        <option value="">Pilih Lembaga IPWL</option>
                                        @if (isset($ipwlList) && $ipwlList->count() > 0)
                                            @foreach ($ipwlList as $ipwl)
                                                <option value="{{ $ipwl->id }}"
                                                    {{ old('ipwl_proses_id', $individu->prosesHukumStatus?->ipwl_id) == $ipwl->id ? 'selected' : '' }}>
                                                    {{ $ipwl->nama }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <!-- Rekomendasi Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">g. Rekomendasi</label>
                                    <div class="space-y-2" id="prosesHukum-rekomendasi-container">
                                        @if ($individu->prosesHukumStatus?->rekomendasi)
                                            @foreach (explode(',', $individu->prosesHukumStatus->rekomendasi) as $rek)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="rekomendasi_proses[]"
                                                        value="{{ trim($rek) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan rekomendasi">
                                                    <button type="button"
                                                        class="hapus-rekomendasi-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="rekomendasi_proses[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan rekomendasi">
                                                <button type="button"
                                                    class="hapus-rekomendasi-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-rekomendasi-proses"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah Rekomendasi
                                    </button>
                                </div>

                                <!-- TKP Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">h. TKP (Tempat Kejadian
                                        Perkara)</label>
                                    <div class="space-y-2" id="prosesHukum-tkp-container">
                                        @php
                                            $tkpData = $individu->prosesHukumStatus?->tkp_lokasi
                                                ? json_decode($individu->prosesHukumStatus->tkp_lokasi, true)
                                                : [];
                                        @endphp
                                        @if ($tkpData && is_array($tkpData) && count($tkpData) > 0)
                                            @foreach ($tkpData as $index => $tkp)
                                                <div class="p-3 border border-gray-200 rounded tkp-row-proses space-y-2">
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                                                        <select name="tkp_provinsi_proses[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-provinsi-proses">
                                                            <option value="Jawa Timur"
                                                                {{ ($tkp['provinsi'] ?? '') == 'Jawa Timur' ? 'selected' : '' }}>
                                                                Jawa Timur</option>
                                                            <option value="lainnya"
                                                                {{ ($tkp['provinsi'] ?? '') == 'lainnya' ? 'selected' : '' }}>
                                                                Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                                                        <select name="tkp_kabupaten_proses[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kabupaten-proses">
                                                            <option value="">Pilih Kabupaten</option>
                                                            @if (isset($kabupatenList))
                                                                @foreach ($kabupatenList as $kab)
                                                                    <option value="{{ $kab }}"
                                                                        {{ ($tkp['kabupaten'] ?? '') == $kab ? 'selected' : '' }}>
                                                                        {{ $kab }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                                                        <select name="tkp_kecamatan_proses[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kecamatan-proses">
                                                            <option value="">Pilih Kecamatan</option>
                                                            @if (!empty($tkp['kecamatan']))
                                                                <option value="{{ $tkp['kecamatan'] }}" selected>
                                                                    {{ $tkp['kecamatan'] }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Desa/Kelurahan</label>
                                                        <select name="tkp_desa_proses[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-desa-proses">
                                                            <option value="">Pilih Desa/Kelurahan</option>
                                                            @if (!empty($tkp['desa']))
                                                                <option value="{{ $tkp['desa'] }}" selected>
                                                                    {{ $tkp['desa'] }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 mb-1">Detail
                                                            Lokasi</label>
                                                        <input type="text" name="tkp_lokasi_proses[]"
                                                            value="{{ $tkp['lokasi'] ?? '' }}"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                            placeholder="Detail Lokasi (opsional)">
                                                    </div>
                                                    <div class="flex justify-end">
                                                        <button type="button"
                                                            class="hapus-tkp-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                            title="Hapus TKP">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="p-3 border border-gray-200 rounded tkp-row-proses space-y-2">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                                                    <select name="tkp_provinsi_proses[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-provinsi-proses">
                                                        <option value="Jawa Timur">Jawa Timur</option>
                                                        <option value="lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                                                    <select name="tkp_kabupaten_proses[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kabupaten-proses">
                                                        <option value="">Pilih Kabupaten</option>
                                                        @if (isset($kabupatenList))
                                                            @foreach ($kabupatenList as $kab)
                                                                <option value="{{ $kab }}">{{ $kab }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                                                    <select name="tkp_kecamatan_proses[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kecamatan-proses">
                                                        <option value="">Pilih Kecamatan</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Desa/Kelurahan</label>
                                                    <select name="tkp_desa_proses[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-desa-proses">
                                                        <option value="">Pilih Desa/Kelurahan</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-600 mb-1">Detail
                                                        Lokasi</label>
                                                    <input type="text" name="tkp_lokasi_proses[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Detail Lokasi (opsional)">
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="button"
                                                        class="hapus-tkp-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus TKP">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-tkp-proses"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah TKP
                                    </button>
                                </div>
                            </div>

                            <div id="narapidana-detail"
                                class="mt-4 hidden bg-gray-50 p-4 rounded-md border border-gray-200 md:col-span-2">
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Detail Status Narapidana</h4>

                                <!-- Nomor Kasus Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">a. Nomor Kasus
                                        (LKN/LI/LP)</label>
                                    <div class="space-y-2" id="narapidana-noKasus-container">
                                        @if ($individu->narapidanaStatus?->no_kasus)
                                            @foreach (explode(',', $individu->narapidanaStatus->no_kasus) as $kasus)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="no_kasus_narapidana[]"
                                                        value="{{ trim($kasus) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan nomor kasus">
                                                    <button type="button"
                                                        class="hapus-noKasus-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="no_kasus_narapidana[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan nomor kasus">
                                                <button type="button"
                                                    class="hapus-noKasus-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-noKasus-narapidana"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah LKN
                                    </button>
                                </div>

                                <!-- Tanggal Kasus -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">b. Tanggal Kasus</label>
                                    <input type="date" name="tanggal_kasus_narapidana"
                                        value="{{ old('tanggal_kasus_narapidana', $individu->narapidanaStatus?->tanggal_kasus?->format('Y-m-d')) }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                </div>

                                <!-- Satuan Kerja -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">c. Satuan Kerja yang
                                        menangani</label>
                                    <input type="text" name="satuan_kerja_narapidana"
                                        value="{{ old('satuan_kerja_narapidana', $individu->narapidanaStatus?->satuan_kerja) }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                        placeholder="Masukkan satuan kerja">
                                </div>

                                <!-- APH Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">d. APH yang menangani</label>
                                    <div class="space-y-2" id="narapidana-aph-container">
                                        @if ($individu->narapidanaStatus?->aph_menangani)
                                            @foreach (explode(',', $individu->narapidanaStatus->aph_menangani) as $aph)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="aph_menangani_narapidana[]"
                                                        value="{{ trim($aph) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan APH yang menangani">
                                                    <button type="button"
                                                        class="hapus-aph-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="aph_menangani_narapidana[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan APH yang menangani">
                                                <button type="button"
                                                    class="hapus-aph-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-aph-narapidana"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah APH
                                    </button>
                                </div>

                                <!-- Pasal Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">e. Pasal yang
                                        disangkakan</label>
                                    <div class="space-y-2" id="narapidana-pasal-container">
                                        @if ($individu->narapidanaStatus?->pasal_disangkakan)
                                            @foreach (explode(',', $individu->narapidanaStatus->pasal_disangkakan) as $pasal)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="pasal_disangkakan_narapidana[]"
                                                        value="{{ trim($pasal) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan pasal yang disangkakan">
                                                    <button type="button"
                                                        class="hapus-pasal-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="pasal_disangkakan_narapidana[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan pasal yang disangkakan">
                                                <button type="button"
                                                    class="hapus-pasal-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-pasal-narapidana"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah Pasal
                                    </button>
                                </div>

                                <!-- IPWL Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">f. Rekomendasi IPWL</label>
                                    <select name="ipwl_narapidana_id"
                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                        <option value="">Pilih Lembaga IPWL</option>
                                        @if (isset($ipwlList) && $ipwlList->count() > 0)
                                            @foreach ($ipwlList as $ipwl)
                                                <option value="{{ $ipwl->id }}"
                                                    {{ old('ipwl_narapidana_id', $individu->narapidanaStatus?->ipwl_id) == $ipwl->id ? 'selected' : '' }}>
                                                    {{ $ipwl->nama }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <!-- Rekomendasi Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">g. Rekomendasi</label>
                                    <div class="space-y-2" id="narapidana-rekomendasi-container">
                                        @if ($individu->narapidanaStatus?->rekomendasi)
                                            @foreach (explode(',', $individu->narapidanaStatus->rekomendasi) as $rek)
                                                <div class="flex items-center gap-2">
                                                    <input type="text" name="rekomendasi_narapidana[]"
                                                        value="{{ trim($rek) }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Masukkan rekomendasi">
                                                    <button type="button"
                                                        class="hapus-rekomendasi-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="rekomendasi_narapidana[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Masukkan rekomendasi">
                                                <button type="button"
                                                    class="hapus-rekomendasi-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-rekomendasi-narapidana"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah Rekomendasi
                                    </button>
                                </div>

                                <!-- TKP Section -->
                                <div class="mb-3">
                                    <label class="block text-xs font-medium text-black mb-1">h. TKP (Tempat Kejadian
                                        Perkara)</label>
                                    <div class="space-y-2" id="narapidana-tkp-container">
                                        @php
                                            $tkpData = $individu->narapidanaStatus?->tkp_lokasi
                                                ? json_decode($individu->narapidanaStatus->tkp_lokasi, true)
                                                : [];
                                        @endphp
                                        @if ($tkpData && is_array($tkpData) && count($tkpData) > 0)
                                            @foreach ($tkpData as $index => $tkp)
                                                <div
                                                    class="p-3 border border-gray-200 rounded tkp-row-narapidana space-y-2">
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                                                        <select name="tkp_provinsi_narapidana[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-provinsi-narapidana">
                                                            <option value="Jawa Timur"
                                                                {{ ($tkp['provinsi'] ?? '') == 'Jawa Timur' ? 'selected' : '' }}>
                                                                Jawa Timur</option>
                                                            <option value="lainnya"
                                                                {{ ($tkp['provinsi'] ?? '') == 'lainnya' ? 'selected' : '' }}>
                                                                Lainnya</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                                                        <select name="tkp_kabupaten_narapidana[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kabupaten-narapidana">
                                                            <option value="">Pilih Kabupaten</option>
                                                            @if (isset($kabupatenList))
                                                                @foreach ($kabupatenList as $kab)
                                                                    <option value="{{ $kab }}"
                                                                        {{ ($tkp['kabupaten'] ?? '') == $kab ? 'selected' : '' }}>
                                                                        {{ $kab }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                                                        <select name="tkp_kecamatan_narapidana[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kecamatan-narapidana">
                                                            <option value="">Pilih Kecamatan</option>
                                                            @if (!empty($tkp['kecamatan']))
                                                                <option value="{{ $tkp['kecamatan'] }}" selected>
                                                                    {{ $tkp['kecamatan'] }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 mb-1">Desa/Kelurahan</label>
                                                        <select name="tkp_desa_narapidana[]"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-desa-narapidana">
                                                            <option value="">Pilih Desa/Kelurahan</option>
                                                            @if (!empty($tkp['desa']))
                                                                <option value="{{ $tkp['desa'] }}" selected>
                                                                    {{ $tkp['desa'] }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-600 mb-1">Detail
                                                            Lokasi</label>
                                                        <input type="text" name="tkp_lokasi_narapidana[]"
                                                            value="{{ $tkp['lokasi'] ?? '' }}"
                                                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                            placeholder="Detail Lokasi (opsional)">
                                                    </div>
                                                    <div class="flex justify-end">
                                                        <button type="button"
                                                            class="hapus-tkp-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                            title="Hapus TKP">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="p-3 border border-gray-200 rounded tkp-row-narapidana space-y-2">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                                                    <select name="tkp_provinsi_narapidana[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-provinsi-narapidana">
                                                        <option value="Jawa Timur">Jawa Timur</option>
                                                        <option value="lainnya">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                                                    <select name="tkp_kabupaten_narapidana[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kabupaten-narapidana">
                                                        <option value="">Pilih Kabupaten</option>
                                                        @if (isset($kabupatenList))
                                                            @foreach ($kabupatenList as $kab)
                                                                <option value="{{ $kab }}">
                                                                    {{ $kab }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                                                    <select name="tkp_kecamatan_narapidana[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kecamatan-narapidana">
                                                        <option value="">Pilih Kecamatan</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Desa/Kelurahan</label>
                                                    <select name="tkp_desa_narapidana[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-desa-narapidana">
                                                        <option value="">Pilih Desa/Kelurahan</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-600 mb-1">Detail
                                                        Lokasi</label>
                                                    <input type="text" name="tkp_lokasi_narapidana[]"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Detail Lokasi (opsional)">
                                                </div>
                                                <div class="flex justify-end">
                                                    <button type="button"
                                                        class="hapus-tkp-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus TKP">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" id="tambah-tkp-narapidana"
                                        class="mt-2 inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah TKP
                                    </button>
                                </div>
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

                            <!-- TKP Residivis -->
                            <div class="md:col-span-2" id="tkp-wrapper">
                                <div class="flex items-center justify-between mb-1">
                                    <label class="block text-sm font-medium text-black">TKP Residivis</label>
                                    <button type="button" id="tambah-tkp"
                                        class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition-colors">
                                        <i class="fas fa-plus mr-1"></i>
                                        Tambah TKP
                                    </button>
                                </div>
                                <div id="tkp-fields">
                                    @if ($individu->tkpResidivis && $individu->tkpResidivis->count() > 0)
                                        @foreach ($individu->tkpResidivis as $tkp)
                                            <div
                                                class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2 tkp-row border border-gray-200 p-3 rounded">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                                                    <input type="text" name="tkp_provinsi[]"
                                                        value="{{ $tkp->provinsi }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Provinsi">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                                                    <input type="text" name="tkp_kabupaten[]"
                                                        value="{{ $tkp->kabupaten }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Kabupaten">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                                                    <input type="text" name="tkp_kecamatan[]"
                                                        value="{{ $tkp->kecamatan }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Kecamatan">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Desa</label>
                                                    <input type="text" name="tkp_desa[]"
                                                        value="{{ $tkp->desa }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Desa">
                                                </div>
                                                <div class="md:col-span-2">
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 mb-1">Lokasi</label>
                                                    <input type="text" name="tkp_lokasi[]"
                                                        value="{{ $tkp->lokasi }}"
                                                        class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                        placeholder="Lokasi detail">
                                                </div>
                                                <div class="md:col-span-2 flex justify-end">
                                                    <button type="button"
                                                        class="hapus-tkp bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                        title="Hapus TKP">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2 tkp-row border border-gray-200 p-3 rounded">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                                                <input type="text" name="tkp_provinsi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Provinsi">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                                                <input type="text" name="tkp_kabupaten[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Kabupaten">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                                                <input type="text" name="tkp_kecamatan[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Kecamatan">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Desa</label>
                                                <input type="text" name="tkp_desa[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Desa">
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-xs font-medium text-gray-600 mb-1">Lokasi</label>
                                                <input type="text" name="tkp_lokasi[]"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                                                    placeholder="Lokasi detail">
                                            </div>
                                            <div class="md:col-span-2 flex justify-end">
                                                <button type="button"
                                                    class="hapus-tkp bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                                                    title="Hapus TKP">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
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

            // Handle Status Selection - Show/Hide Detail Fields
            const statusSelect = document.getElementById('status');
            const voluntaryDetail = document.getElementById('voluntary-detail');
            const compulsaryDetail = document.getElementById('compulsary-detail');
            const prosesHukumDetail = document.getElementById('prosesHukum-detail');
            const narapidanaDetail = document.getElementById('narapidana-detail');

            // Function to show/hide status detail
            function handleStatusChange() {
                const selectedValue = statusSelect.value;
                console.log('Status selected:', selectedValue); // Debug log

                // Hide all details first
                voluntaryDetail.classList.add('hidden');
                compulsaryDetail.classList.add('hidden');
                prosesHukumDetail.classList.add('hidden');
                narapidanaDetail.classList.add('hidden');

                // Show detail based on selected status
                if (selectedValue === 'Voluntary') {
                    voluntaryDetail.classList.remove('hidden');
                    console.log('Showing Voluntary detail');
                } else if (selectedValue === 'Compulsary') {
                    compulsaryDetail.classList.remove('hidden');
                    console.log('Showing Compulsary detail');
                } else if (selectedValue === 'Proses Hukum Lanjut') {
                    prosesHukumDetail.classList.remove('hidden');
                    console.log('Showing Proses Hukum detail');
                } else if (selectedValue === 'Narapidana') {
                    narapidanaDetail.classList.remove('hidden');
                    console.log('Showing Narapidana detail');
                }
            }

            // Event listener for status select
            statusSelect?.addEventListener('change', handleStatusChange);

            // Initialize on page load - show detail if status already selected
            if (statusSelect && statusSelect.value) {
                handleStatusChange();
            }

            // Dynamic field handlers for Compulsary
            // Tambah No Kasus
            document.getElementById('tambah-noKasus')?.addEventListener('click', function() {
                const container = document.getElementById('compulsary-noKasus-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="no_kasus[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan nomor kasus">
               <button type="button" class="hapus-noKasus bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Tambah APH
            document.getElementById('tambah-aph')?.addEventListener('click', function() {
                const container = document.getElementById('compulsary-aph-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="aph_menangani[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan APH yang menangani">
               <button type="button" class="hapus-aph bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Tambah Pasal
            document.getElementById('tambah-pasal')?.addEventListener('click', function() {
                const container = document.getElementById('compulsary-pasal-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="pasal_disangkakan[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan pasal yang disangkakan">
               <button type="button" class="hapus-pasal bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Tambah Rekomendasi
            document.getElementById('tambah-rekomendasi')?.addEventListener('click', function() {
                const container = document.getElementById('compulsary-rekomendasi-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="rekomendasi[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan rekomendasi">
               <button type="button" class="hapus-rekomendasi bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Dynamic field handlers for Proses Hukum
            // Tambah No Kasus Proses
            document.getElementById('tambah-noKasus-proses')?.addEventListener('click', function() {
                const container = document.getElementById('prosesHukum-noKasus-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="no_kasus_proses[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan nomor kasus">
               <button type="button" class="hapus-noKasus-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Tambah APH Proses
            document.getElementById('tambah-aph-proses')?.addEventListener('click', function() {
                const container = document.getElementById('prosesHukum-aph-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="aph_menangani_proses[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan APH yang menangani">
               <button type="button" class="hapus-aph-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Tambah Pasal Proses
            document.getElementById('tambah-pasal-proses')?.addEventListener('click', function() {
                const container = document.getElementById('prosesHukum-pasal-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="pasal_disangkakan_proses[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan pasal yang disangkakan">
               <button type="button" class="hapus-pasal-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Tambah Rekomendasi Proses
            document.getElementById('tambah-rekomendasi-proses')?.addEventListener('click', function() {
                const container = document.getElementById('prosesHukum-rekomendasi-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="rekomendasi_proses[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan rekomendasi">
               <button type="button" class="hapus-rekomendasi-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Dynamic field handlers for Narapidana
            // Tambah No Kasus Narapidana
            document.getElementById('tambah-noKasus-narapidana')?.addEventListener('click', function() {
                const container = document.getElementById('narapidana-noKasus-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="no_kasus_narapidana[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan nomor kasus">
               <button type="button" class="hapus-noKasus-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Tambah APH Narapidana
            document.getElementById('tambah-aph-narapidana')?.addEventListener('click', function() {
                const container = document.getElementById('narapidana-aph-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="aph_menangani_narapidana[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan APH yang menangani">
               <button type="button" class="hapus-aph-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Tambah Pasal Narapidana
            document.getElementById('tambah-pasal-narapidana')?.addEventListener('click', function() {
                const container = document.getElementById('narapidana-pasal-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="pasal_disangkakan_narapidana[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan pasal yang disangkakan">
               <button type="button" class="hapus-pasal-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Tambah Rekomendasi Narapidana
            document.getElementById('tambah-rekomendasi-narapidana')?.addEventListener('click', function() {
                const container = document.getElementById('narapidana-rekomendasi-container');
                if (container) {
                    const newField = document.createElement('div');
                    newField.className = 'flex items-center gap-2';
                    newField.innerHTML = `
               <input type="text" name="rekomendasi_narapidana[]"
                   class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                   placeholder="Masukkan rekomendasi">
               <button type="button" class="hapus-rekomendasi-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                   </svg>
               </button>
           `;
                    container.appendChild(newField);
                }
            });

            // Event delegation for delete buttons - All status types
            document.addEventListener('click', function(e) {
                // Compulsary delete buttons
                if (e.target.closest('.hapus-noKasus')) {
                    e.target.closest('.flex').remove();
                }
                if (e.target.closest('.hapus-aph')) {
                    e.target.closest('.flex').remove();
                }
                if (e.target.closest('.hapus-pasal')) {
                    e.target.closest('.flex').remove();
                }
                if (e.target.closest('.hapus-rekomendasi')) {
                    e.target.closest('.flex').remove();
                }

                // Proses Hukum delete buttons
                if (e.target.closest('.hapus-noKasus-proses')) {
                    e.target.closest('.flex').remove();
                }
                if (e.target.closest('.hapus-aph-proses')) {
                    e.target.closest('.flex').remove();
                }
                if (e.target.closest('.hapus-pasal-proses')) {
                    e.target.closest('.flex').remove();
                }
                if (e.target.closest('.hapus-rekomendasi-proses')) {
                    e.target.closest('.flex').remove();
                }

                // Narapidana delete buttons
                if (e.target.closest('.hapus-noKasus-narapidana')) {
                    e.target.closest('.flex').remove();
                }
                if (e.target.closest('.hapus-aph-narapidana')) {
                    e.target.closest('.flex').remove();
                }
                if (e.target.closest('.hapus-pasal-narapidana')) {
                    e.target.closest('.flex').remove();
                }
                if (e.target.closest('.hapus-rekomendasi-narapidana')) {
                    e.target.closest('.flex').remove();
                }

                // TKP delete buttons
                if (e.target.closest('.hapus-tkp')) {
                    e.target.closest('.tkp-row').remove();
                }
                if (e.target.closest('.hapus-tkp-compulsary')) {
                    const row = e.target.closest('.tkp-row-compulsary');
                    if (row) row.remove();
                }
                if (e.target.closest('.hapus-tkp-proses')) {
                    const row = e.target.closest('.tkp-row-proses');
                    if (row) row.remove();
                }
                if (e.target.closest('.hapus-tkp-narapidana')) {
                    const row = e.target.closest('.tkp-row-narapidana');
                    if (row) row.remove();
                }
            });

            // Tambah TKP for Compulsary
            document.getElementById('tambah-tkp-compulsary')?.addEventListener('click', function() {
                const container = document.getElementById('compulsary-tkp-container');
                const newRow = document.createElement('div');
                newRow.className = 'p-3 border border-gray-200 rounded tkp-row-compulsary space-y-2';
                newRow.innerHTML = `
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                        <select name="tkp_provinsi[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-provinsi-compulsary">
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                        <select name="tkp_kabupaten[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kabupaten-compulsary">
                            <option value="">Pilih Kabupaten</option>
                            @if (isset($kabupatenList))
                                @foreach ($kabupatenList as $kab)
                                    <option value="{{ $kab }}">{{ $kab }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                        <select name="tkp_kecamatan[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kecamatan-compulsary">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Desa/Kelurahan</label>
                        <select name="tkp_desa[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-desa-compulsary">
                            <option value="">Pilih Desa/Kelurahan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Detail Lokasi</label>
                        <input type="text" name="tkp_lokasi[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Detail Lokasi (opsional)">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="hapus-tkp-compulsary bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus TKP">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                `;
                container.appendChild(newRow);
            });

            // Tambah TKP for Proses Hukum
            document.getElementById('tambah-tkp-proses')?.addEventListener('click', function() {
                const container = document.getElementById('prosesHukum-tkp-container');
                const newRow = document.createElement('div');
                newRow.className = 'p-3 border border-gray-200 rounded tkp-row-proses space-y-2';
                newRow.innerHTML = `
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                        <select name="tkp_provinsi_proses[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-provinsi-proses">
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                        <select name="tkp_kabupaten_proses[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kabupaten-proses">
                            <option value="">Pilih Kabupaten</option>
                            @if (isset($kabupatenList))
                                @foreach ($kabupatenList as $kab)
                                    <option value="{{ $kab }}">{{ $kab }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                        <select name="tkp_kecamatan_proses[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kecamatan-proses">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Desa/Kelurahan</label>
                        <select name="tkp_desa_proses[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-desa-proses">
                            <option value="">Pilih Desa/Kelurahan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Detail Lokasi</label>
                        <input type="text" name="tkp_lokasi_proses[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Detail Lokasi (opsional)">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="hapus-tkp-proses bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus TKP">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                `;
                container.appendChild(newRow);
            });

            // Tambah TKP for Narapidana
            document.getElementById('tambah-tkp-narapidana')?.addEventListener('click', function() {
                const container = document.getElementById('narapidana-tkp-container');
                const newRow = document.createElement('div');
                newRow.className = 'p-3 border border-gray-200 rounded tkp-row-narapidana space-y-2';
                newRow.innerHTML = `
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                        <select name="tkp_provinsi_narapidana[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-provinsi-narapidana">
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                        <select name="tkp_kabupaten_narapidana[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kabupaten-narapidana">
                            <option value="">Pilih Kabupaten</option>
                            @if (isset($kabupatenList))
                                @foreach ($kabupatenList as $kab)
                                    <option value="{{ $kab }}">{{ $kab }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                        <select name="tkp_kecamatan_narapidana[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-kecamatan-narapidana">
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Desa/Kelurahan</label>
                        <select name="tkp_desa_narapidana[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm tkp-desa-narapidana">
                            <option value="">Pilih Desa/Kelurahan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Detail Lokasi</label>
                        <input type="text" name="tkp_lokasi_narapidana[]" class="block w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="Detail Lokasi (opsional)">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="hapus-tkp-narapidana bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs" title="Hapus TKP">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                `;
                container.appendChild(newRow);
            });

            // Event delegation for TKP dropdown changes (Compulsary, Proses Hukum, Narapidana)
            document.addEventListener('change', function(e) {
                // Handle Kabupaten changes for all TKP types
                if (e.target.classList.contains('tkp-kabupaten-compulsary') ||
                    e.target.classList.contains('tkp-kabupaten-proses') ||
                    e.target.classList.contains('tkp-kabupaten-narapidana')) {

                    const kabupaten = e.target.value;
                    const tkpRow = e.target.closest(
                        '.tkp-row-compulsary, .tkp-row-proses, .tkp-row-narapidana');

                    if (tkpRow) {
                        const kecamatanSelect = tkpRow.querySelector('[name*="tkp_kecamatan"]');
                        const desaSelect = tkpRow.querySelector('[name*="tkp_desa"]');

                        if (kecamatanSelect) {
                            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        }
                        if (desaSelect) {
                            desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                        }

                        if (kabupaten) {
                            fetch(`/admin/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data && data.length > 0 && kecamatanSelect) {
                                        data.forEach(kecamatan => {
                                            const option = document.createElement('option');
                                            option.value = kecamatan;
                                            option.textContent = kecamatan;
                                            kecamatanSelect.appendChild(option);
                                        });
                                    }
                                })
                                .catch(error => console.error('Error fetching kecamatan:', error));
                        }
                    }
                }

                // Handle Kecamatan changes for all TKP types
                if (e.target.classList.contains('tkp-kecamatan-compulsary') ||
                    e.target.classList.contains('tkp-kecamatan-proses') ||
                    e.target.classList.contains('tkp-kecamatan-narapidana')) {

                    const kecamatan = e.target.value;
                    const tkpRow = e.target.closest(
                        '.tkp-row-compulsary, .tkp-row-proses, .tkp-row-narapidana');

                    if (tkpRow) {
                        const kabupatenSelect = tkpRow.querySelector('[name*="tkp_kabupaten"]');
                        const desaSelect = tkpRow.querySelector('[name*="tkp_desa"]');
                        const kabupaten = kabupatenSelect ? kabupatenSelect.value : '';

                        if (desaSelect) {
                            desaSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                        }

                        if (kabupaten && kecamatan) {
                            fetch(
                                    `/admin/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`
                                )
                                .then(response => response.json())
                                .then(data => {
                                    if (data && data.length > 0 && desaSelect) {
                                        data.forEach(desa => {
                                            const option = document.createElement('option');
                                            option.value = desa;
                                            option.textContent = desa;
                                            desaSelect.appendChild(option);
                                        });
                                    }
                                })
                                .catch(error => console.error('Error fetching desa:', error));
                        }
                    }
                }
            });

            // Tambah TKP (legacy - for residivis section)
            document.getElementById('tambah-tkp')?.addEventListener('click', function() {
                const container = document.getElementById('tkp-fields');
                const newRow = document.createElement('div');
                newRow.className =
                    'grid grid-cols-1 md:grid-cols-2 gap-2 mt-2 tkp-row border border-gray-200 p-3 rounded';
                newRow.innerHTML = `
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Provinsi</label>
                        <input type="text" name="tkp_provinsi[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                            placeholder="Provinsi">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kabupaten</label>
                        <input type="text" name="tkp_kabupaten[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                            placeholder="Kabupaten">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Kecamatan</label>
                        <input type="text" name="tkp_kecamatan[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                            placeholder="Kecamatan">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Desa</label>
                        <input type="text" name="tkp_desa[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                            placeholder="Desa">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Lokasi</label>
                        <input type="text" name="tkp_lokasi[]"
                            class="block w-full rounded-md border-gray-300 shadow-sm text-sm"
                            placeholder="Lokasi detail">
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        <button type="button"
                            class="hapus-tkp bg-red-100 hover:bg-red-200 text-red-600 rounded-full w-6 h-6 flex items-center justify-center text-xs"
                            title="Hapus TKP">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                `;
                container.appendChild(newRow);
            });
        });
    </script>
@endsection
