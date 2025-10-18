@extends('layouts.admin-master')

@section('title', 'Tambah Objek Vital')

@section('content')
    <!-- Include responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-data-responsive.css') }}">

    <style>
        .form-section {
            transition: all 0.3s ease-in-out;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section.hidden {
            display: none;
        }

        /* Visual indicator for filled inputs */
        input.bg-green-50,
        textarea.bg-green-50 {
            border-width: 2px;
        }
    </style>

    <div class="mx-auto px-2 lg:px-4 py-3">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
            <div>
                <h1 class="text-xl lg:text-2xl font-semibold text-gray-800">Tambah Objek Vital</h1>
                <p class="text-xs lg:text-sm text-gray-500">Form untuk input data objek vital</p>
            </div>
            <a href="{{ route('admin.data.objekvital.index') }}"
                class="inline-flex items-center px-3 lg:px-4 py-2 text-xs lg:text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700 whitespace-nowrap">
                <i class="fas fa-arrow-left mr-1"></i><span class="hidden sm:inline">Kembali</span><span
                    class="sm:hidden">←</span>
            </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 max-w-9xl mx-auto">
            <div class="order-2 lg:order-1 lg:col-span-2">
                <form action="{{ route('admin.data.objekvital.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="bg-white shadow rounded p-6 space-y-4">
                        <!-- Dropdown Navigasi Jenis Objek Vital -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg border-l-4 border-blue-500">
                            <label for="jenis_objek_nav" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-list mr-2"></i>Pilih Jenis untuk Input Data
                            </label>
                            <select id="jenis_objek_nav"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <option value="Industri">Industri</option>
                                <option value="Pertambangan dan Energi">Pertambangan dan Energi</option>
                                <option value="Perhubungan">Perhubungan</option>
                                <option value="Instalasi dan Bangunan">Instalasi dan Bangunan</option>
                                <option value="Perbankan dan Keuangan">Perbankan dan Keuangan</option>
                                <option value="Lembaga Negara">Lembaga Negara</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>Isi data untuk setiap jenis, semua akan disimpan
                                sekaligus
                            </p>
                        </div>

                        <!-- Form Section untuk Industri -->
                        <div id="form-Industri" class="form-section">
                            <h6 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b-2 border-blue-500">
                                <i class="fas fa-industry mr-2"></i>Data Industri
                            </h6>

                            <!-- Dropdown Sub-Option untuk Industri -->
                            <div class="mb-4">
                                <label for="industri_sub_option" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-list mr-2"></i>Pilih Jenis Industri
                                </label>
                                <div class="flex gap-2">
                                    <select id="industri_sub_option"
                                        class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">-- Pilih Jenis Industri --</option>
                                        <option value="pabrik_kimia">Pabrik Kimia</option>
                                        <option value="farmasi">Farmasi</option>
                                        <option value="tekstil">Tekstil</option>
                                        <option value="makanan">Makanan & Minuman</option>
                                        <option value="otomotif">Otomotif</option>
                                        <option value="elektronik">Elektronik</option>
                                    </select>
                                    <button type="button" onclick="addNewIndustriType()"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 whitespace-nowrap">
                                        <i class="fas fa-plus mr-1"></i>Tambah Jenis
                                    </button>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Pabrik Kimia -->
                            <div id="industri-pabrik_kimia-fields" class="industri-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Pabrik Kimia</label>
                                        <input type="text" name="industri[pabrik_kimia_nama]"
                                            value="{{ old('industri.pabrik_kimia_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="industri[pabrik_kimia_manager]"
                                            value="{{ old('industri.pabrik_kimia_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="industri[pabrik_kimia_no_hp]"
                                            value="{{ old('industri.pabrik_kimia_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Produk</label>
                                        <input type="text" name="industri[pabrik_kimia_produk]"
                                            value="{{ old('industri.pabrik_kimia_produk') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Pupuk, Plastik, Cat">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Farmasi -->
                            <div id="industri-farmasi-fields" class="industri-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan
                                            Farmasi</label>
                                        <input type="text" name="industri[farmasi_nama]"
                                            value="{{ old('industri.farmasi_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="industri[farmasi_manager]"
                                            value="{{ old('industri.farmasi_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="industri[farmasi_no_hp]"
                                            value="{{ old('industri.farmasi_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Produk</label>
                                        <input type="text" name="industri[farmasi_produk]"
                                            value="{{ old('industri.farmasi_produk') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Obat-obatan, Vitamin, Kosmetik">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Tekstil -->
                            <div id="industri-tekstil-fields" class="industri-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Pabrik Tekstil</label>
                                        <input type="text" name="industri[tekstil_nama]"
                                            value="{{ old('industri.tekstil_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="industri[tekstil_manager]"
                                            value="{{ old('industri.tekstil_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="industri[tekstil_no_hp]"
                                            value="{{ old('industri.tekstil_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Produk</label>
                                        <input type="text" name="industri[tekstil_produk]"
                                            value="{{ old('industri.tekstil_produk') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Kain, Pakaian, Seragam">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Makanan -->
                            <div id="industri-makanan-fields" class="industri-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan
                                            Makanan</label>
                                        <input type="text" name="industri[makanan_nama]"
                                            value="{{ old('industri.makanan_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="industri[makanan_manager]"
                                            value="{{ old('industri.makanan_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="industri[makanan_no_hp]"
                                            value="{{ old('industri.makanan_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Produk</label>
                                        <input type="text" name="industri[makanan_produk]"
                                            value="{{ old('industri.makanan_produk') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Snack, Minuman, Makanan Kaleng">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Otomotif -->
                            <div id="industri-otomotif-fields" class="industri-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan
                                            Otomotif</label>
                                        <input type="text" name="industri[otomotif_nama]"
                                            value="{{ old('industri.otomotif_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="industri[otomotif_manager]"
                                            value="{{ old('industri.otomotif_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="industri[otomotif_no_hp]"
                                            value="{{ old('industri.otomotif_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Produk</label>
                                        <input type="text" name="industri[otomotif_produk]"
                                            value="{{ old('industri.otomotif_produk') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Mobil, Motor, Sparepart">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Elektronik -->
                            <div id="industri-elektronik-fields" class="industri-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan
                                            Elektronik</label>
                                        <input type="text" name="industri[elektronik_nama]"
                                            value="{{ old('industri.elektronik_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="industri[elektronik_manager]"
                                            value="{{ old('industri.elektronik_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="industri[elektronik_no_hp]"
                                            value="{{ old('industri.elektronik_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Produk</label>
                                        <input type="text" name="industri[elektronik_produk]"
                                            value="{{ old('industri.elektronik_produk') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Handphone, Laptop, TV">
                                    </div>
                                </div>
                            </div>

                            <!-- Container for Dynamically Added Types -->
                            <div id="industri-dynamic-container"></div>

                            <!-- Address Section untuk Industri (Shared for all sub-options) -->
                            <div id="industri-address-section" class="mb-4 hidden">
                                <h6 class="text-md font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat Industri
                                </h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="industri_provinsi"
                                            class="block text-sm font-medium text-gray-700">Provinsi</label>
                                        <select name="industri[provinsi]" id="industri_provinsi"
                                            class="provinsi-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Provinsi</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div id="industri-wilayah-jatim" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label for="industri_kabupaten"
                                                    class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                                                <select name="industri[kabupaten]" id="industri_kabupaten"
                                                    class="kabupaten-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="industri_kecamatan"
                                                    class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <select name="industri[kecamatan]" id="industri_kecamatan"
                                                    class="kecamatan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="industri_kelurahan"
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <select name="industri[kelurahan]" id="industri_kelurahan"
                                                    class="kelurahan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kelurahan/Desa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="industri-wilayah-lainnya" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                                                <input type="text" name="industri[provinsi_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Provinsi">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                                                <input type="text" name="industri[kabupaten_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kabupaten">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <input type="text" name="industri[kecamatan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kecamatan">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <input type="text" name="industri[kelurahan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kelurahan/Desa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="industri_alamat"
                                            class="block text-sm font-medium text-gray-700">Alamat
                                            Lengkap (Jalan/RT/RW)</label>
                                        <textarea name="industri[alamat]" id="industri_alamat" rows="2"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('industri.alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Form Section untuk Pertambangan dan Energi -->
                        <div id="form-Pertambangan dan Energi" class="form-section hidden">
                            <h6 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b-2 border-green-500">
                                <i class="fas fa-bolt mr-2"></i>Data Pertambangan dan Energi
                            </h6>

                            <!-- Dropdown Sub-Option untuk Pertambangan -->
                            <div class="mb-4">
                                <label for="pertambangan_sub_option" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-list mr-2"></i>Pilih Jenis Pertambangan/Energi
                                </label>
                                <div class="flex gap-2">
                                    <select id="pertambangan_sub_option"
                                        class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">-- Pilih Jenis Pertambangan/Energi --</option>
                                        <option value="minyak_bumi">Minyak Bumi</option>
                                        <option value="gas_alam">Gas Alam</option>
                                        <option value="listrik">Listrik</option>
                                        <option value="batubara">Batubara</option>
                                        <option value="emas">Emas</option>
                                        <option value="nikel">Nikel</option>
                                    </select>
                                    <button type="button" onclick="addNewPertambanganType()"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 whitespace-nowrap">
                                        <i class="fas fa-plus mr-1"></i>Tambah Jenis
                                    </button>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Minyak Bumi -->
                            <div id="pertambangan-minyak_bumi-fields" class="pertambangan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan
                                            Minyak</label>
                                        <input type="text" name="pertambangan[minyak_bumi_nama]"
                                            value="{{ old('pertambangan.minyak_bumi_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="pertambangan[minyak_bumi_manager]"
                                            value="{{ old('pertambangan.minyak_bumi_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="pertambangan[minyak_bumi_no_hp]"
                                            value="{{ old('pertambangan.minyak_bumi_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas Produksi</label>
                                        <input type="text" name="pertambangan[minyak_bumi_kapasitas]"
                                            value="{{ old('pertambangan.minyak_bumi_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 1000 BPH">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Gas Alam -->
                            <div id="pertambangan-gas_alam-fields" class="pertambangan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan Gas</label>
                                        <input type="text" name="pertambangan[gas_alam_nama]"
                                            value="{{ old('pertambangan.gas_alam_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="pertambangan[gas_alam_manager]"
                                            value="{{ old('pertambangan.gas_alam_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="pertambangan[gas_alam_no_hp]"
                                            value="{{ old('pertambangan.gas_alam_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas Produksi</label>
                                        <input type="text" name="pertambangan[gas_alam_kapasitas]"
                                            value="{{ old('pertambangan.gas_alam_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 500 MMSCFD">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Listrik -->
                            <div id="pertambangan-listrik-fields" class="pertambangan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Pembangkit
                                            Listrik</label>
                                        <input type="text" name="pertambangan[listrik_nama]"
                                            value="{{ old('pertambangan.listrik_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="pertambangan[listrik_manager]"
                                            value="{{ old('pertambangan.listrik_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="pertambangan[listrik_no_hp]"
                                            value="{{ old('pertambangan.listrik_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas Pembangkit</label>
                                        <input type="text" name="pertambangan[listrik_kapasitas]"
                                            value="{{ old('pertambangan.listrik_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 100 MW">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Batubara -->
                            <div id="pertambangan-batubara-fields" class="pertambangan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Tambang
                                            Batubara</label>
                                        <input type="text" name="pertambangan[batubara_nama]"
                                            value="{{ old('pertambangan.batubara_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="pertambangan[batubara_manager]"
                                            value="{{ old('pertambangan.batubara_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="pertambangan[batubara_no_hp]"
                                            value="{{ old('pertambangan.batubara_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas Produksi</label>
                                        <input type="text" name="pertambangan[batubara_kapasitas]"
                                            value="{{ old('pertambangan.batubara_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 1000 ton/hari">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Emas -->
                            <div id="pertambangan-emas-fields" class="pertambangan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Tambang Emas</label>
                                        <input type="text" name="pertambangan[emas_nama]"
                                            value="{{ old('pertambangan.emas_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="pertambangan[emas_manager]"
                                            value="{{ old('pertambangan.emas_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="pertambangan[emas_no_hp]"
                                            value="{{ old('pertambangan.emas_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas Produksi</label>
                                        <input type="text" name="pertambangan[emas_kapasitas]"
                                            value="{{ old('pertambangan.emas_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 100 kg/bulan">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Nikel -->
                            <div id="pertambangan-nikel-fields" class="pertambangan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Tambang Nikel</label>
                                        <input type="text" name="pertambangan[nikel_nama]"
                                            value="{{ old('pertambangan.nikel_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="pertambangan[nikel_manager]"
                                            value="{{ old('pertambangan.nikel_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="pertambangan[nikel_no_hp]"
                                            value="{{ old('pertambangan.nikel_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas Produksi</label>
                                        <input type="text" name="pertambangan[nikel_kapasitas]"
                                            value="{{ old('pertambangan.nikel_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 5000 ton/bulan">
                                    </div>
                                </div>
                            </div>

                            <!-- Container for Dynamically Added Types -->
                            <div id="pertambangan-dynamic-container"></div>

                            <!-- Address Section untuk Pertambangan (Shared for all sub-options) -->
                            <div id="pertambangan-address-section" class="mb-4 hidden">
                                <h6 class="text-md font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat Pertambangan dan Energi
                                </h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="pertambangan_provinsi"
                                            class="block text-sm font-medium text-gray-700">Provinsi</label>
                                        <select name="pertambangan[provinsi]" id="pertambangan_provinsi"
                                            class="provinsi-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Provinsi</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div id="pertambangan-wilayah-jatim" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label for="pertambangan_kabupaten"
                                                    class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                                                <select name="pertambangan[kabupaten]" id="pertambangan_kabupaten"
                                                    class="kabupaten-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="pertambangan_kecamatan"
                                                    class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <select name="pertambangan[kecamatan]" id="pertambangan_kecamatan"
                                                    class="kecamatan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="pertambangan_kelurahan"
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <select name="pertambangan[kelurahan]" id="pertambangan_kelurahan"
                                                    class="kelurahan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kelurahan/Desa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="pertambangan-wilayah-lainnya" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                                                <input type="text" name="pertambangan[provinsi_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Provinsi">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                                                <input type="text" name="pertambangan[kabupaten_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kabupaten">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <input type="text" name="pertambangan[kecamatan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kecamatan">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <input type="text" name="pertambangan[kelurahan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kelurahan/Desa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="pertambangan_alamat"
                                            class="block text-sm font-medium text-gray-700">Alamat Lengkap
                                            (Jalan/RT/RW)</label>
                                        <textarea name="pertambangan[alamat]" id="pertambangan_alamat" rows="2"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('pertambangan.alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Form Section untuk Perhubungan -->
                        <div id="form-Perhubungan" class="form-section hidden">
                            <h6 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b-2 border-yellow-500">
                                <i class="fas fa-plane mr-2"></i>Data Perhubungan
                            </h6>

                            <!-- Dropdown Sub-Option untuk Perhubungan -->
                            <div class="mb-4">
                                <label for="perhubungan_sub_option" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-list mr-2"></i>Pilih Jenis Perhubungan
                                </label>
                                <div class="flex gap-2">
                                    <select id="perhubungan_sub_option"
                                        class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">-- Pilih Jenis Perhubungan --</option>
                                        <option value="bandara">Bandara</option>
                                        <option value="pelabuhan">Pelabuhan</option>
                                        <option value="terminal">Terminal Bus</option>
                                        <option value="stasiun">Stasiun Kereta</option>
                                        <option value="tol">Jalan Tol</option>
                                        <option value="pelabuhan_udara">Pelabuhan Udara</option>
                                    </select>
                                    <button type="button" onclick="addNewPerhubunganType()"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 whitespace-nowrap">
                                        <i class="fas fa-plus mr-1"></i>Tambah Jenis
                                    </button>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Bandara -->
                            <div id="perhubungan-bandara-fields" class="perhubungan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Bandara</label>
                                        <input type="text" name="perhubungan[bandara_nama]"
                                            value="{{ old('perhubungan.bandara_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perhubungan[bandara_manager]"
                                            value="{{ old('perhubungan.bandara_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perhubungan[bandara_no_hp]"
                                            value="{{ old('perhubungan.bandara_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                        <input type="text" name="perhubungan[bandara_kapasitas]"
                                            value="{{ old('perhubungan.bandara_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 5 juta penumpang/tahun">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Pelabuhan -->
                            <div id="perhubungan-pelabuhan-fields" class="perhubungan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Pelabuhan</label>
                                        <input type="text" name="perhubungan[pelabuhan_nama]"
                                            value="{{ old('perhubungan.pelabuhan_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perhubungan[pelabuhan_manager]"
                                            value="{{ old('perhubungan.pelabuhan_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perhubungan[pelabuhan_no_hp]"
                                            value="{{ old('perhubungan.pelabuhan_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                        <input type="text" name="perhubungan[pelabuhan_kapasitas]"
                                            value="{{ old('perhubungan.pelabuhan_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 1000 TEU/hari">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Terminal -->
                            <div id="perhubungan-terminal-fields" class="perhubungan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Terminal Bus</label>
                                        <input type="text" name="perhubungan[terminal_nama]"
                                            value="{{ old('perhubungan.terminal_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perhubungan[terminal_manager]"
                                            value="{{ old('perhubungan.terminal_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perhubungan[terminal_no_hp]"
                                            value="{{ old('perhubungan.terminal_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                        <input type="text" name="perhubungan[terminal_kapasitas]"
                                            value="{{ old('perhubungan.terminal_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 500 bus/hari">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Stasiun -->
                            <div id="perhubungan-stasiun-fields" class="perhubungan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Stasiun Kereta</label>
                                        <input type="text" name="perhubungan[stasiun_nama]"
                                            value="{{ old('perhubungan.stasiun_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perhubungan[stasiun_manager]"
                                            value="{{ old('perhubungan.stasiun_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perhubungan[stasiun_no_hp]"
                                            value="{{ old('perhubungan.stasiun_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                        <input type="text" name="perhubungan[stasiun_kapasitas]"
                                            value="{{ old('perhubungan.stasiun_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 10.000 penumpang/hari">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Tol -->
                            <div id="perhubungan-tol-fields" class="perhubungan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Jalan Tol</label>
                                        <input type="text" name="perhubungan[tol_nama]"
                                            value="{{ old('perhubungan.tol_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perhubungan[tol_manager]"
                                            value="{{ old('perhubungan.tol_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perhubungan[tol_no_hp]"
                                            value="{{ old('perhubungan.tol_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Panjang Ruas</label>
                                        <input type="text" name="perhubungan[tol_panjang]"
                                            value="{{ old('perhubungan.tol_panjang') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 50 km">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Pelabuhan Udara -->
                            <div id="perhubungan-pelabuhan_udara-fields" class="perhubungan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Pelabuhan Udara</label>
                                        <input type="text" name="perhubungan[pelabuhan_udara_nama]"
                                            value="{{ old('perhubungan.pelabuhan_udara_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perhubungan[pelabuhan_udara_manager]"
                                            value="{{ old('perhubungan.pelabuhan_udara_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perhubungan[pelabuhan_udara_no_hp]"
                                            value="{{ old('perhubungan.pelabuhan_udara_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                        <input type="text" name="perhubungan[pelabuhan_udara_kapasitas]"
                                            value="{{ old('perhubungan.pelabuhan_udara_kapasitas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: 2 juta penumpang/tahun">
                                    </div>
                                </div>
                            </div>

                            <!-- Container for Dynamically Added Types -->
                            <div id="perhubungan-dynamic-container"></div>

                            <!-- Address Section untuk Perhubungan (Shared for all sub-options) -->
                            <div id="perhubungan-address-section" class="mb-4 hidden">
                                <h6 class="text-md font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat Perhubungan
                                </h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="perhubungan_provinsi"
                                            class="block text-sm font-medium text-gray-700">Provinsi</label>
                                        <select name="perhubungan[provinsi]" id="perhubungan_provinsi"
                                            class="provinsi-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Provinsi</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div id="perhubungan-wilayah-jatim" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label for="perhubungan_kabupaten"
                                                    class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                                                <select name="perhubungan[kabupaten]" id="perhubungan_kabupaten"
                                                    class="kabupaten-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="perhubungan_kecamatan"
                                                    class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <select name="perhubungan[kecamatan]" id="perhubungan_kecamatan"
                                                    class="kecamatan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="perhubungan_kelurahan"
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <select name="perhubungan[kelurahan]" id="perhubungan_kelurahan"
                                                    class="kelurahan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kelurahan/Desa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="perhubungan-wilayah-lainnya" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                                                <input type="text" name="perhubungan[provinsi_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Provinsi">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                                                <input type="text" name="perhubungan[kabupaten_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kabupaten">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <input type="text" name="perhubungan[kecamatan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kecamatan">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <input type="text" name="perhubungan[kelurahan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kelurahan/Desa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="perhubungan_alamat"
                                            class="block text-sm font-medium text-gray-700">Alamat Lengkap
                                            (Jalan/RT/RW)</label>
                                        <textarea name="perhubungan[alamat]" id="perhubungan_alamat" rows="2"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('perhubungan.alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Form Section untuk Instalasi dan Bangunan -->
                        <div id="form-Instalasi dan Bangunan" class="form-section hidden">
                            <h6 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b-2 border-purple-500">
                                <i class="fas fa-building mr-2"></i>Data Instalasi dan Bangunan
                            </h6>

                            <!-- Dropdown Sub-Option -->
                            <div class="mb-4">
                                <label for="instalasi_sub_option" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-list mr-2"></i>Pilih Jenis Instalasi
                                </label>
                                <div class="flex gap-2">
                                    <select id="instalasi_sub_option"
                                        class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">-- Pilih Jenis Instalasi --</option>
                                        <option value="penginapan">Penginapan (Hotel/Kost)</option>
                                        <option value="thm">Tempat Hiburan Malam (THM)</option>
                                        <option value="vape">Penjual Vape</option>
                                    </select>
                                    <button type="button" onclick="addNewInstalasiType()"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 whitespace-nowrap">
                                        <i class="fas fa-plus mr-1"></i>Tambah Jenis
                                    </button>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Penginapan -->
                            <div id="instalasi-penginapan-fields" class="instalasi-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Penginapan</label>
                                        <input type="text" name="instalasi[penginapan_nama]"
                                            value="{{ old('instalasi.penginapan_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Pengelola</label>
                                        <input type="text" name="instalasi[penginapan_pengelola]"
                                            value="{{ old('instalasi.penginapan_pengelola') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP Penginapan</label>
                                        <input type="text" name="instalasi[penginapan_no_hp]"
                                            value="{{ old('instalasi.penginapan_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis</label>
                                        <select name="instalasi[penginapan_jenis]"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Jenis</option>
                                            <option value="Hotel">Hotel</option>
                                            <option value="Kost">Kost</option>
                                            <option value="Penginapan">Penginapan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for THM -->
                            <div id="instalasi-thm-fields" class="instalasi-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama THM</label>
                                        <input type="text" name="instalasi[thm_nama]"
                                            value="{{ old('instalasi.thm_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Ketua THM</label>
                                        <input type="text" name="instalasi[thm_ketua]"
                                            value="{{ old('instalasi.thm_ketua') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP Ketua THM</label>
                                        <input type="text" name="instalasi[thm_no_hp]"
                                            value="{{ old('instalasi.thm_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Alamat THM</label>
                                        <input type="text" name="instalasi[thm_alamat]"
                                            value="{{ old('instalasi.thm_alamat') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Vape -->
                            <div id="instalasi-vape-fields" class="instalasi-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Toko Vape</label>
                                        <input type="text" name="instalasi[vape_nama_toko]"
                                            value="{{ old('instalasi.vape_nama_toko') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Pemilik Toko Vape</label>
                                        <input type="text" name="instalasi[vape_pemilik]"
                                            value="{{ old('instalasi.vape_pemilik') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP Pemilik Vape</label>
                                        <input type="text" name="instalasi[vape_no_hp]"
                                            value="{{ old('instalasi.vape_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Lokasi Toko Vape</label>
                                        <input type="text" name="instalasi[vape_lokasi]"
                                            value="{{ old('instalasi.vape_lokasi') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Container for Dynamically Added Types -->
                            <div id="instalasi-dynamic-container"></div>

                            <!-- Address Section untuk Instalasi (Shared for all sub-options) -->
                            <div id="instalasi-address-section" class="mb-4 hidden">
                                <h6 class="text-md font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat Instalasi
                                </h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="instalasi_provinsi"
                                            class="block text-sm font-medium text-gray-700">Provinsi</label>
                                        <select name="instalasi[provinsi]" id="instalasi_provinsi"
                                            class="provinsi-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Provinsi</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div id="instalasi-wilayah-jatim" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label for="instalasi_kabupaten"
                                                    class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                                                <select name="instalasi[kabupaten]" id="instalasi_kabupaten"
                                                    class="kabupaten-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="instalasi_kecamatan"
                                                    class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <select name="instalasi[kecamatan]" id="instalasi_kecamatan"
                                                    class="kecamatan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="instalasi_kelurahan"
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <select name="instalasi[kelurahan]" id="instalasi_kelurahan"
                                                    class="kelurahan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kelurahan/Desa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="instalasi-wilayah-lainnya" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                                                <input type="text" name="instalasi[provinsi_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Provinsi">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                                                <input type="text" name="instalasi[kabupaten_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kabupaten">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <input type="text" name="instalasi[kecamatan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kecamatan">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <input type="text" name="instalasi[kelurahan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kelurahan/Desa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="instalasi_alamat"
                                            class="block text-sm font-medium text-gray-700">Alamat Lengkap
                                            (Jalan/RT/RW)</label>
                                        <textarea name="instalasi[alamat]" id="instalasi_alamat" rows="2"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('instalasi.alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Section untuk Perbankan dan Keuangan -->
                        <div id="form-Perbankan dan Keuangan" class="form-section hidden">
                            <h6 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b-2 border-indigo-500">
                                <i class="fas fa-university mr-2"></i>Data Perbankan dan Keuangan
                            </h6>

                            <!-- Dropdown Sub-Option untuk Perbankan -->
                            <div class="mb-4">
                                <label for="perbankan_sub_option" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-list mr-2"></i>Pilih Jenis Perbankan/Keuangan
                                </label>
                                <div class="flex gap-2">
                                    <select id="perbankan_sub_option"
                                        class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">-- Pilih Jenis Perbankan/Keuangan --</option>
                                        <option value="bank">Bank</option>
                                        <option value="koperasi">Koperasi</option>
                                        <option value="asuransi">Asuransi</option>
                                        <option value="leasing">Leasing</option>
                                        <option value="pegadaian">Pegadaian</option>
                                        <option value="fintech">Fintech</option>
                                    </select>
                                    <button type="button" onclick="addNewPerbankanType()"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 whitespace-nowrap">
                                        <i class="fas fa-plus mr-1"></i>Tambah Jenis
                                    </button>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Bank -->
                            <div id="perbankan-bank-fields" class="perbankan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Bank</label>
                                        <input type="text" name="perbankan[bank_nama]"
                                            value="{{ old('perbankan.bank_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perbankan[bank_manager]"
                                            value="{{ old('perbankan.bank_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perbankan[bank_no_hp]"
                                            value="{{ old('perbankan.bank_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Bank</label>
                                        <select name="perbankan[bank_jenis]"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Jenis Bank</option>
                                            <option value="Bank Umum">Bank Umum</option>
                                            <option value="Bank Syariah">Bank Syariah</option>
                                            <option value="Bank BPR">Bank BPR</option>
                                            <option value="Bank Sentral">Bank Sentral</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Koperasi -->
                            <div id="perbankan-koperasi-fields" class="perbankan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Koperasi</label>
                                        <input type="text" name="perbankan[koperasi_nama]"
                                            value="{{ old('perbankan.koperasi_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Ketua</label>
                                        <input type="text" name="perbankan[koperasi_ketua]"
                                            value="{{ old('perbankan.koperasi_ketua') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perbankan[koperasi_no_hp]"
                                            value="{{ old('perbankan.koperasi_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Koperasi</label>
                                        <select name="perbankan[koperasi_jenis]"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Jenis Koperasi</option>
                                            <option value="Koperasi Simpan Pinjam">Koperasi Simpan Pinjam</option>
                                            <option value="Koperasi Konsumen">Koperasi Konsumen</option>
                                            <option value="Koperasi Produsen">Koperasi Produsen</option>
                                            <option value="Koperasi Serba Usaha">Koperasi Serba Usaha</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Asuransi -->
                            <div id="perbankan-asuransi-fields" class="perbankan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan
                                            Asuransi</label>
                                        <input type="text" name="perbankan[asuransi_nama]"
                                            value="{{ old('perbankan.asuransi_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perbankan[asuransi_manager]"
                                            value="{{ old('perbankan.asuransi_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perbankan[asuransi_no_hp]"
                                            value="{{ old('perbankan.asuransi_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Asuransi</label>
                                        <select name="perbankan[asuransi_jenis]"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Jenis Asuransi</option>
                                            <option value="Asuransi Jiwa">Asuransi Jiwa</option>
                                            <option value="Asuransi Umum">Asuransi Umum</option>
                                            <option value="Asuransi Kesehatan">Asuransi Kesehatan</option>
                                            <option value="Asuransi Kendaraan">Asuransi Kendaraan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Leasing -->
                            <div id="perbankan-leasing-fields" class="perbankan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan
                                            Leasing</label>
                                        <input type="text" name="perbankan[leasing_nama]"
                                            value="{{ old('perbankan.leasing_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perbankan[leasing_manager]"
                                            value="{{ old('perbankan.leasing_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perbankan[leasing_no_hp]"
                                            value="{{ old('perbankan.leasing_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Leasing</label>
                                        <select name="perbankan[leasing_jenis]"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Jenis Leasing</option>
                                            <option value="Leasing Kendaraan">Leasing Kendaraan</option>
                                            <option value="Leasing Alat Berat">Leasing Alat Berat</option>
                                            <option value="Leasing Properti">Leasing Properti</option>
                                            <option value="Leasing Multiguna">Leasing Multiguna</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Pegadaian -->
                            <div id="perbankan-pegadaian-fields" class="perbankan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Pegadaian</label>
                                        <input type="text" name="perbankan[pegadaian_nama]"
                                            value="{{ old('perbankan.pegadaian_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perbankan[pegadaian_manager]"
                                            value="{{ old('perbankan.pegadaian_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perbankan[pegadaian_no_hp]"
                                            value="{{ old('perbankan.pegadaian_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Pegadaian</label>
                                        <select name="perbankan[pegadaian_jenis]"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Jenis Pegadaian</option>
                                            <option value="Pegadaian Konvensional">Pegadaian Konvensional</option>
                                            <option value="Pegadaian Syariah">Pegadaian Syariah</option>
                                            <option value="Pegadaian Emas">Pegadaian Emas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Fintech -->
                            <div id="perbankan-fintech-fields" class="perbankan-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan
                                            Fintech</label>
                                        <input type="text" name="perbankan[fintech_nama]"
                                            value="{{ old('perbankan.fintech_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Manager</label>
                                        <input type="text" name="perbankan[fintech_manager]"
                                            value="{{ old('perbankan.fintech_manager') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="perbankan[fintech_no_hp]"
                                            value="{{ old('perbankan.fintech_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jenis Fintech</label>
                                        <select name="perbankan[fintech_jenis]"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Jenis Fintech</option>
                                            <option value="Digital Payment">Digital Payment</option>
                                            <option value="Peer to Peer Lending">Peer to Peer Lending</option>
                                            <option value="Crowdfunding">Crowdfunding</option>
                                            <option value="Digital Wallet">Digital Wallet</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Container for Dynamically Added Types -->
                            <div id="perbankan-dynamic-container"></div>

                            <!-- Address Section untuk Perbankan (Shared for all sub-options) -->
                            <div id="perbankan-address-section" class="mb-4 hidden">
                                <h6 class="text-md font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat Perbankan dan Keuangan
                                </h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="perbankan_provinsi"
                                            class="block text-sm font-medium text-gray-700">Provinsi</label>
                                        <select name="perbankan[provinsi]" id="perbankan_provinsi"
                                            class="provinsi-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Provinsi</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div id="perbankan-wilayah-jatim" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label for="perbankan_kabupaten"
                                                    class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                                                <select name="perbankan[kabupaten]" id="perbankan_kabupaten"
                                                    class="kabupaten-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="perbankan_kecamatan"
                                                    class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <select name="perbankan[kecamatan]" id="perbankan_kecamatan"
                                                    class="kecamatan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="perbankan_kelurahan"
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <select name="perbankan[kelurahan]" id="perbankan_kelurahan"
                                                    class="kelurahan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kelurahan/Desa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="perbankan-wilayah-lainnya" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                                                <input type="text" name="perbankan[provinsi_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Provinsi">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                                                <input type="text" name="perbankan[kabupaten_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kabupaten">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <input type="text" name="perbankan[kecamatan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kecamatan">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <input type="text" name="perbankan[kelurahan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kelurahan/Desa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="perbankan_alamat"
                                            class="block text-sm font-medium text-gray-700">Alamat Lengkap
                                            (Jalan/RT/RW)</label>
                                        <textarea name="perbankan[alamat]" id="perbankan_alamat" rows="2"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('perbankan.alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Form Section untuk Lembaga Negara -->
                        <div id="form-Lembaga Negara" class="form-section hidden">
                            <h6 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b-2 border-red-500">
                                <i class="fas fa-landmark mr-2"></i>Data Lembaga Negara
                            </h6>

                            <!-- Dropdown Sub-Option untuk Lembaga Negara -->
                            <div class="mb-4">
                                <label for="lembaga_negara_sub_option"
                                    class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-list mr-2"></i>Pilih Jenis Lembaga Negara
                                </label>
                                <div class="flex gap-2">
                                    <select id="lembaga_negara_sub_option"
                                        class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">-- Pilih Jenis Lembaga Negara --</option>
                                        <option value="kementerian">Kementerian</option>
                                        <option value="lembaga">Lembaga</option>
                                        <option value="badan">Badan</option>
                                        <option value="komisi">Komisi</option>
                                        <option value="dewan">Dewan</option>
                                        <option value="instansi">Instansi</option>
                                    </select>
                                    <button type="button" onclick="addNewLembagaNegaraType()"
                                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 whitespace-nowrap">
                                        <i class="fas fa-plus mr-1"></i>Tambah Jenis
                                    </button>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Kementerian -->
                            <div id="lembaga_negara-kementerian-fields" class="lembaga_negara-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Kementerian</label>
                                        <input type="text" name="lembaga_negara[kementerian_nama]"
                                            value="{{ old('lembaga_negara.kementerian_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Menteri</label>
                                        <input type="text" name="lembaga_negara[kementerian_menteri]"
                                            value="{{ old('lembaga_negara.kementerian_menteri') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="lembaga_negara[kementerian_no_hp]"
                                            value="{{ old('lembaga_negara.kementerian_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Bidang Tugas</label>
                                        <input type="text" name="lembaga_negara[kementerian_bidang]"
                                            value="{{ old('lembaga_negara.kementerian_bidang') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Pendidikan, Kesehatan, Pertahanan">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Lembaga -->
                            <div id="lembaga_negara-lembaga-fields" class="lembaga_negara-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Lembaga</label>
                                        <input type="text" name="lembaga_negara[lembaga_nama]"
                                            value="{{ old('lembaga_negara.lembaga_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Ketua</label>
                                        <input type="text" name="lembaga_negara[lembaga_ketua]"
                                            value="{{ old('lembaga_negara.lembaga_ketua') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="lembaga_negara[lembaga_no_hp]"
                                            value="{{ old('lembaga_negara.lembaga_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Fungsi</label>
                                        <input type="text" name="lembaga_negara[lembaga_fungsi]"
                                            value="{{ old('lembaga_negara.lembaga_fungsi') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Pengawasan, Regulasi, Koordinasi">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Badan -->
                            <div id="lembaga_negara-badan-fields" class="lembaga_negara-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Badan</label>
                                        <input type="text" name="lembaga_negara[badan_nama]"
                                            value="{{ old('lembaga_negara.badan_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Kepala</label>
                                        <input type="text" name="lembaga_negara[badan_kepala]"
                                            value="{{ old('lembaga_negara.badan_kepala') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="lembaga_negara[badan_no_hp]"
                                            value="{{ old('lembaga_negara.badan_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Tugas Pokok</label>
                                        <input type="text" name="lembaga_negara[badan_tugas]"
                                            value="{{ old('lembaga_negara.badan_tugas') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Penelitian, Pengembangan, Pelayanan">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Komisi -->
                            <div id="lembaga_negara-komisi-fields" class="lembaga_negara-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Komisi</label>
                                        <input type="text" name="lembaga_negara[komisi_nama]"
                                            value="{{ old('lembaga_negara.komisi_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Ketua</label>
                                        <input type="text" name="lembaga_negara[komisi_ketua]"
                                            value="{{ old('lembaga_negara.komisi_ketua') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="lembaga_negara[komisi_no_hp]"
                                            value="{{ old('lembaga_negara.komisi_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Bidang Kerja</label>
                                        <input type="text" name="lembaga_negara[komisi_bidang]"
                                            value="{{ old('lembaga_negara.komisi_bidang') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Pemilu, HAM, Anti Korupsi">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Dewan -->
                            <div id="lembaga_negara-dewan-fields" class="lembaga_negara-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Dewan</label>
                                        <input type="text" name="lembaga_negara[dewan_nama]"
                                            value="{{ old('lembaga_negara.dewan_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Ketua</label>
                                        <input type="text" name="lembaga_negara[dewan_ketua]"
                                            value="{{ old('lembaga_negara.dewan_ketua') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="lembaga_negara[dewan_no_hp]"
                                            value="{{ old('lembaga_negara.dewan_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Fungsi</label>
                                        <input type="text" name="lembaga_negara[dewan_fungsi]"
                                            value="{{ old('lembaga_negara.dewan_fungsi') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Pertimbangan, Pengawasan, Konsultasi">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Fields Container for Instansi -->
                            <div id="lembaga_negara-instansi-fields" class="lembaga_negara-sub-fields hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Instansi</label>
                                        <input type="text" name="lembaga_negara[instansi_nama]"
                                            value="{{ old('lembaga_negara.instansi_nama') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Kepala</label>
                                        <input type="text" name="lembaga_negara[instansi_kepala]"
                                            value="{{ old('lembaga_negara.instansi_kepala') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                                        <input type="text" name="lembaga_negara[instansi_no_hp]"
                                            value="{{ old('lembaga_negara.instansi_no_hp') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Bidang Kerja</label>
                                        <input type="text" name="lembaga_negara[instansi_bidang]"
                                            value="{{ old('lembaga_negara.instansi_bidang') }}"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Contoh: Pelayanan Publik, Administrasi, Operasional">
                                    </div>
                                </div>
                            </div>

                            <!-- Container for Dynamically Added Types -->
                            <div id="lembaga_negara-dynamic-container"></div>

                            <!-- Address Section untuk Lembaga Negara (Shared for all sub-options) -->
                            <div id="lembaga_negara-address-section" class="mb-4 hidden">
                                <h6 class="text-md font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat Lembaga Negara
                                </h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="lembaga_negara_provinsi"
                                            class="block text-sm font-medium text-gray-700">Provinsi</label>
                                        <select name="lembaga_negara[provinsi]" id="lembaga_negara_provinsi"
                                            class="provinsi-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Provinsi</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div id="lembaga_negara-wilayah-jatim" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label for="lembaga_negara_kabupaten"
                                                    class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                                                <select name="lembaga_negara[kabupaten]" id="lembaga_negara_kabupaten"
                                                    class="kabupaten-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="lembaga_negara_kecamatan"
                                                    class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <select name="lembaga_negara[kecamatan]" id="lembaga_negara_kecamatan"
                                                    class="kecamatan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="lembaga_negara_kelurahan"
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <select name="lembaga_negara[kelurahan]" id="lembaga_negara_kelurahan"
                                                    class="kelurahan-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                    <option value="">Pilih Kelurahan/Desa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="lembaga_negara-wilayah-lainnya" class="hidden md:col-span-2">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                                                <input type="text" name="lembaga_negara[provinsi_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Provinsi">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kabupaten</label>
                                                <input type="text" name="lembaga_negara[kabupaten_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kabupaten">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                                <input type="text" name="lembaga_negara[kecamatan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kecamatan">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                                <input type="text" name="lembaga_negara[kelurahan_lain]"
                                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                                    placeholder="Kelurahan/Desa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="lembaga_negara_alamat"
                                            class="block text-sm font-medium text-gray-700">Alamat Lengkap
                                            (Jalan/RT/RW)</label>
                                        <textarea name="lembaga_negara[alamat]" id="lembaga_negara_alamat" rows="2"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Masukkan alamat lengkap (Jalan, RT/RW, dll)">{{ old('lembaga_negara.alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                            <i class="fas fa-save mr-2"></i>Simpan
                        </button>
                        <button type="reset" class="px-6 py-2 text-gray-800 bg-gray-200 rounded hover:bg-gray-300">
                            <i class="fas fa-undo mr-2"></i>Reset
                        </button>
                    </div>
                </form>
            </div>
            <div class="mt-6 order-1 lg:order-2">
                <div class="bg-white shadow rounded p-4 space-y-4">
                    <div class="bg-blue-50 p-3 rounded border-l-4 border-blue-400">
                        <h6 class="font-semibold text-blue-700 mb-2"><i class="fas fa-info-circle mr-2"></i>Informasi
                        </h6>
                        <ul class="list-disc list-inside text-sm text-blue-800 space-y-1">
                            <li>Isi data untuk <strong>semua jenis</strong> objek vital</li>
                            <li>Gunakan dropdown untuk berpindah antar jenis</li>
                            <li>Data yang sudah diisi akan <strong>tersimpan otomatis</strong></li>
                            <li>Klik <strong>Simpan</strong> untuk menyimpan semua data sekaligus</li>
                            <li>Field yang sudah diisi akan ditandai dengan <span
                                    class="inline-block px-2 py-1 bg-green-100 text-green-700 rounded text-xs">✓
                                    hijau</span></li>
                        </ul>
                    </div>

                    <!-- Progress Indicator -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-3 rounded border-l-4 border-green-500">
                        <h6 class="font-semibold text-green-700 mb-2"><i class="fas fa-check-circle mr-2"></i>Progress
                        </h6>
                        <div class="text-sm text-green-800">
                            <p>Jenis yang sudah diisi: <strong id="filled-count">0</strong> dari <strong>6</strong></p>
                            <div class="mt-2 bg-gray-200 rounded-full h-2">
                                <div id="progress-bar" class="bg-green-500 h-2 rounded-full transition-all duration-300"
                                    style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="bg-white shadow rounded p-6">
                        <h6 class="text-lg font-semibold text-green-700 mb-4 flex items-center">
                            <i class="fas fa-file-excel mr-2"></i>Import Data
                        </h6>

                        <!-- Download Template CSV -->
                        <div class="mb-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-download text-blue-600 mr-2"></i>
                                    <span class="text-sm text-blue-800">Download template untuk format yang benar</span>
                                </div>
                                <a href="{{ route('admin.data.objekvital.template') }}"
                                    class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-file-csv mr-1"></i>
                                    Download
                                </a>
                            </div>
                        </div>

                        <form action="{{ route('admin.data.objekvital.import') }}" method="POST"
                            enctype="multipart/form-data"
                            class="flex flex-col sm:flex-row items-center sm:space-x-4 space-y-4 sm:space-y-0">
                            @csrf
                            <input type="file" name="file" accept=".csv,.txt" required
                                class="block w-full text-sm text-gray-500">
                            <button type="submit"
                                class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center">
                                <i class="fas fa-file-csv mr-2"></i>Input
                            </button>
                        </form>

                        @error('file')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                        @if (session('success'))
                            <div class="mt-2 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="mt-2 p-2 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisObjekNav = document.getElementById('jenis_objek_nav');
            const formSections = document.querySelectorAll('.form-section');

            // Function to show selected form section
            function showFormSection() {
                const selectedJenis = jenisObjekNav.value;

                // Hide all sections first
                formSections.forEach(section => {
                    section.classList.add('hidden');
                });

                // Show selected section
                const selectedSection = document.getElementById('form-' + selectedJenis);
                if (selectedSection) {
                    selectedSection.classList.remove('hidden');

                    // Smooth scroll to section
                    selectedSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }
            }

            // Listen to dropdown change
            jenisObjekNav.addEventListener('change', showFormSection);

            // Initialize on page load - show first section
            showFormSection();

            // Add visual indicator for filled forms
            const allInputs = document.querySelectorAll('.form-section input, .form-section textarea');

            allInputs.forEach(input => {
                // Check if input has value and add indicator
                function updateIndicator() {
                    if (input.value.trim() !== '') {
                        input.classList.add('bg-green-50', 'border-green-300');
                    } else {
                        input.classList.remove('bg-green-50', 'border-green-300');
                    }
                }

                // Update on input change
                input.addEventListener('input', updateIndicator);
                input.addEventListener('change', updateIndicator);

                // Initialize
                updateIndicator();
            });

            // Add filled indicator to dropdown options and update progress
            function updateDropdownIndicators() {
                const options = jenisObjekNav.querySelectorAll('option');
                let filledCount = 0;
                const totalSections = formSections.length;

                options.forEach(option => {
                    const jenis = option.value;
                    const section = document.getElementById('form-' + jenis);

                    if (section) {
                        const inputs = section.querySelectorAll('input, textarea');
                        let hasValue = false;

                        inputs.forEach(input => {
                            if (input.value.trim() !== '') {
                                hasValue = true;
                            }
                        });

                        // Add checkmark if has value
                        if (hasValue) {
                            const baseText = option.textContent.replace(' ✓', '');
                            option.textContent = baseText + ' ✓';
                            filledCount++;
                        } else {
                            option.textContent = option.textContent.replace(' ✓', '');
                        }
                    }
                });

                // Update progress counter and bar
                const filledCountEl = document.getElementById('filled-count');
                const progressBar = document.getElementById('progress-bar');

                if (filledCountEl) {
                    filledCountEl.textContent = filledCount;
                }

                if (progressBar) {
                    const percentage = (filledCount / totalSections) * 100;
                    progressBar.style.width = percentage + '%';
                }
            }

            // Update indicators when input changes
            allInputs.forEach(input => {
                input.addEventListener('input', updateDropdownIndicators);
                input.addEventListener('change', updateDropdownIndicators);
            });

            // Initialize indicators
            updateDropdownIndicators();

            // ========== Universal Address Section Handler for ALL Objek Vital Types ==========
            const prefixes = ['industri', 'pertambangan', 'perhubungan', 'instalasi', 'perbankan',
                'lembaga_negara'
            ];

            prefixes.forEach(prefix => {
                const provinsiSelect = document.getElementById(`${prefix}_provinsi`);
                const wilayahJatim = document.getElementById(`${prefix}-wilayah-jatim`);
                const wilayahLainnya = document.getElementById(`${prefix}-wilayah-lainnya`);
                const kabupatenSelect = document.getElementById(`${prefix}_kabupaten`);
                const kecamatanSelect = document.getElementById(`${prefix}_kecamatan`);
                const kelurahanSelect = document.getElementById(`${prefix}_kelurahan`);

                if (!provinsiSelect) return; // Skip if not found

                // Handle provinsi selection
                provinsiSelect.addEventListener('change', function() {
                    if (this.value === 'lainnya') {
                        if (wilayahJatim) wilayahJatim.classList.add('hidden');
                        if (wilayahLainnya) wilayahLainnya.classList.remove('hidden');
                    } else if (this.value === 'Jawa Timur') {
                        if (wilayahJatim) wilayahJatim.classList.remove('hidden');
                        if (wilayahLainnya) wilayahLainnya.classList.add('hidden');

                        // Load kabupaten list
                        if (kabupatenSelect) {
                            fetch('/api/kabupaten-list')
                                .then(response => response.json())
                                .then(data => {
                                    kabupatenSelect.innerHTML =
                                        '<option value="">Pilih Kabupaten/Kota</option>';
                                    data.forEach(kabupaten => {
                                        const option = document.createElement('option');
                                        option.value = kabupaten;
                                        option.textContent = kabupaten;
                                        kabupatenSelect.appendChild(option);
                                    });
                                })
                                .catch(error => console.error(
                                    `Error fetching kabupaten for ${prefix}:`, error));
                        }
                    } else {
                        if (wilayahJatim) wilayahJatim.classList.add('hidden');
                        if (wilayahLainnya) wilayahLainnya.classList.add('hidden');
                    }
                });

                // Handle kabupaten selection
                if (kabupatenSelect) {
                    kabupatenSelect.addEventListener('change', function() {
                        const kabupaten = this.value;
                        if (kecamatanSelect) kecamatanSelect.innerHTML =
                            '<option value="">Pilih Kecamatan</option>';
                        if (kelurahanSelect) kelurahanSelect.innerHTML =
                            '<option value="">Pilih Kelurahan/Desa</option>';

                        if (kabupaten && kecamatanSelect) {
                            fetch(`/api/kecamatan-list?kabupaten=${encodeURIComponent(kabupaten)}`)
                                .then(response => response.json())
                                .then(data => {
                                    data.forEach(kecamatan => {
                                        const option = document.createElement('option');
                                        option.value = kecamatan;
                                        option.textContent = kecamatan;
                                        kecamatanSelect.appendChild(option);
                                    });
                                })
                                .catch(error => console.error(
                                    `Error fetching kecamatan for ${prefix}:`, error));
                        }
                    });
                }

                // Handle kecamatan selection
                if (kecamatanSelect) {
                    kecamatanSelect.addEventListener('change', function() {
                        const kabupaten = kabupatenSelect ? kabupatenSelect.value : '';
                        const kecamatan = this.value;
                        if (kelurahanSelect) kelurahanSelect.innerHTML =
                            '<option value="">Pilih Kelurahan/Desa</option>';

                        if (kabupaten && kecamatan && kelurahanSelect) {
                            fetch(
                                    `/api/desa-list?kabupaten=${encodeURIComponent(kabupaten)}&kecamatan=${encodeURIComponent(kecamatan)}`
                                )
                                .then(response => response.json())
                                .then(data => {
                                    data.forEach(desa => {
                                        const option = document.createElement('option');
                                        option.value = desa;
                                        option.textContent = desa;
                                        kelurahanSelect.appendChild(option);
                                    });
                                })
                                .catch(error => console.error(`Error fetching desa for ${prefix}:`,
                                    error));
                        }
                    });
                }

                // Initialize provinsi selection on page load
                if (provinsiSelect.value === 'lainnya') {
                    if (wilayahJatim) wilayahJatim.classList.add('hidden');
                    if (wilayahLainnya) wilayahLainnya.classList.remove('hidden');
                } else if (provinsiSelect.value === 'Jawa Timur') {
                    if (wilayahJatim) wilayahJatim.classList.remove('hidden');
                    if (wilayahLainnya) wilayahLainnya.classList.add('hidden');
                }
            });

            // ========== Universal Sub-Option Handler for ALL Objek Vital Types ==========
            const subOptionConfigs = [{
                    prefix: 'industri',
                    subOptionId: 'industri_sub_option',
                    fieldsClass: 'industri-sub-fields',
                    addressSectionId: 'industri-address-section',
                    dynamicContainerId: 'industri-dynamic-container',
                    addFunction: 'addNewIndustriType'
                },
                {
                    prefix: 'pertambangan',
                    subOptionId: 'pertambangan_sub_option',
                    fieldsClass: 'pertambangan-sub-fields',
                    addressSectionId: 'pertambangan-address-section',
                    dynamicContainerId: 'pertambangan-dynamic-container',
                    addFunction: 'addNewPertambanganType'
                },
                {
                    prefix: 'perhubungan',
                    subOptionId: 'perhubungan_sub_option',
                    fieldsClass: 'perhubungan-sub-fields',
                    addressSectionId: 'perhubungan-address-section',
                    dynamicContainerId: 'perhubungan-dynamic-container',
                    addFunction: 'addNewPerhubunganType'
                },
                {
                    prefix: 'instalasi',
                    subOptionId: 'instalasi_sub_option',
                    fieldsClass: 'instalasi-sub-fields',
                    addressSectionId: 'instalasi-address-section',
                    dynamicContainerId: 'instalasi-dynamic-container',
                    addFunction: 'addNewInstalasiType'
                },
                {
                    prefix: 'perbankan',
                    subOptionId: 'perbankan_sub_option',
                    fieldsClass: 'perbankan-sub-fields',
                    addressSectionId: 'perbankan-address-section',
                    dynamicContainerId: 'perbankan-dynamic-container',
                    addFunction: 'addNewPerbankanType'
                },
                {
                    prefix: 'lembaga_negara',
                    subOptionId: 'lembaga_negara_sub_option',
                    fieldsClass: 'lembaga_negara-sub-fields',
                    addressSectionId: 'lembaga_negara-address-section',
                    dynamicContainerId: 'lembaga_negara-dynamic-container',
                    addFunction: 'addNewLembagaNegaraType'
                }
            ];

            let dynamicTypeCounter = 0;

            // Initialize all sub-option handlers
            subOptionConfigs.forEach(config => {
                const subOption = document.getElementById(config.subOptionId);
                const addressSection = document.getElementById(config.addressSectionId);
                const dynamicContainer = document.getElementById(config.dynamicContainerId);

                if (subOption) {
                    subOption.addEventListener('change', function() {
                        const selectedSubOption = this.value;

                        // Hide all sub-fields for this type
                        const allSubFields = document.querySelectorAll(`.${config.fieldsClass}`);
                        allSubFields.forEach(field => {
                            field.classList.add('hidden');
                        });

                        // Show selected sub-fields
                        if (selectedSubOption) {
                            const selectedFields = document.getElementById(
                                `${config.prefix}-${selectedSubOption}-fields`);
                            if (selectedFields) {
                                selectedFields.classList.remove('hidden');
                            }

                            // Show address section
                            if (addressSection) {
                                addressSection.classList.remove('hidden');
                            }
                        } else {
                            // Hide address section if no sub-option selected
                            if (addressSection) {
                                addressSection.classList.add('hidden');
                            }
                        }
                    });
                }
            });

            // ========== Instalasi Sub-Option Handler (Legacy - keeping for compatibility) ==========
            const instalasiSubOption = document.getElementById('instalasi_sub_option');
            let instalasiSubFields = document.querySelectorAll('.instalasi-sub-fields');
            const instalasiAddressSection = document.getElementById('instalasi-address-section');
            const instalasiDynamicContainer = document.getElementById('instalasi-dynamic-container');

            function updateInstalasiSubFields() {
                instalasiSubFields = document.querySelectorAll('.instalasi-sub-fields');
            }

            if (instalasiSubOption) {
                instalasiSubOption.addEventListener('change', function() {
                    const selectedSubOption = this.value;

                    // Hide all sub-fields
                    instalasiSubFields.forEach(field => {
                        field.classList.add('hidden');
                    });

                    // Show selected sub-fields
                    if (selectedSubOption) {
                        const selectedFields = document.getElementById(
                            `instalasi-${selectedSubOption}-fields`);
                        if (selectedFields) {
                            selectedFields.classList.remove('hidden');
                        }

                        // Show address section
                        if (instalasiAddressSection) {
                            instalasiAddressSection.classList.remove('hidden');
                        }
                    } else {
                        // Hide address section if no sub-option selected
                        if (instalasiAddressSection) {
                            instalasiAddressSection.classList.add('hidden');
                        }
                    }
                });
            }

            // ========== Universal Add New Type Functions ==========
            function createAddNewTypeFunction(prefix, subOptionId, dynamicContainerId, fieldsClass, typeLabel) {
                return function() {
                    const typeName = prompt(
                        `Masukkan nama jenis ${typeLabel} baru:\n(Contoh: ${getTypeExamples(prefix)})`);

                    if (!typeName || typeName.trim() === '') {
                        return;
                    }

                    const cleanTypeName = typeName.trim();
                    const typeId = 'custom_' + (++dynamicTypeCounter);
                    const typeSlug = cleanTypeName.toLowerCase().replace(/\s+/g, '_').replace(/[^a-z0-9_]/g,
                        '');

                    const subOption = document.getElementById(subOptionId);
                    const dynamicContainer = document.getElementById(dynamicContainerId);

                    // Add option to dropdown
                    const option = document.createElement('option');
                    option.value = typeId;
                    option.textContent = cleanTypeName;
                    subOption.appendChild(option);

                    // Create dynamic fields container
                    const fieldsContainer = document.createElement('div');
                    fieldsContainer.id = `${prefix}-${typeId}-fields`;
                    fieldsContainer.className = `${fieldsClass} hidden`;
                    fieldsContainer.innerHTML = `
                        <div class="bg-gray-50 p-3 rounded mb-2 flex justify-between items-center">
                            <h6 class="text-sm font-semibold text-gray-700">
                                <i class="fas fa-${getIconForPrefix(prefix)} mr-2"></i>${cleanTypeName}
                            </h6>
                            <button type="button" onclick="remove${capitalizeFirst(prefix)}Type('${typeId}')"
                                class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama ${cleanTypeName}</label>
                                <input type="text" name="${prefix}[${typeSlug}_nama]"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pengelola/Manager</label>
                                <input type="text" name="${prefix}[${typeSlug}_pengelola]"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No HP</label>
                                <input type="text" name="${prefix}[${typeSlug}_no_hp]"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Keterangan/Bidang</label>
                                <textarea name="${prefix}[${typeSlug}_keterangan]" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Keterangan tambahan"></textarea>
                            </div>
                        </div>
                    `;

                    dynamicContainer.appendChild(fieldsContainer);

                    // Auto-select the new type
                    subOption.value = typeId;
                    subOption.dispatchEvent(new Event('change'));

                    // Show success message
                    alert(`✅ Jenis ${typeLabel} "${cleanTypeName}" berhasil ditambahkan!`);
                };
            }

            function getTypeExamples(prefix) {
                const examples = {
                    'industri': 'Pabrik Makanan, Industri Tekstil',
                    'pertambangan': 'Tambang Batu Bara, Tambang Emas',
                    'perhubungan': 'Terminal Bus, Stasiun Kereta',
                    'instalasi': 'Rumah Sakit, Sekolah',
                    'perbankan': 'Bank Syariah, Koperasi',
                    'lembaga_negara': 'Kantor Pemerintah, Badan'
                };
                return examples[prefix] || 'Contoh lainnya';
            }

            function getIconForPrefix(prefix) {
                const icons = {
                    'industri': 'industry',
                    'pertambangan': 'bolt',
                    'perhubungan': 'plane',
                    'instalasi': 'building',
                    'perbankan': 'university',
                    'lembaga_negara': 'landmark'
                };
                return icons[prefix] || 'building';
            }

            function capitalizeFirst(str) {
                return str.charAt(0).toUpperCase() + str.slice(1);
            }

            // Create all add new type functions
            window.addNewIndustriType = createAddNewTypeFunction('industri', 'industri_sub_option',
                'industri-dynamic-container', 'industri-sub-fields', 'industri');
            window.addNewPertambanganType = createAddNewTypeFunction('pertambangan', 'pertambangan_sub_option',
                'pertambangan-dynamic-container', 'pertambangan-sub-fields', 'pertambangan');
            window.addNewPerhubunganType = createAddNewTypeFunction('perhubungan', 'perhubungan_sub_option',
                'perhubungan-dynamic-container', 'perhubungan-sub-fields', 'perhubungan');
            window.addNewPerbankanType = createAddNewTypeFunction('perbankan', 'perbankan_sub_option',
                'perbankan-dynamic-container', 'perbankan-sub-fields', 'perbankan');
            window.addNewLembagaNegaraType = createAddNewTypeFunction('lembaga_negara', 'lembaga_negara_sub_option',
                'lembaga_negara-dynamic-container', 'lembaga_negara-sub-fields', 'lembaga negara');

            // ========== Add New Instalasi Type Function (Legacy) ==========
            window.addNewInstalasiType = function() {
                const typeName = prompt(
                    'Masukkan nama jenis instalasi baru:\n(Contoh: Rumah Sakit, Sekolah, Puskesmas, dll)');

                if (!typeName || typeName.trim() === '') {
                    return;
                }

                const cleanTypeName = typeName.trim();
                const typeId = 'custom_' + (++dynamicTypeCounter);
                const typeSlug = cleanTypeName.toLowerCase().replace(/\s+/g, '_').replace(/[^a-z0-9_]/g, '');

                // Add option to dropdown
                const option = document.createElement('option');
                option.value = typeId;
                option.textContent = cleanTypeName;
                instalasiSubOption.appendChild(option);

                // Create dynamic fields container
                const fieldsContainer = document.createElement('div');
                fieldsContainer.id = `instalasi-${typeId}-fields`;
                fieldsContainer.className = 'instalasi-sub-fields hidden';
                fieldsContainer.innerHTML = `
                    <div class="bg-gray-50 p-3 rounded mb-2 flex justify-between items-center">
                        <h6 class="text-sm font-semibold text-gray-700">
                            <i class="fas fa-building mr-2"></i>${cleanTypeName}
                        </h6>
                        <button type="button" onclick="removeInstalasiType('${typeId}')"
                            class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                            <i class="fas fa-trash mr-1"></i>Hapus
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama ${cleanTypeName}</label>
                            <input type="text" name="instalasi[${typeSlug}_nama]"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pengelola/Manager</label>
                            <input type="text" name="instalasi[${typeSlug}_pengelola]"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No HP</label>
                            <input type="text" name="instalasi[${typeSlug}_no_hp]"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Keterangan/Bidang</label>
                            <textarea name="instalasi[${typeSlug}_keterangan]" rows="2"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Keterangan tambahan"></textarea>
                        </div>
                    </div>
                `;

                instalasiDynamicContainer.appendChild(fieldsContainer);
                updateInstalasiSubFields();

                // Auto-select the new type
                instalasiSubOption.value = typeId;
                instalasiSubOption.dispatchEvent(new Event('change'));

                // Show success message
                alert(`✅ Jenis instalasi "${cleanTypeName}" berhasil ditambahkan!`);
            };

            // ========== Universal Remove Type Functions ==========
            function createRemoveTypeFunction(prefix, subOptionId, fieldsClass) {
                return function(typeId) {
                    if (confirm(`Yakin ingin menghapus jenis ${prefix} ini?`)) {
                        // Remove fields container
                        const fieldsContainer = document.getElementById(`${prefix}-${typeId}-fields`);
                        if (fieldsContainer) {
                            fieldsContainer.remove();
                        }

                        // Remove option from dropdown
                        const subOption = document.getElementById(subOptionId);
                        const option = subOption.querySelector(`option[value="${typeId}"]`);
                        if (option) {
                            option.remove();
                        }

                        // Reset dropdown to empty
                        subOption.value = '';
                        subOption.dispatchEvent(new Event('change'));
                    }
                };
            }

            // Create all remove type functions
            window.removeIndustriType = createRemoveTypeFunction('industri', 'industri_sub_option',
                'industri-sub-fields');
            window.removePertambanganType = createRemoveTypeFunction('pertambangan', 'pertambangan_sub_option',
                'pertambangan-sub-fields');
            window.removePerhubunganType = createRemoveTypeFunction('perhubungan', 'perhubungan_sub_option',
                'perhubungan-sub-fields');
            window.removePerbankanType = createRemoveTypeFunction('perbankan', 'perbankan_sub_option',
                'perbankan-sub-fields');
            window.removeLembagaNegaraType = createRemoveTypeFunction('lembaga_negara', 'lembaga_negara_sub_option',
                'lembaga_negara-sub-fields');

            // ========== Remove Instalasi Type Function (Legacy) ==========
            window.removeInstalasiType = function(typeId) {
                if (confirm('Yakin ingin menghapus jenis instalasi ini?')) {
                    // Remove fields container
                    const fieldsContainer = document.getElementById(`instalasi-${typeId}-fields`);
                    if (fieldsContainer) {
                        fieldsContainer.remove();
                    }

                    // Remove option from dropdown
                    const option = instalasiSubOption.querySelector(`option[value="${typeId}"]`);
                    if (option) {
                        option.remove();
                    }

                    // Reset dropdown to empty
                    instalasiSubOption.value = '';
                    instalasiSubOption.dispatchEvent(new Event('change'));

                    updateInstalasiSubFields();
                }
            };

            // Form submission handler
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
                submitBtn.disabled = true;

                // Count filled sections
                let filledCount = 0;
                formSections.forEach(section => {
                    const inputs = section.querySelectorAll('input, textarea');
                    let sectionHasValue = false;

                    inputs.forEach(input => {
                        if (input.value.trim() !== '') {
                            sectionHasValue = true;
                        }
                    });

                    if (sectionHasValue) {
                        filledCount++;
                    }
                });

                console.log('Menyimpan data untuk ' + filledCount + ' jenis objek vital');
            });
        });
    </script>
@endpush
