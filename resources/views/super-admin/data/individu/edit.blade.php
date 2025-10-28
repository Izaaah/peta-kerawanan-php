@extends('layouts.superadmin-master')

@section('title', 'Edit Data Individu TSK')

@section('content')
    <div class="mx-auto px-4 py-3">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 light:text-white">Edit Data Profil Individu</h1>
                <p class="text-sm text-gray-500">Silahkan edit data individu dengan informasi yang akurat.</p>
            </div>
            <a href="{{ route('super-admin.data.individu') }}"
                class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md shadow">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="">
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
                                <ul class="mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('super-admin.data.individu.update', $individu->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Data Pribadi -->
                            <div class="mb-6">
                                <h3 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">Data Pribadi</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Lengkap
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="nama" name="nama"
                                            value="{{ old('nama', $individu->nama) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>
                                    </div>
                                    <div>
                                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="nik" name="nik"
                                            value="{{ old('nik', $individu->nik) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>
                                    </div>
                                    <div>
                                        <label for="nkk" class="block text-sm font-medium text-gray-700 mb-1">NKK
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="nkk" name="nkk"
                                            value="{{ old('nkk', $individu->nkk) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>
                                    </div>
                                    <div>
                                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            Lengkap
                                            <span class="text-red-500">*</span></label>
                                        <textarea id="alamat" name="alamat" rows="2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>{{ old('alamat', $individu->alamat) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Lokasi -->
                            <div class="mb-6">
                                <h3 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">Data Lokasi</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div>
                                        <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="provinsi" name="provinsi"
                                            value="{{ old('provinsi', $individu->provinsi) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>
                                    </div>
                                    <div>
                                        <label for="kabupaten"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota
                                            <span class="text-red-500">*</span></label>
                                        <select id="kabupaten" name="kabupaten"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>
                                            <option value="">Pilih Kabupaten/Kota</option>
                                            @foreach ($kabupatenList as $kabupaten)
                                                <option value="{{ $kabupaten }}"
                                                    {{ old('kabupaten', $individu->kabupaten) == $kabupaten ? 'selected' : '' }}>
                                                    {{ $kabupaten }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="kecamatan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kecamatan
                                            <span class="text-red-500">*</span></label>
                                        <select id="kecamatan" name="kecamatan"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>
                                            <option value="">Pilih Kecamatan</option>
                                            @foreach ($kecamatanList as $kecamatan)
                                                <option value="{{ $kecamatan }}"
                                                    {{ old('kecamatan', $individu->kecamatan) == $kecamatan ? 'selected' : '' }}>
                                                    {{ $kecamatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="kelurahan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kelurahan/Desa
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="kelurahan" name="kelurahan"
                                            value="{{ old('kelurahan', $individu->kelurahan) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Keluarga -->
                            <div class="mb-6">
                                <h3 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">Data Keluarga</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Ayah</label>
                                        <input type="text" id="nama_ayah" name="nama_ayah"
                                            value="{{ old('nama_ayah', $individu->nama_ayah) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label for="nik_ayah" class="block text-sm font-medium text-gray-700 mb-1">NIK
                                            Ayah</label>
                                        <input type="text" id="nik_ayah" name="nik_ayah"
                                            value="{{ old('nik_ayah', $individu->nik_ayah) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Ibu</label>
                                        <input type="text" id="nama_ibu" name="nama_ibu"
                                            value="{{ old('nama_ibu', $individu->nama_ibu) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label for="nik_ibu" class="block text-sm font-medium text-gray-700 mb-1">NIK
                                            Ibu</label>
                                        <input type="text" id="nik_ibu" name="nik_ibu"
                                            value="{{ old('nik_ibu', $individu->nik_ibu) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Data Jaringan -->
                            <div class="mb-6">
                                <h3 class="text-md font-semibold text-gray-700 mb-3 border-b pb-2">Data Jaringan</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="peran_jaringan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Peran dalam
                                            Jaringan</label>
                                        <select id="peran_jaringan" name="peran_jaringan"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Pilih Peran</option>
                                            <option value="koordinator informan"
                                                {{ old('peran_jaringan', $individu->peran_jaringan) == 'koordinator informan' ? 'selected' : '' }}>
                                                Koordinator Informan</option>
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
                                            <option value="tidak tahu"
                                                {{ old('peran_jaringan', $individu->peran_jaringan) == 'tidak tahu' ? 'selected' : '' }}>
                                                Tidak Tahu</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="status"
                                            class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                        <select id="status" name="status"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Pilih Status</option>
                                            <option value="Voluntary"
                                                {{ old('status', $individu->status) == 'Voluntary' ? 'selected' : '' }}>
                                                Voluntary (Sukarela)</option>
                                            <option value="Compulsory"
                                                {{ old('status', $individu->status) == 'Compulsory' ? 'selected' : '' }}>
                                                Compulsory (Upaya Paksa)</option>
                                            <option value="Proses Hukum Lanjut"
                                                {{ old('status', $individu->status) == 'Proses Hukum Lanjut' ? 'selected' : '' }}>
                                                Proses Hukum Lanjut</option>
                                            <option value="Narapidana"
                                                {{ old('status', $individu->status) == 'Narapidana' ? 'selected' : '' }}>
                                                Narapidana</option>
                                            <option value="Napi"
                                                {{ old('status', $individu->status) == 'Napi' ? 'selected' : '' }}>Napi
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="modus_operasi"
                                            class="block text-sm font-medium text-gray-700 mb-1">Modus Operasi</label>
                                        <textarea id="modus_operasi" name="modus_operasi" rows="2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('modus_operasi', $individu->modus_operasi) }}</textarea>
                                    </div>
                                    <div>
                                        <label for="jenis_narkotika"
                                            class="block text-sm font-medium text-gray-700 mb-1">Jenis Narkotika</label>
                                        <input type="text" id="jenis_narkotika" name="jenis_narkotika"
                                            value="{{ old('jenis_narkotika', $individu->jenis_narkotika) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label for="skala_kelas"
                                            class="block text-sm font-medium text-gray-700 mb-1">Skala Kelas</label>
                                        <input type="text" id="skala_kelas" name="skala_kelas"
                                            value="{{ old('skala_kelas', $individu->skala_kelas) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label for="sumber_informasi"
                                            class="block text-sm font-medium text-gray-700 mb-1">Sumber Informasi</label>
                                        <select id="sumber_informasi" name="sumber_informasi"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="">Pilih Sumber</option>
                                            <option value="informan"
                                                {{ old('sumber_informasi', $individu->sumber_informasi) == 'informan' ? 'selected' : '' }}>
                                                Informan</option>
                                            <option value="analisa sosmed"
                                                {{ old('sumber_informasi', $individu->sumber_informasi) == 'analisa sosmed' ? 'selected' : '' }}>
                                                Analisa Sosmed</option>
                                            <option value="analisa aliran dana"
                                                {{ old('sumber_informasi', $individu->sumber_informasi) == 'analisa aliran dana' ? 'selected' : '' }}>
                                                Analisa Aliran Dana</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="residivis" value="1"
                                            {{ old('residivis', $individu->residivis) ? 'checked' : '' }}
                                            class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm font-medium text-gray-700">Residivis</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('super-admin.data.individu') }}"
                                    class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-save mr-2"></i>Update Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-2">
                    <div class="bg-white light:bg-gray-800 shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi</h3>
                        <div class="space-y-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                <span>Pastikan data yang diisi sudah benar dan akurat</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-exclamation-triangle mr-2 text-yellow-500"></i>
                                <span>Field dengan tanda (*) wajib diisi</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                                <span>Data akan tersimpan dengan aman</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
