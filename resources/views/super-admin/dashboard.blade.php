@extends('layouts.superadmin-master')

@section('content')
    @include('components.superadmin-navbar')

    <div class="container mx-auto px-4 py-3">
        <!-- Tab Navigation -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <!-- Tab Statistik (Active) -->
                    <button class="tab-button active" id="statistikTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            <span class="text-blue-600 font-medium">Statistik</span>
                        </div>
                    </button>

                    <!-- Tab Profil Organisasi (Inactive) -->
                    <button class="tab-button inactive" id="profilTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Profil Organisasi</span>
                        </div>
                    </button>

                    <!-- Tab Anggaran (Inactive) -->
                    <button class="tab-button inactive" id="anggaranTab">
                        <div class="flex items-center space-x-2 py-2 px-1">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <span class="text-gray-700 font-medium">Anggaran</span>
                        </div>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div id="statistikContent" class="dashboard-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total Kasus</div>
                                <div class="text-2xl font-bold text-gray-900">{{ number_format($totalKasus) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total Desa/Kelurahan</div>
                                <div class="text-2xl font-bold text-gray-900">{{ number_format($totalDesa) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Kabupaten/Kota</div>
                                <div class="text-2xl font-bold text-gray-900">{{ number_format($kabupatenCount) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Kecamatan</div>
                                <div class="text-2xl font-bold text-gray-900">{{ number_format($kecamatanCount) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Grafik Kasus per Kabupaten -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Kasus per Kabupaten/Kota <br> Berdasarkan TKP
                            </h3>
                            <button id="showAllKabupatenBtn"
                                class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">
                                <div class="flex items-center space-x-1">
                                    <span>Lihat Semua</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                        {{-- <h3 class="text-lg font-semibold text-gray-900 mb-4">Kasus per Kabupaten</h3> --}}
                        <canvas id="chartKabupaten" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Grafik Kasus per Kecamatan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Kasus per Kecamatan <br> Berdasarkan TKP</h3>
                            <button id="showAllKecamatanBtn"
                                class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">
                                <div class="flex items-center space-x-1">
                                    <span>Lihat Semua</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                        {{-- <h3 class="text-lg font-semibold text-gray-900 mb-4">Kasus per Kecamatan</h3> --}}
                        <canvas id="chartKecamatan" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Grafik Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Grafik Kasus per Kabupaten NIK -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Kasus per Kabupaten/Kota <br> Berdasarkan NIK
                            </h3>
                            <button id="showAllKabupatenBtnNik"
                                class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">
                                <div class="flex items-center space-x-1">
                                    <span>Lihat Semua</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                        {{-- <h3 class="text-lg font-semibold text-gray-900 mb-4">Kasus per Kabupaten</h3> --}}
                        <canvas id="chartKabupatenNik" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Grafik Kasus per Kecamatan NIK -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Kasus per Kecamatan <br> Berdasarkan NIK</h3>
                            <button id="showAllKecamatanBtnNik"
                                class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">
                                <div class="flex items-center space-x-1">
                                    <span>Lihat Semua</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </button>
                        </div>
                        {{-- <h3 class="text-lg font-semibold text-gray-900 mb-4">Kasus per Kecamatan</h3> --}}
                        <canvas id="chartKecamatanNik" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Grafik Trend dan Status -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Trend Bulanan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Trend Kasus Bulanan</h3>
                        <canvas id="chartTrend" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Status & Residivis Pie Charts -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-md font-semibold text-gray-900 mb-2">Status</h3>
                                <canvas id="chartStatusPie" width="180" height="180"></canvas>
                            </div>
                            <div>
                                <h3 class="text-md font-semibold text-gray-900 mb-2">Residivis</h3>
                                <canvas id="chartResidivisPie" width="180" height="180"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Kasus Terbaru -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Kasus Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Desa</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kecamatan</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kabupaten</th>
                                    {{-- <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Keterangan</th> --}}
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($kasusTerbaru as $kasus)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-900">
                                            {{ $loop->iteration }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-900">
                                            {{ $kasus->desa }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                            {{ $kasus->kecamatan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                            {{ $kasus->kabupaten }}</td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                            {{ $kasus->created_by }}</td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                            {{ $kasus->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada
                                            data kasus</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Anggaran -->
        <div id="anggaranContent" class="dashboard-content hidden">
            <div class="space-y-6">
                <!-- Summary Cards -->
                {{-- <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Anggaran</p>
                            <p class="text-2xl font-bold text-blue-600">Rp 15.2M</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Anggaran Terpakai</p>
                            <p class="text-2xl font-bold text-green-600">Rp 8.7M</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Sisa Anggaran</p>
                            <p class="text-2xl font-bold text-orange-600">Rp 6.5M</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Persentase Realisasi</p>
                            <p class="text-2xl font-bold text-purple-600">57.2%</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div> --}}

                <!-- Tabel Anggaran -->
                <div class="bg-white rounded-lg shadow">
                    <div class="relative px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Rincian Anggaran</h3>
                        <div class="absolute right-0 top-0 mt-3 mr-4">
                            <a href="#" id="openModalBtn"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                Tambah Anggaran
                            </a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        AKUN</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        KEGIATAN</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ANGGARAN SEBELUM BLOKIR</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        BLOKIR</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ANGGARAN SETELAH BLOKIR</th>
                                    <th
                                        class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($anggaranList as $anggaran)
                                    <tr class="hover:bg-gray-50">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">
                                            {{ $anggaran->akun }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $anggaran->kegiatan }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 bg-blue-100">
                                            Rp {{ number_format($anggaran->anggaran_sebelum, 0, ',', '.') }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 bg-red-100">
                                            Rp
                                            {{ $anggaran->blokir ? number_format($anggaran->blokir, 0, ',', '.') : '-' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 bg-yellow-100">
                                            Rp
                                            {{ number_format($anggaran->anggaran_sebelum - ($anggaran->blokir ?? 0), 0, ',', '.') }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                            <div class="flex items-center justify-center space-x-2">
                                                {{-- Aksi seperti edit/hapus dapat ditambahkan di sini --}}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada
                                            data anggaran</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="2" class="px-6 py-4 text-center text-sm font-bold text-gray-900">TOTAL
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-blue-100">
                                        Rp {{ number_format($totalAnggaranSebelum, 0, ',', '.') }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-red-100">
                                        Rp {{ number_format($totalBlokir, 0, ',', '.') }}</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-yellow-100">
                                        Rp {{ number_format($totalSetelah, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- Removed all extra table elements that were outside the table structure -->
                    </div>
                </div>

                <!-- Chart Anggaran -->
                {{-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Realisasi Anggaran per Program</h3>
                    <canvas id="chartAnggaran" width="400" height="200"></canvas>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Trend Realisasi Bulanan</h3>
                    <canvas id="chartTrendAnggaran" width="400" height="200"></canvas>
                </div>
            </div> --}}
            </div>
        </div>

        <!-- Konten Profil Organisasi -->
        <div id="profilContent" class="dashboard-content hidden">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="mb-8 text-center">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo BNN" class="h-16 mb-2 mx-auto">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">BADAN NARKOTIKA NASIONAL</h2>
                        <h3 class="text-lg font-bold text-gray-900">PROVINSI JAWA TIMUR</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8">
                </div>

                <!-- Tugas Pokok dan Fungsi -->
                <div class="mt-5 space-y-12 mx-auto px-4">
                    <div class="relative pb-6">
                        <h4
                            class="text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-red-600 pb-3">
                            Tugas Pokok dan Fungsi (Tupoksi) Bidang Pemberantasan dan Intelijen</h4>
                        <div
                            class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full">
                        </div>
                    </div>

                    <!-- Tugas Pokok -->
                    <div
                        class="bg-gradient-to-br from-white to-blue-50 rounded-base shadow-lg p-8 border-t border-l border-blue-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                        <div class="flex items-center mb-1">
                            <h5 class="text-2xl font-bold text-black tracking-tight">Tugas Pokok Bidang Pemberantasan dan
                                Intelijen</h5>
                        </div>
                        <div class="pl-5 pr-4">
                            <p class="text-gray-700 leading-relaxed text-lg bg-white bg-opacity-50 p-4 ml-5 font-sans">
                                <span class="font-bold">Pasal 9 Peraturan Kepala BNN Nomor 6 Tahun 2020</span>:<br>
                                <span class="italic"><span class="font-bold">"</span>Pemberantasan dan Intelijen mempunyai
                                    tugas melaksanakan kebijakan teknis P4GN di bidang Pemberantasan dan Intelijen dalam
                                    wilayah Provinsi.<span class="font-bold">"</span></span>
                            </p>
                        </div>
                    </div>

                    <!-- Fungsi -->
                    <div
                        class="bg-gradient-to-br from-white to-green-50 rounded-base shadow-lg p-8 border-t border-l border-green-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden mb-8">
                        <div class="items-center">
                            <h5 class="text-2xl font-bold text-black tracking-tight whitespace-nowrap">Fungsi Bidang
                                Pemberantasan</h5>
                            <p class="font-bold">Sesuai Pasal 10, Peraturan Kepala BNN Nomor 6 Tahun 2020:</p>
                            <p class="italic">Dalam melaksanakan tugas sebagaimana dimaksud dalam Pasal 9, Bidang
                                Pemberantasan dan Intelijen menyelenggarakan fungsi: </p>
                        </div>
                        <div class="pl-1 pr-4">
                            <div class="bg-white bg-opacity-50 p-4 rounded-xl shadow-sm">
                                <ul class="space-y-4 list-none">
                                    <li class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                        <div class="flex-shrink-0 mt-1">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                <span class="text-white text-xs font-bold">1</span>
                                            </span>
                                        </div>
                                        <p
                                            class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                            Penyiapan pelaksanaan koordinasi penyusunan rencana strategis dan rencana kerja
                                            tahunan P4GN di bidang pemberantasan dalam wilayah Provinsi;</p>
                                    </li>
                                    <li class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                        <div class="flex-shrink-0 mt-1">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                <span class="text-white text-xs font-bold">2</span>
                                            </span>
                                        </div>
                                        <p
                                            class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                            Penyiapan pelaksanaan pemberantasan dan pemutusan jaringan kejahatan
                                            terorganisasi penyalahgunaan peredaran gelap narkotika dalam wilayah Provinsi;
                                        </p>
                                    </li>
                                    <li class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                        <div class="flex-shrink-0 mt-1">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                <span class="text-white text-xs font-bold">3</span>
                                            </span>
                                        </div>
                                        <p
                                            class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                            Penyiapan pelaksanaan pembangunan dan pemanfaatan intelijen teknologi dan
                                            kegiatan intelijen taktis, operasional dan produk dalam rangka P4GN di bidang
                                            pemberantasan dalam wilayah Provinsi;</p>
                                    </li>
                                    <li class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                        <div class="flex-shrink-0 mt-1">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                <span class="text-white text-xs font-bold">4</span>
                                            </span>
                                        </div>
                                        <p
                                            class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                            Penyiapan pelaksanaan administrasi penyelidikan dan penyidikan terhadap tindak
                                            pidana narkotika, psikotropika, prekursor, dan bahan adiktif lainnya kecuali
                                            bahan adiktif untuk tembakau dan alkohol dalam wilayah Provinsi;</p>
                                    </li>
                                    <li class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                        <div class="flex-shrink-0 mt-1">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                <span class="text-white text-xs font-bold">5</span>
                                            </span>
                                        </div>
                                        <p
                                            class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                            Penyiapan pelaksanaan administrasi penyidikan tindak pidana pencucian uang yang
                                            berasal dari tindak pidana narkotika dalam wilayah Provinsi;</p>
                                    </li>
                                    <li class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                        <div class="flex-shrink-0 mt-1">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                <span class="text-white text-xs font-bold">6</span>
                                            </span>
                                        </div>
                                        <p
                                            class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                            Penyiapan pelaksanaan pengawasan distribusi prekursor sampai pada pengguna akhir
                                            dalam wilayah Provinsi;</p>
                                    </li>
                                    <li class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                        <div class="flex-shrink-0 mt-1">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                <span class="text-white text-xs font-bold">7</span>
                                            </span>
                                        </div>
                                        <p
                                            class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                            Penyiapan pelaksanaan pengawasan tahanan dan barang bukti dalam wilayah
                                            Provinsi;</p>
                                    </li>
                                    <li class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                        <div class="flex-shrink-0 mt-1">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                <span class="text-white text-xs font-bold">8</span>
                                            </span>
                                        </div>
                                        <p
                                            class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                            Penyiapan pelaksanaan pembinaan teknis dan supervisi P4GN di bidang
                                            pemberantasan kepada BNNK/Kota dalam wilayah Provinsi; dan</p>
                                    </li>
                                    <li class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                        <div class="flex-shrink-0 mt-1">
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                <span class="text-white text-xs font-bold">9</span>
                                            </span>
                                        </div>
                                        <p
                                            class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                            Penyiapan pelaksanaan evaluasi dan pelaporan P4GN di bidang pemberantasan dalam
                                            wilayah Provinsi.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Struktur Organisasi -->
                    <div class="mt-12 max-w-6xl mx-auto px-4">
                        <div class="relative pb-6 mb-8">
                            <h4
                                class="text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-red-600 pb-3">
                                Struktur Organisasi</h4>
                            <div
                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full">
                            </div>
                            <div class="absolute right-0 top-0">
                                <button type="button" onclick="openPegawaiModal()"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Kelola Susunan
                                </button>
                                {{-- <a href="{{ route('admin.data.index') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Edit Struktur
                                </a> --}}
                            </div>
                        </div>

                        <!-- Struktur Organisasi -->
                        <div
                            class="
                            {{-- bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-xl border border-blue-100  --}}
                            overflow-hidden relative mb-12 mt-8 p-8 ">
                            <div id="orgChart" class="org-chart-container">
                                {{-- <div
                                    class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full opacity-50 -mr-32 -mt-32 z-0">
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-red-100 to-red-50 rounded-full opacity-50 -ml-32 -mb-32 z-0">
                                </div> --}}

                                <div class="org-chart relative space-y-2">

                                    <!-- Kepala BNNP Jatim -->
                                    <div class="relative flex flex-col items-center mb-[-50px]">

                                        <!-- KOTAK -->
                                        <div
                                            class="flex items-center bg-white shadow-lg p-4 border-2 border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                            <div
                                                class="w-24 h-24 bg-white mr-5 overflow-hidden border-2 border-black shadow-inner flex items-center justify-center">
                                                <svg class="w-14 h-14 text-black" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                @php $ketua = $pegawai->where('jabatan','Ketua')->first(); @endphp
                                                <div class="text-black font-bold text-xl">Kepala BNNP Jatim</div>
                                                <div class="text-black text-md">{{ $ketua->nama ?? '-' }}</div>
                                            </div>
                                        </div>

                                        <!-- GARIS VERTIKAL KE BAWAH -->
                                        <div class="h-10 w-0.5 bg-gray-300"></div>

                                        <!-- GARIS HORIZONTAL -->
                                        <div class="w-full h-0.5 bg-gray-300"></div>

                                        <!-- CONTOH GARIS VERTIKAL DI KIRI DAN KANAN -->
                                        <div class="flex w-full justify-between">
                                            <div class="h-10 w-0.5 bg-gray-300"></div>
                                            <div class="h-10 w-0.5 bg-gray-300"></div>
                                        </div>
                                    </div>


                                    <!-- Kabid Pemberantasan dan Intelijen + Kabag Umum -->
                                    <div
                                        class="relative flex flex-col sm:flex-row justify-between mt-[-80px] space-x-[250px]">

                                        <!-- Kabid Pemberantasan dan Intelijen -->
                                        <div class="flex flex-col items-center sm:w-1/2">
                                            <div
                                                class="flex items-start bg-white shadow-lg h-[130px] w-[350px] px-3 py-2 border-2 border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                                <div
                                                    class="w-20 h-20 bg-white mr-4 overflow-hidden border-2 my-auto border-black shadow-inner flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-black my-auto" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left my-auto">
                                                    @php $kabidPemberantasan = $pegawai->where('jabatan','Kabid Pemberantasan')->first(); @endphp
                                                    <div class="text-black font-bold text-lg">Kabid Pemberantasan
                                                        dan Intelijen
                                                    </div>
                                                    <div class="text-black text-md">{{ $kabidPemberantasan->nama ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="h-[150px] w-0.5 bg-gray-300"></div>
                                            {{-- <div class="w-[120px] ml-[120px] h-0.5 bg-gray-300"></div> --}}
                                        </div>

                                        <!-- Kabag Umum -->
                                        <div class="flex flex-col items-center sm:w-1/2">
                                            <div
                                                class="flex items-start bg-white shadow-lg h-[130px] w-[350px] px-3 py-2 border-2 border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                                <div
                                                    class="w-20 h-20 bg-white mr-4 overflow-hidden border-2 my-auto border-black shadow-inner flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-black" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left my-auto">
                                                    @php $kabagUmum = $pegawai->where('jabatan','Kabag Umum')->first(); @endphp
                                                    <div class="text-black font-bold text-lg">Kabag Umum</div>
                                                    <div class="text-black text-md">{{ $kabagUmum->nama ?? '-' }}</div>
                                                </div>
                                            </div>
                                            <div class="h-[130px] w-0.5 bg-gray-300 ml-[120px]"></div>
                                            <!-- GARIS HORIZONTAL -->
                                            {{-- <div class="w-full translate-y-[120px] h-0.5 bg-gray-300"></div> --}}
                                        </div>
                                    </div>

                                    <!-- Kasi Intelijen dan Wastahti -->
                                    <div
                                        class="relative flex flex-col sm:flex-row space-y-4 sm:space-y-0 -translate-y-[120px] sm:space-x-3 ">
                                        <div class="w-full h-0.5 bg-gray-300"></div>
                                        <!-- Kasi Intelijen -->
                                        <div class="flex flex-col items-center w-full sm:w-1/2">
                                            <div
                                                class="flex items-start bg-white shadow-lg h-[130px] w-[350px] px-3 py-2 border-2 border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                                <div
                                                    class="w-17 h-17 bg-white mr-4 overflow-hidden border-2 my-auto border-black shadow-inner flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-black my-auto" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left my-auto">
                                                    @php $kasiIntelijen = $pegawai->where('jabatan','Kasi Intelijen')->first(); @endphp
                                                    <div class="text-black font-bold text-lg">Kasi Intelijen
                                                    </div>
                                                    <div class="text-black text-md">{{ $kasiIntelijen->nama ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex flex-row">
                                                <div class="h-[80px] w-0.5 bg-gray-300 mr-[200px]"></div>
                                                <div class="h-[80px] w-0.5 bg-gray-300 mt-[200px] -translate-y-[200px]">
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Kasi Wastahti -->
                                        <div class="flex flex-col items-center w-full sm:w-1/2 mt-[-80px]">
                                            <div
                                                class="flex items-start bg-white shadow-lg h-[130px] w-[350px] px-3 py-2 border-2 border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                                <div
                                                    class="w-17 h-17 bg-white mr-4 overflow-hidden border-2 my-auto border-black shadow-inner flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-black my-auto" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left my-auto">
                                                    @php $kasiWastahti = $pegawai->where('jabatan','Kasi Wastahti')->first(); @endphp
                                                    <div class="text-black font-bold text-lg">Kasi Wastati
                                                    </div>
                                                    <div class="text-black text-md">{{ $kasiWastahti->nama ?? '-' }}</div>
                                                </div>
                                            </div>
                                            <div class="flex flex-row">
                                                <div class="h-[80px] w-0.5 bg-gray-300 mr-[200px]"></div>
                                                <div class="h-[80px] w-0.5 bg-gray-300 mt-[200px] -translate-y-[200px]">
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Koordinator dan Kelompok Jabatan Fungsional -->
                                        <div class="flex flex-col items-center w-full sm:w-1/2 space-y-4 mt-[-50px]">
                                            <div
                                                class="flex items-start bg-white shadow-lg h-[110px] w-[200px] px-2 py-1 border-2 border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                                <div class="text-left my-auto">
                                                    <div class="text-black text-center font-bold text-lg">Koordinator dan
                                                        Kelompok Jabatan
                                                        Fungsional</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="h-[500px] w-0.5 bg-gray-300 mr-[200px]"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:space-x-[100px] -translate-y-[50px] ml-[15px]">
                            <!-- Kolom Kiri: Analisis Intelijen -->
                            <div class="flex flex-col items-center w-full sm:w-1/2 space-y-4 mt-[-480px]">

                                <!-- Kotak: Analisis Intelijen -->
                                <div
                                    class="flex items-start bg-white shadow-lg w-[250px] px-5 py-3 border border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                    <div class="text-left my-auto">
                                        <div class="text-black font-bold text-lg">Analisis Intelijen Sie Intelijen
                                        </div>
                                        <div class="text-black text-md">
                                            <ol class="list-disc list-inside">
                                                @forelse ($pegawai->where('jabatan', 'Analisis Intelijen') as $analisisIntelijen)
                                                    <li>{{ $analisisIntelijen->nama }}</li>
                                                @empty
                                                    <li>-</li>
                                                @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-[20px] w-0.5 bg-gray-300 -translate-y-[16px]"></div>

                                <!-- Kotak: Penyidik Sie Intelijen -->
                                <div
                                    class="flex items-start bg-white shadow-lg w-[250px] -translate-y-[32px] px-5 py-3 border border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs mt-4">
                                    <div class="text-left my-auto">
                                        <div class="text-black font-bold text-lg">Penyidik Sie Intelijen</div>
                                        <div class="text-black text-md">
                                            <ol class="list-disc list-inside">
                                                @forelse ($pegawai->where('jabatan','Penyidik Sie Intelijen') as $penyidikSieIntelijen)
                                                    <li>{{ $penyidikSieIntelijen->nama }}</li>
                                                @empty
                                                    <li>-</li>
                                                @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="h-[20px] w-0.5 bg-gray-300 -translate-y-[48px]"></div>

                                <!-- Kotak: Petugas Pengejaran Sie Intelijen -->
                                <div
                                    class="flex items-start bg-white shadow-lg w-[250px] -translate-y-[63px] px-5 py-3 border border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                    <div class="text-left my-auto">
                                        <div class="text-black font-bold text-lg">Petugas Pengejaran Sie Intelijen
                                        </div>
                                        <div class="text-black text-md">
                                            <ol class="list-disc list-inside">
                                                @forelse ($pegawai->where('jabatan','Petugas Pengejaran') as $petugasPengejaranSieIntelijen)
                                                    <li>{{ $petugasPengejaranSieIntelijen->nama }}</li>
                                                @empty
                                                    <li>-</li>
                                                @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-[20px] w-0.5 bg-gray-300 -translate-y-[79px]"></div>

                                <!-- Kotak: Petugas Penindakan Sie Intelijen -->
                                <div
                                    class="flex items-start bg-white shadow-lg w-[250px] -translate-y-[95px] px-5 py-3 border border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                    <div class="text-left my-auto">
                                        <div class="text-black font-bold text-lg">Petugas Penindakan Sie Intelijen
                                        </div>
                                        <div class="text-black text-md">
                                            <ol class="list-disc list-inside">
                                                @forelse ($pegawai->where('jabatan','Petugas Penindakan Sie Intelijen') as $petugasPenindakanSieIntelijen)
                                                    <li>{{ $petugasPenindakanSieIntelijen->nama }}</li>
                                                @empty
                                                    <li>-</li>
                                                @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-[20px] w-0.5 bg-gray-300 -translate-y-[110px]"></div>

                                <!-- Kotak: Pengolah Data Sie Intelijen -->
                                <div
                                    class="flex items-start bg-white shadow-lg w-[250px] -translate-y-[130px] px-5 py-3 border border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                    <div class="text-left my-auto">
                                        <div class="text-black font-bold text-lg">Pengolah Data Sie Intelijen</div>
                                        <div class="text-black text-md">
                                            <ol class="list-disc list-inside">
                                                @forelse ($pegawai->where('jabatan','Pengolah Data Sie Intelijen') as $pengolahDataSieIntelijen)
                                                    <li>{{ $pengolahDataSieIntelijen->nama }}</li>
                                                @empty
                                                    <li>-</li>
                                                @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="h-[40px] w-0.5 bg-gray-300 -translate-y-[16px]"></div>

                            <!-- Kolom Kanan: Penjaga Tahanan -->
                            <div
                                class="flex flex-col items-center w-full sm:w-1/2 -mr-[100px] space-y-4 mt-[-480px] translate-x-[-243px]">

                                <!-- Kotak: Analisis Intelijen (Sama dengan Kolom Kiri, bisa disesuaikan) -->
                                <div
                                    class="flex items-start bg-white shadow-lg w-[250px] px-5 py-3 border border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                    <div class="text-left my-auto">
                                        <div class="text-black font-bold text-lg">Penjaga Tahanan
                                        </div>
                                        <div class="text-black text-md">
                                            <ol class="list-disc list-inside">
                                                @forelse ($pegawai->where('jabatan','Penjaga Tahanan') as $penjagaTahanan)
                                                    <li>{{ $penjagaTahanan->nama }}</li>
                                                @empty
                                                    <li>-</li>
                                                @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-[20px] w-0.5 bg-gray-300 -translate-y-[16px]"></div>

                                <!-- Kotak: Penyidik Sie Intelijen -->
                                <div
                                    class="flex items-start bg-white shadow-lg -translate-y-[32px] w-[250px] px-5 py-3 border border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs mt-4">
                                    <div class="text-left my-auto">
                                        <div class="text-black font-bold text-lg">Pengadministrasian Umum</div>
                                        <div class="text-black text-md">
                                            <ol class="list-disc list-inside">
                                                @forelse ($pegawai->where('jabatan','Pengadministrasian Umum') as $pengadministrasianUmum)
                                                    <li>{{ $pengadministrasianUmum->nama }}</li>
                                                @empty
                                                    <li>-</li>
                                                @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kotak lainnya mengikuti struktur yang sama -->
                                <!-- Kamu bisa menambah kotak lainnya di sini dengan cara yang sama -->

                            </div>
                        </div>


                        <!-- Penjaga Tahanan -->
                        {{-- <div class="flex flex-col items-center w-full sm:w-1/2 ml-[150px] mt-[-680px]">
                                    <div
                                        class="flex items-start bg-white shadow-lg w-[250px] px-5 py-3 border border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs">
                                        <div class="text-left my-auto">
                                            <div class="text-black font-bold text-lg">Penjaga Tahanan</div>
                                            <div class="text-black text-md">
                                                <ol class="list-disc list-inside">
                                                    <li>Roy Agung T.</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-10 h-0.5 bg-gray-300 mt-2 ml-0"></div>

                                    <div
                                        class="flex items-start bg-white shadow-lg w-[250px] px-5 py-3 border border-black hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 max-w-xs mt-4">
                                        <div class="text-left my-auto">
                                            <div class="text-black font-bold text-lg">Penjaga Tahanan Tambahan</div>
                                            <div class="text-black text-md">Detail tambahan untuk Penjaga Tahanan.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="h-12 w-0.5 bg-gray-300 mr-12 mt-4"></div>
                                </div> --}}
                    </div>
                </div>

                <div
                    class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-xl p-8 border border-blue-100 overflow-hidden relative mb-12">
                    <div class="space-y-6">
                        <!-- Tabel Komposisi -->
                        <div class="relative pb-6 mb-8">
                            <h4
                                class="text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-red-600 pb-3">
                                Komposisi Personil Pemberantasan</h4>
                            <div
                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow">
                        <div class="relative px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Rincian Komposisi</h3>
                            <div class="absolute right-0 top-0 mt-3 mr-4">
                                <a href="#" onclick="openKomposisiModal()"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                    Tambah Komposisi
                                </a>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th rowspan="2"
                                            class="px-6 py-3 text-center text-lg font-medium text-gray-500 uppercase tracking-wider border-r">
                                            BIDANG/SEKSI
                                        </th>
                                        <th rowspan="2"
                                            class="px-2 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider border-r">
                                            JUMLAH <br>PERSONIL
                                        </th>
                                        <th colspan="3"
                                            class="px-4 py-3 text-center text-base font-medium text-gray-500 uppercase tracking-wider border-b border-r">
                                            DSP
                                        </th>
                                        <th rowspan="2"
                                            class="px-6 py-3 text-center text-base font-medium text-gray-500 uppercase tracking-wider border-r">
                                            KETERANGAN
                                        </th>
                                        <th rowspan="2"
                                            class="px-2 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                            AKSI
                                        </th>
                                    </tr>
                                    <tr>
                                        <th
                                            class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                            JUMLAH</th>
                                        <th
                                            class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                            TERISI</th>
                                        <th
                                            class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">
                                            KOSONG</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($komposisiList as $komposisi)
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="px-6 py-3 whitespace-nowrap text-left text-sm font-medium text-gray-900 border-r uppercase">
                                                {{ $komposisi->bidang }}</td>
                                            <td class="px-2 py-3 text-sm text-gray-900 bg-green-100 text-center border-r">
                                                {{ $komposisi->jumlah_personil }}</td>
                                            <td class="px-2 py-3 text-sm text-gray-900 bg-blue-100 text-center border-r">
                                                {{ $komposisi->dsp_jumlah }}</td>
                                            <td class="px-2 py-3 text-sm text-gray-900 bg-red-100 text-center border-r">
                                                {{ $komposisi->dsp_kosong }}</td>
                                            <td class="px-2 py-3 text-sm text-gray-900 bg-yellow-100 text-center border-r">
                                                {{ $komposisi->dsp_terisi }}</td>
                                            <td class="px-6 py-3 text-sm text-gray-900 bg-white text-left border-r">
                                                {{ $komposisi->keterangan }}</td>
                                            <td class="flex items-center justify-center space-x-2">
                                                {{-- Tombol Edit --}}
                                                <a href="#" onclick="openKomposisiModal(this.dataset)"
                                                    data-id="{{ $komposisi->id }}"
                                                    data-bidang="{{ $komposisi->bidang }}"
                                                    data-jumlah_personil="{{ $komposisi->jumlah_personil }}"
                                                    data-dsp_jumlah="{{ $komposisi->dsp_jumlah }}"
                                                    data-dsp_terisi="{{ $komposisi->dsp_terisi }}"
                                                    data-dsp_kosong="{{ $komposisi->dsp_kosong }}"
                                                    data-keterangan="{{ $komposisi->keterangan }}"
                                                    class="inline-flex items-center px-2 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>

                                                {{-- Tombol Delete --}}
                                                <form
                                                    action="{{ route('super-admin.komposisi.destroy', $komposisi->id) }}"
                                                    method="POST" onsubmit="return confirmDeleteKomposisi(event)"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-2 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-red-600 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:-translate-y-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-6 4h8" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>


                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"
                                                class="px-6 py-4 text-center text-sm font-medium text-gray-900">
                                                Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="1"
                                            class="px-6 py-4 text-center text-sm font-bold border-r text-gray-900">
                                            TOTAL</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-green-100 border-r">
                                            {{ $totalPersonil }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-blue-100 border-r">
                                            {{ $totalDspJumlah }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-red-100 border-r">
                                            {{ $totalDspTerisi }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-yellow-100 border-r">
                                            {{ $totalDspKosong }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- Removed all extra table elements that were outside the table structure -->
                        </div>
                    </div>


                </div>
            </div>

            <div
                class="bg-gradient-to-br from-white to-blue-50 w-full shadow-xl p-8 border border-blue-100 overflow-hidden relative mb-12">
                <!-- New Gallery Section Below Komposisi Personil -->
                <div id="gallery-section" class="gallery-section">
                    <div class="relative mb-8">
                        <h4
                            class="text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-red-600 pb-3">
                            Galeri Foto
                        </h4>
                        <div
                            class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full">
                        </div>
                    </div>

                    <!-- Add Photo Button -->
                    <div class="text-center mb-4">
                        <button id="addPhotoBtn"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                            Tambah Foto
                        </button>
                    </div>

                    <!-- Gallery Container -->
                    <div class="flex flex-wrap justify-center gap-4">
                        @if (isset($galeri) && count($galeri) > 0)
                            <div class="relative w-full max-w-xl">
                                <!-- Menampilkan gambar berdasarkan index aktif -->
                                <div class="flex justify-center items-center">
                                    <button id="prevBtn"
                                        class="absolute left-0 text-white bg-black bg-opacity-50 p-2 rounded-full">
                                        &lt;
                                    </button>
                                    <div class="relative w-96 h-96 bg-gray-200 rounded-lg overflow-hidden">
                                        <!-- Container for images with transition effect -->
                                        <img id="galleryImage" src="{{ asset('storage/' . $galeri[0]->image_path) }}"
                                            alt="Image"
                                            class="w-full h-full object-cover transition-all duration-500 opacity-100">
                                        <div id="imageDescription"
                                            class="absolute bottom-0 left-0 w-full bg-black bg-opacity-50 text-white p-2 text-sm">
                                            {{ $galeri[0]->description ?? 'No Description' }}
                                        </div>
                                    </div>
                                    <button id="nextBtn"
                                        class="absolute right-0 text-white bg-black bg-opacity-50 p-2 rounded-full">
                                        &gt;
                                    </button>
                                </div>
                                <!-- Timer Display -->
                                <div class="text-center mt-2">
                                    <p id="timer" class="text-lg font-bold text-black">10</p>
                                </div>
                            </div>
                        @else
                            <p>No gallery images found.</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Informasi Kontak -->
            {{-- <div class="mt-8 bg-gradient-to-r from-red-600 to-red-700 rounded-lg p-6 text-white">
            <h4 class="text-lg font-semibold mb-4">Informasi Kontak</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Jl. Ahmad Yani No. 116, Surabaya</span>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <span>(031) 502-1234</span>
                </div>
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span>bnnp.jatim@bnn.go.id</span>
                </div>
            </div>
        </div> --}}

        </div>
    </div>

    </div>

    <style>
        .tab-button {
            position: relative;
            transition: all 0.2s ease-in-out;
        }

        .tab-button.active {
            border-bottom: 2px solid #2563eb;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #2563eb;
        }

        .tab-button.inactive:hover {
            color: #374151;
        }

        .tab-button.inactive:hover svg {
            color: #374151;
        }

        /* Struktur Organisasi Chart Styles */
        .org-chart-container {
            width: 100%;
            overflow-x: auto;
            padding: 20px 0;
        }

        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
        }

        .org-level {
            display: flex;
            justify-content: center;
            width: 100%;
            position: relative;
        }

        .org-level::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            height: 20px;
            width: 2px;
            background-color: #94a3b8;
        }

        .org-level:first-child::before {
            display: none;
        }

        .org-level-directors {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            width: 100%;
        }

        .org-box {
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            position: relative;
            transition: all 0.3s ease;
        }

        .org-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .org-head {
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
            color: white;
        }

        .org-secretary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .org-director {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            color: white;
        }

        .org-content {
            text-align: center;
        }

        .org-title {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .org-name {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        /* Connector lines for directors */
        .org-level-directors::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            width: 80%;
            height: 2px;
            background-color: #94a3b8;
            transform: translateX(-50%);
        }

        .org-level-directors .org-box::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            height: 20px;
            width: 2px;
            background-color: #94a3b8;
            transform: translateX(-50%);
        }

        @media (max-width: 768px) {
            .org-level-directors {
                grid-template-columns: 1fr;
            }

            .org-level-directors::before {
                width: 2px;
                height: calc(100% + 40px);
                top: -40px;
                left: 50%;
                transform: translateX(-50%);
            }

            .org-level-directors .org-box::before {
                height: 20px;
                top: -20px;
            }

            .org-chart {
                gap: 30px;
            }
        }
    </style>


    <!-- Modal Semua Kabupaten -->
    <div id="allKabupatenModal"
        class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4 mt-12">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Semua Kabupaten/Kota Berdasarkan Jumlah Kasus
                </h3>
                <button id="closeKabupatenModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-auto flex-grow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kabupaten/Kota</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Kasus</th>
                            </tr>
                        </thead>
                        <tbody id="allKabupatenTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Semua Kecamatan -->
    <div id="allKecamatanModal"
        class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4 mt-12">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Semua Kecamatan Berdasarkan Jumlah Kasus</h3>
                <button id="closeKecamatanModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-4 overflow-auto flex-grow">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kecamatan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kabupaten/Kota</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Kasus</th>
                            </tr>
                        </thead>
                        <tbody id="allKecamatanTableBody" class="bg-white divide-y divide-gray-200">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                    <div class="mt-4">
                        <!-- Previous and Next buttons will appear automatically with pagination -->
                        {{ $allKecamatanTkpList->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Anggaran -->
    <div id="tambahAnggaranModal"
        class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4 mt-12">

        <div
            class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 ease-in-out">

            <div class="relative px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Anggaran Baru</h3>
                <button id="closeModalBtn"
                    class="absolute top-[20px] right-4 text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            {{-- <form action="#" method="POST" class="p-6 space-y-4"> --}}
            <form action="{{ route('super-admin.anggaran.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label for="akun" class="block text-sm font-medium text-gray-700">AKUN</label>
                    <input type="text" id="akun" name="akun"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm uppercase">
                </div>

                <div>
                    <label for="kegiatan" class="block text-sm font-medium text-gray-700">KEGIATAN</label>
                    <textarea id="kegiatan" name="kegiatan" rows="3"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="anggaran_sebelum" class="block text-sm font-medium text-gray-700">ANGGARAN SEBELUM
                            BLOKIR</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span
                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                Rp
                            </span>
                            <input type="number" id="anggaran_sebelum" name="anggaran_sebelum" step="0.01"
                                min="0"
                                class="block w-full rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="blokir" class="block text-sm font-medium text-gray-700">BLOKIR</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span
                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                Rp
                            </span>
                            <input type="number" id="blokir" name="blokir" step="0.01" min="0"
                                class="block w-full rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex justify-end space-x-3">
                    <button type="button" id="cancelModalBtn"
                        class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Anggaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- @php
            // Fallback kalau $jabatanList belum dikirim dari controller
            $jabatanList = $jabatanList ?? [
                'Ketua',
                'Wakil Ketua',
                'Sekretaris',
                'Bendahara',
                'Divisi Humas',
                'Divisi Keuangan',
                'Divisi Acara',
                'Anggota',
            ];
        @endphp --}}

    <!-- Modal Pegawai -->
    <div id="pegawaiModal" class="fixed inset-0 hidden items-center justify-center p-4 bg-black/50 z-[9999]">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Kelola Susunan Organisasi</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closePegawaiModal()">✕</button>
            </div>

            <!-- Body -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-6 overflow-auto">

                {{-- FORM TAMBAH BANYAK --}}
                <div>
                    <h4 class="font-semibold mb-3">Tambah Banyak</h4>
                    <form id="pegawaiCreateForm" method="POST" action="{{ route('super-admin.pegawai.store') }}"
                        class="space-y-3">
                        @csrf

                        {{-- Dropdown Jabatan (dinamis dari controller) --}}
                        <label class="block text-sm font-medium">Jabatan</label>
                        <select name="jabatan" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach ($jabatanList as $j)
                                <option value="{{ $j }}">{{ $j }}</option>
                            @endforeach
                        </select>

                        {{-- Nama[] dinamis --}}
                        <div class="space-y-2" id="namaWrapper">
                            <div class="flex gap-2">
                                <input type="text" name="nama[]" class="w-full border rounded px-3 py-2"
                                    placeholder="Nama Pegawai" required>
                                <button type="button" onclick="addNamaField()"
                                    class="px-3 py-2 bg-green-500 text-white rounded">+</button>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>

                {{-- FORM EDIT SATU ORANG --}}
                <div>
                    <h4 class="font-semibold mb-3">Edit Data</h4>
                    <form id="pegawaiEditForm" method="POST" action="#" class="space-y-3">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <input type="hidden" id="edit_id">
                        <div>
                            <label class="block text-sm font-medium">Nama</label>
                            <input type="text" id="edit_nama" name="nama" class="w-full border rounded px-3 py-2"
                                placeholder="Nama Pegawai">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Jabatan</label>
                            <select id="edit_jabatan" name="jabatan" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach ($jabatanList as $j)
                                    <option value="{{ $j }}">{{ $j }}</option>
                                @endforeach
                                {{-- extra option kalau value edit tidak ada di list --}}
                                <option value="" id="edit_jabatan_extra" class="hidden"></option>
                            </select>
                        </div>

                        <div class="flex gap-2 pt-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                            <button type="button" onclick="clearEditForm()"
                                class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Bersihkan</button>
                        </div>
                    </form>

                </div>

                {{-- TABEL DATA --}}
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="font-semibold">Daftar Pegawai</h4>
                        {{-- (Opsional) Filter cepat berdasarkan jabatan --}}
                        <form method="GET" action="" class="flex items-center gap-2">
                            <select name="filter_jabatan" class="border rounded px-2 py-1" onchange="this.form.submit()">
                                <option value="">Semua Jabatan</option>
                                @foreach ($jabatanList as $j)
                                    <option value="{{ $j }}" @selected(request('filter_jabatan') === $j)>
                                        {{ $j }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="overflow-x-auto border rounded">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-3 py-2 text-left">#</th>
                                    <th class="px-3 py-2 text-left">Nama</th>
                                    <th class="px-3 py-2 text-left">Jabatan</th>
                                    <th class="px-3 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pegawai as $i => $p)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-3 py-2">{{ $i + 1 }}</td>
                                        <td class="px-3 py-2">{{ $p->nama }}</td>
                                        <td class="px-3 py-2">{{ $p->jabatan }}</td>
                                        <td class="px-3 py-2">
                                            <div class="flex items-center justify-center gap-2">
                                                {{-- EDIT: isi form edit di panel kanan modal --}}
                                                <button type="button"
                                                    class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700"
                                                    onclick="fillEditForm(this.dataset)" data-id="{{ $p->id }}"
                                                    data-nama="{{ $p->nama }}" data-jabatan="{{ $p->jabatan }}">
                                                    ✏️
                                                </button>

                                                {{-- DELETE --}}
                                                <form method="POST"
                                                    action="{{ route('super-admin.pegawai.destroy', $p->id) }}"
                                                    onsubmit="return confirm('Yakin hapus {{ $p->nama }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-3 py-6 text-center text-gray-500">Belum ada data
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Edit Komposisi -->
    <div id="komposisiModal" class="fixed inset-0 hidden items-center justify-center p-4 bg-black bg-opacity-50"
        style="z-index: 9999;">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900" id="komposisiModalTitle">Edit Komposisi</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700"
                    onclick="closeKomposisiModal()">✕</button>
            </div>

            <form id="komposisiForm" method="POST" action="{{ route('super-admin.komposisi.store') }}"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="komposisiFormMethod" value="POST" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Bidang/Seksi</label>
                        <input name="bidang" id="komposisi_bidang" type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Jumlah Personil</label>
                        <input name="jumlah_personil" id="komposisi_jumlah_personil" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">DSP Jumlah</label>
                        <input name="dsp_jumlah" id="komposisi_dsp_jumlah" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">DSP Terisi</label>
                        <input name="dsp_terisi" id="komposisi_dsp_terisi" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">DSP Kosong</label>
                        <input name="dsp_kosong" id="komposisi_dsp_kosong" type="number" min="0" readonly
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 uppercase">Keterangan</label>
                    <textarea name="keterangan" id="komposisi_keterangan" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeKomposisiModal()"
                        class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Adding New Photo -->
    <div id="addPhotoModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Foto Baru</h3>

                <!-- Image Upload Form -->
                <form action="{{ route('super-admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <label for="image" class="block text-sm font-medium text-gray-700">Pilih Foto</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md"
                            onclick="closeAddPhotoModal()">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Data dari controller
            const kasusPerKabupaten = @json($kasusPerKabupaten);
            const kasusPerKecamatan = @json($kasusPerKecamatan);
            const trendBulanan = @json($trendBulanan);
            const statusPie = @json($statusPie);
            const residivisPie = @json($residivisPie);
            const kasusPerKabupatenNik = @json($kasusPerKabupatenNik);
            const kasusPerKecamatanNik = @json($kasusPerKecamatanNik);

            // Grafik Kasus per Kabupaten
            const ctxKabupaten = document.getElementById('chartKabupaten').getContext('2d');
            new Chart(ctxKabupaten, {
                type: 'bar',
                data: {
                    labels: kasusPerKabupaten.map(item => item.kabupaten),
                    datasets: [{
                        label: 'Jumlah Kasus',
                        data: kasusPerKabupaten.map(item => item.total),
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Grafik Kasus per Kecamatan
            const ctxKecamatan = document.getElementById('chartKecamatan').getContext('2d');
            new Chart(ctxKecamatan, {
                type: 'bar',
                data: {
                    labels: kasusPerKecamatan.map(item => item.kecamatan),
                    datasets: [{
                        label: 'Jumlah Kasus',
                        data: kasusPerKecamatan.map(item => item.total),
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Grafik Trend Bulanan
            const bulanNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            const trendData = new Array(12).fill(0);
            trendBulanan.forEach(item => {
                trendData[item.bulan - 1] = item.total;
            });

            const ctxTrend = document.getElementById('chartTrend').getContext('2d');
            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: bulanNames,
                    datasets: [{
                        label: 'Kasus per Bulan',
                        data: trendData,
                        borderColor: 'rgba(245, 158, 11, 1)',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Pie Chart Status Individu
            const ctxStatusPie = document.getElementById('chartStatusPie').getContext('2d');
            new Chart(ctxStatusPie, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(statusPie),
                    datasets: [{
                        data: Object.values(statusPie),
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)', // Napi
                            'rgba(16, 185, 129, 0.8)' // Non napi
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(16, 185, 129, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Pie Chart Residivis Individu
            const ctxResidivisPie = document.getElementById('chartResidivisPie').getContext('2d');
            new Chart(ctxResidivisPie, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(residivisPie),
                    datasets: [{
                        data: Object.values(residivisPie),
                        backgroundColor: [
                            'rgba(239, 68, 68, 0.8)', // Residivis
                            'rgba(245, 158, 11, 0.8)' // Non Residivis
                        ],
                        borderColor: [
                            'rgba(239, 68, 68, 1)',
                            'rgba(245, 158, 11, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });


            // Grafik Kasus per Kecamatan
            const ctxKecamatanNik = document.getElementById('chartKecamatanNik').getContext('2d');
            console.error("Canvas untuk chartKecamatanNik tidak ditemukan!");
            new Chart(ctxKecamatanNik, {
                type: 'bar',
                data: {
                    labels: kasusPerKecamatanNik.map(item => item.kecamatan),
                    datasets: [{
                        label: 'Jumlah Kasus',
                        data: kasusPerKecamatanNik.map(item => item.total),
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            // Grafik Kasus per Kabupaten
            const ctxKabupatenNik = document.getElementById('chartKabupatenNik').getContext('2d');
            new Chart(ctxKabupatenNik, {
                type: 'bar',
                data: {
                    labels: kasusPerKabupatenNik.map(item => item.kabupaten),
                    datasets: [{
                        label: 'Jumlah Kasus',
                        data: kasusPerKabupatenNik.map(item => item.total),
                        backgroundColor: 'rgba(59, 130, 246, 0.8)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Modal dan Tabel Desa/Kecamatan
            const showAllKabupatenBtn = document.getElementById('showAllKabupatenBtn');
            const showAllKecamatanBtn = document.getElementById('showAllKecamatanBtn');
            const allKabupatenModal = document.getElementById('allKabupatenModal');
            const allKecamatanModal = document.getElementById('allKecamatanModal');
            const closeKabupatenModal = document.getElementById('closeKabupatenModal');
            const closeKecamatanModal = document.getElementById('closeKecamatanModal');
            const allKabupatenTableBody = document.getElementById('allKabupatenTableBody');
            const allKecamatanTableBody = document.getElementById('allKecamatanTableBody');

            // Modal dan Tabel Desa/Kecamatan NIK
            const showAllKabupatenBtnNik = document.getElementById('showAllKabupatenBtnNik');
            const showAllKecamatanBtnNik = document.getElementById('showAllKecamatanBtnNik');
            const allKabupatenModalNik = document.getElementById('allKabupatenModalNik');
            const allKecamatanModalNik = document.getElementById('allKecamatanModalNik');
            const closeKabupatenModalNik = document.getElementById('closeKabupatenModalNik');
            const closeKecamatanModalNik = document.getElementById('closeKecamatanModalNik');
            const allKabupatenTableBodyNik = document.getElementById('allKabupatenTableBodyNik');
            const allKecamatanTableBodyNik = document.getElementById('allKecamatanTableBodyNik');

            // Fungsi untuk menampilkan modal desa
            showAllKabupatenBtn.addEventListener('click', function() {
                // Urutkan data Kabupaten berdasarkan jumlah kasus (dari tertinggi ke terendah)
                const sortedKabupaten = [...kasusPerKabupaten].sort((a, b) => b.total - a.total);

                // Bersihkan tabel
                allKabupatenTableBody.innerHTML = '';

                // Isi tabel dengan semua data Kabupaten
                sortedKabupaten.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.className = index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                    row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.kabupaten}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-semibold">${item.total}</td>
        `;
                    allKabupatenTableBody.appendChild(row);
                });

                // Tampilkan modal
                allKabupatenModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });

            // Fungsi untuk menampilkan modal kecamatan
            showAllKecamatanBtn.addEventListener('click', function() {
                // Urutkan data kecamatan berdasarkan jumlah kasus (dari tertinggi ke terendah)
                const sortedKecamatan = [...kasusPerKecamatan].sort((a, b) => b.total - a.total);

                // Bersihkan tabel
                allKecamatanTableBody.innerHTML = '';

                // Isi tabel dengan semua data kecamatan
                sortedKecamatan.forEach((item, index) => {
                    const row = document.createElement('tr');
                    row.className = index % 2 === 0 ? 'bg-white' : 'bg-gray-50';
                    row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.kecamatan}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.kabupaten}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-semibold">${item.total}</td>
        `;
                    allKecamatanTableBody.appendChild(row);
                });

                // Tampilkan modal
                allKecamatanModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });

            // Tutup modal desa
            closeKabupatenModal.addEventListener('click', function() {
                allKabupatenModal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });

            // Tutup modal kecamatan
            closeKecamatanModal.addEventListener('click', function() {
                allKecamatanModal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });

            // Tutup modal saat klik di luar modal
            allKabupatenModal.addEventListener('click', function(e) {
                if (e.target === allKabupatenModal) {
                    allKabupatenModal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });

            allKecamatanModal.addEventListener('click', function(e) {
                if (e.target === allKecamatanModal) {
                    allKecamatanModal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });

            // JavaScript untuk toggle konten dashboard
            document.addEventListener('DOMContentLoaded', function() {
                const statistikTab = document.getElementById('statistikTab');
                const anggaranTab = document.getElementById('anggaranTab');
                const profilTab = document.getElementById('profilTab');
                const statistikContent = document.getElementById('statistikContent');
                const anggaranContent = document.getElementById('anggaranContent');
                const profilContent = document.getElementById('profilContent');

                // Default tampilkan statistik
                statistikContent.classList.remove('hidden');
                anggaranContent.classList.add('hidden');
                profilContent.classList.add('hidden');

                // Function to reset all tabs
                function resetTabs() {
                    // Remove active classes
                    statistikTab.classList.remove('active');
                    anggaranTab.classList.remove('active');
                    profilTab.classList.remove('active');

                    // Add inactive classes
                    statistikTab.classList.add('inactive');
                    anggaranTab.classList.add('inactive');
                    profilTab.classList.add('inactive');

                    // Hide all content
                    statistikContent.classList.add('hidden');
                    anggaranContent.classList.add('hidden');
                    profilContent.classList.add('hidden');

                    // Reset colors to gray
                    document.querySelectorAll('.tab-button svg').forEach(svg => {
                        svg.classList.remove('text-blue-600');
                        svg.classList.add('text-gray-500');
                    });
                    document.querySelectorAll('.tab-button span').forEach(span => {
                        span.classList.remove('text-blue-600');
                        span.classList.add('text-gray-700');
                    });
                }

                // Animasi untuk struktur organisasi
                function animateOrgChart() {
                    if (profilContent.classList.contains('hidden')) return;

                    const orgBoxes = document.querySelectorAll('.org-box');
                    orgBoxes.forEach((box, index) => {
                        setTimeout(() => {
                            box.style.opacity = '1';
                            box.style.transform = 'translateY(0)';
                        }, 100 * index);
                    });
                }

                // Set initial state for org chart boxes
                const orgBoxes = document.querySelectorAll('.org-box');
                orgBoxes.forEach(box => {
                    box.style.opacity = '0';
                    box.style.transform = 'translateY(20px)';
                    box.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                });

                // Event listener untuk pilihan Statistik
                statistikTab.addEventListener('click', function() {
                    resetTabs();
                    statistikContent.classList.remove('hidden');
                    statistikTab.classList.remove('inactive');
                    statistikTab.classList.add('active');
                    statistikTab.querySelector('svg').classList.remove('text-gray-500');
                    statistikTab.querySelector('svg').classList.add('text-blue-600');
                    statistikTab.querySelector('span').classList.remove('text-gray-700');
                    statistikTab.querySelector('span').classList.add('text-blue-600');
                });

                // Event listener untuk pilihan Anggaran
                anggaranTab.addEventListener('click', function() {
                    resetTabs();
                    anggaranContent.classList.remove('hidden');
                    anggaranTab.classList.remove('inactive');
                    anggaranTab.classList.add('active');
                    anggaranTab.querySelector('svg').classList.remove('text-gray-500');
                    anggaranTab.querySelector('svg').classList.add('text-blue-600');
                    anggaranTab.querySelector('span').classList.remove('text-gray-700');
                    anggaranTab.querySelector('span').classList.add('text-blue-600');

                    // Initialize budget charts when tab is opened
                    initializeBudgetCharts();
                });

                // Event listener untuk pilihan Profil Organisasi
                profilTab.addEventListener('click', function() {
                    resetTabs();
                    profilContent.classList.remove('hidden');
                    profilTab.classList.remove('inactive');
                    profilTab.classList.add('active');
                    profilTab.querySelector('svg').classList.remove('text-gray-500');
                    profilTab.querySelector('svg').classList.add('text-blue-600');
                    profilTab.querySelector('span').classList.remove('text-gray-700');
                    profilTab.querySelector('span').classList.add('text-blue-600');

                    // Aktifkan animasi struktur organisasi
                    setTimeout(animateOrgChart, 300);
                });

                // Initialize budget charts
                function initializeBudgetCharts() {
                    // Chart Anggaran per Program
                    const ctxAnggaran = document.getElementById('chartAnggaran');
                    if (ctxAnggaran) {
                        const ctx = ctxAnggaran.getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Pencegahan', 'Pemberantasan', 'Rehabilitasi', 'Diklat', 'Kerjasama',
                                    'Operasional'
                                ],
                                datasets: [{
                                    label: 'Anggaran (Miliar)',
                                    data: [2.5, 3.2, 4.8, 1.8, 0.9, 1.9],
                                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                    borderColor: 'rgba(59, 130, 246, 1)',
                                    borderWidth: 1
                                }, {
                                    label: 'Realisasi (Miliar)',
                                    data: [1.8, 2.1, 2.4, 1.62, 0.27, 0.52],
                                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                    borderColor: 'rgba(16, 185, 129, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Jumlah (Miliar Rupiah)'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                }
                            }
                        });
                    }

                    // Chart Trend Anggaran Bulanan
                    const ctxTrendAnggaran = document.getElementById('chartTrendAnggaran');
                    if (ctxTrendAnggaran) {
                        const ctx = ctxTrendAnggaran.getContext('2d');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt',
                                    'Nov', 'Des'
                                ],
                                datasets: [{
                                    label: 'Realisasi Kumulatif (%)',
                                    data: [5, 12, 18, 28, 35, 42, 48, 52, 55, 57, 57, 57],
                                    borderColor: 'rgba(245, 158, 11, 1)',
                                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                    tension: 0.4,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 100,
                                        title: {
                                            display: true,
                                            text: 'Persentase Realisasi (%)'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    }
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                // Ambil elemen-elemen modal
                const openModalBtn = document.getElementById('openModalBtn');
                const modal = document.getElementById('tambahAnggaranModal');
                const closeModalBtn = document.getElementById('closeModalBtn');
                const cancelModalBtn = document.getElementById('cancelModalBtn');

                // Fungsi untuk membuka modal
                const openModal = () => {
                    modal.classList.remove('hidden');
                };

                // Fungsi untuk menutup modal
                const closeModal = () => {
                    modal.classList.add('hidden');
                };

                // Event listener untuk tombol "Tambah Anggaran"
                if (openModalBtn) {
                    openModalBtn.addEventListener('click', (e) => {
                        e.preventDefault(); // Mencegah link default
                        openModal();
                    });
                }

                // Event listener untuk tombol close 'X' dan 'Batal'
                if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
                if (cancelModalBtn) cancelModalBtn.addEventListener('click', closeModal);

                // Event listener untuk menutup modal saat mengklik di luar area modal
                modal.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        closeModal();
                    }
                });
            });

            function autoCalcKosong() {
                const j = document.getElementById('komposisi_dsp_jumlah');
                const t = document.getElementById('komposisi_dsp_terisi');
                const k = document.getElementById('komposisi_dsp_kosong');
                const calc = () => {
                    const total = parseInt(j.value || 0, 10);
                    const terisi = parseInt(t.value || 0, 10);
                    k.value = Math.max(0, total - terisi);
                };
                j.removeEventListener?.('__calc', j.__calc);
                t.removeEventListener?.('__calc', t.__calc);
                j.__calc = calc;
                t.__calc = calc;
                j.addEventListener('input', calc);
                t.addEventListener('input', calc);
                calc();
            }

            function openKomposisiModal(row = null) {
                const modal = document.getElementById('komposisiModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                const form = document.getElementById('komposisiForm');
                const methodInput = document.getElementById('komposisiFormMethod');
                const title = document.getElementById('komposisiModalTitle');

                if (row && row.id) {
                    form.action = `{{ url('super-admin/komposisi') }}/${row.id}`;
                    methodInput.value = 'PUT';
                    title.textContent = 'Edit Komposisi';

                    document.getElementById('komposisi_bidang').value = row.bidang || '';
                    document.getElementById('komposisi_jumlah_personil').value = row.jumlah_personil ?? 0;
                    document.getElementById('komposisi_dsp_jumlah').value = row.dsp_jumlah ?? 0;
                    document.getElementById('komposisi_dsp_terisi').value = row.dsp_terisi ?? 0;
                    document.getElementById('komposisi_dsp_kosong').value = row.dsp_kosong ?? 0;
                    document.getElementById('komposisi_keterangan').value = row.keterangan || '';
                } else {
                    form.action = `{{ route('super-admin.komposisi.store') }}`;
                    methodInput.value = 'POST';
                    title.textContent = 'Tambah Komposisi';
                    form.reset();
                }

                autoCalcKosong();
            }


            function closeKomposisiModal() {
                const modal = document.getElementById('komposisiModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden'); // lepas kunci scroll
            }

            function confirmDeleteKomposisi(event) {
                event.preventDefault(); // Mencegah form untuk langsung submit

                // SweetAlert2 Confirmation Popup
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika konfirmasi diterima, kirimkan form
                        event.target.submit();
                    }
                });
            }

            function openPegawaiModal() {
                const el = document.getElementById('pegawaiModal');
                el.classList.remove('hidden');
                el.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            }

            function closePegawaiModal() {
                const el = document.getElementById('pegawaiModal');
                el.classList.add('hidden');
                el.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            // ADD/REMOVE FIELD NAMA[]
            function addNamaField() {
                const wrap = document.getElementById('namaWrapper');
                const row = document.createElement('div');
                row.className = 'flex gap-2';
                row.innerHTML = `
      <input type="text" name="nama[]" class="w-full border rounded px-3 py-2" placeholder="Nama Pegawai" required>
      <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-500 text-white rounded">-</button>
    `;
                wrap.appendChild(row);
            }

            // FILL EDIT FORM
            function fillEditForm(data) {
                const form = document.getElementById('pegawaiEditForm');
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_nama').value = data.nama || '';
                // set value; kalau tidak ada di list, sisipkan extra option
                const sel = document.getElementById('edit_jabatan');
                const has = [...sel.options].some(o => o.value === data.jabatan);
                if (!has && data.jabatan) {
                    const extra = document.getElementById('edit_jabatan_extra');
                    extra.value = data.jabatan;
                    extra.textContent = data.jabatan;
                    extra.classList.remove('hidden');
                }
                sel.value = data.jabatan || '';

                // action PUT ke /super-admin/pegawai/{id}
                form.action = `{{ url('super-admin/pegawai') }}/${data.id}`;
            }

            // CLEAR EDIT FORM
            function clearEditForm() {
                const form = document.getElementById('pegawaiEditForm');
                form.reset();
                form.action = '#';
                document.getElementById('edit_id').value = '';
            }
        </script>
        <script>
            function closeAddPhotoModal() {
                const modal = document.getElementById('addPhotoModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            // Timer for Gallery
            let gallery = @json($galeri); // Get gallery images from the backend
            let activeIndex = 0; // Index of the active image
            let countdown = 10; // Timer duration in seconds
            const timerDisplay = document.getElementById('timer');
            const galleryImage = document.getElementById('galleryImage');
            const imageDescription = document.getElementById('imageDescription');

            // Function to change the image
            function changeImage() {
                activeIndex = (activeIndex + 1) % gallery.length; // Cycle through images
                galleryImage.src = "{{ asset('storage/') }}/" + gallery[activeIndex].image_path;
                imageDescription.textContent = gallery[activeIndex].description ?? 'No Description';
            }

            // Timer countdown
            let interval = setInterval(function() {
                if (countdown <= 0) {
                    changeImage(); // Change image when countdown is over
                    countdown = 10; // Reset countdown for next image
                }
                timerDisplay.textContent = countdown;
                countdown--;
            }, 1000);

            // Next image on right button click
            document.getElementById('nextBtn').addEventListener('click', function() {
                clearInterval(interval); // Stop the timer
                changeImage(); // Change image
                countdown = 10; // Reset timer
                interval = setInterval(function() { // Restart the timer
                    if (countdown <= 0) {
                        changeImage();
                        countdown = 10;
                    }
                    timerDisplay.textContent = countdown;
                    countdown--;
                }, 1000);
            });

            // Previous image on left button click
            document.getElementById('prevBtn').addEventListener('click', function() {
                clearInterval(interval); // Stop the timer
                activeIndex = (activeIndex - 1 + gallery.length) % gallery.length; // Go to previous image
                galleryImage.src = "{{ asset('storage/') }}/" + gallery[activeIndex].image_path;
                imageDescription.textContent = gallery[activeIndex].description ?? 'No Description';
                countdown = 10; // Reset timer
                interval = setInterval(function() { // Restart the timer
                    if (countdown <= 0) {
                        changeImage();
                        countdown = 10;
                    }
                    timerDisplay.textContent = countdown;
                    countdown--;
                }, 1000);
            });

            // Image CRUD Operations
            const editButtons = document.querySelectorAll('.bg-blue-600');
            const deleteButtons = document.querySelectorAll('.bg-red-600');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Open a modal for editing the image (CRUD functionality)
                    alert('Editing image!');
                });
            });

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Handle image deletion
                    alert('Image deleted!');
                });
            });

            // Open "Add Photo" Modal
            const addPhotoBtn = document.getElementById('addPhotoBtn');
            addPhotoBtn.addEventListener('click', function() {
                // Open a modal to add a new photo
                const modal = document.getElementById('addPhotoModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
                // Implement logic for uploading images here
                // Implement logic for uploading images here
            });
        </script>
    @endpush
@endsection
