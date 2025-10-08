@extends('layouts.superadmin-master')

@section('content')
    <div class="mx-auto px-2 py-3">
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

            <!-- Statistik Demografi -->
            {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Statistik Jenis Kelamin -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Laki-laki</div>
                                <div class="text-2xl font-bold text-gray-900">
                                    {{ number_format($jenisKelaminStats['Laki-laki']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Perempuan</div>
                                <div class="text-2xl font-bold text-gray-900">
                                    {{ number_format($jenisKelaminStats['Perempuan']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistik Umur -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Anak-anak (1-17)</div>
                                <div class="text-2xl font-bold text-gray-900">
                                    {{ number_format($umurStats['Anak-anak (1-17 tahun)']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Dewasa (18+)</div>
                                <div class="text-2xl font-bold text-gray-900">
                                    {{ number_format($umurStats['Dewasa (18+ tahun)']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

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

                <!-- Jenis Kelamin & Umur Pie Charts -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h3 class="text-md font-semibold text-gray-900 mb-2">Jenis Kelamin</h3>
                                <canvas id="chartJenisKelaminPie" width="180" height="180"></canvas>
                            </div>
                            <div>
                                <h3 class="text-md font-semibold text-gray-900 mb-2">Kategori Umur</h3>
                                <canvas id="chartUmurPie" width="180" height="180"></canvas>
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

                <!-- Statistik Cards Anggaran -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Anggaran Sebelum -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-500">Total Anggaran Sebelum</div>
                                    <div class="text-xl font-bold text-gray-900">Rp
                                        {{ number_format($anggaranStats['Total Anggaran Sebelum'], 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Blokir -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-500">Total Blokir</div>
                                    <div class="text-xl font-bold text-gray-900">Rp
                                        {{ number_format($anggaranStats['Total Blokir'], 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Anggaran Setelah -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-500">Total Anggaran Setelah</div>
                                    <div class="text-xl font-bold text-gray-900">Rp
                                        {{ number_format($anggaranStats['Total Anggaran Setelah'], 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Kegiatan -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-500">Jumlah Kegiatan</div>
                                    <div class="text-xl font-bold text-gray-900">
                                        {{ number_format($anggaranStats['Jumlah Kegiatan']) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                    @if ($anggaran->is_main_activity)
                                        {{-- Main Activity Row --}}
                                        <tr class="hover:bg-gray-50 bg-blue-50">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900 border-l-4 border-yellow-400">
                                                {{ $anggaran->akun }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                <strong>{{ $anggaran->kegiatan }}</strong>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-blue-100">
                                                Rp {{ number_format($anggaran->total_anggaran_sebelum, 0, ',', '.') }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-red-100">
                                                Rp
                                                {{ $anggaran->total_blokir ? number_format($anggaran->total_blokir, 0, ',', '.') : '-' }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-yellow-100">
                                                Rp {{ number_format($anggaran->total_anggaran_setelah, 0, ',', '.') }}
                                            </td>
                                            <td class="px-2 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                <div class="flex items-center justify-center space-x-2">
                                                    {{-- Tombol Edit --}}
                                                    <a href="#" onclick="tambahAnggaranModal(this.dataset)"
                                                        data-id="{{ $anggaran->id }}"
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
                                                        action="{{ route('super-admin.anggaran.destroy', $anggaran->id) }}"
                                                        method="POST" onsubmit="return confirmDeleteAnggaran(event)"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-2 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-red-600 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:-translate-y-1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4v4m-6 4h8" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Sub Activities --}}
                                        @foreach ($anggaran->children as $subAnggaran)
                                            <tr class="hover:bg-gray-50 bg-red-50">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700 pl-12">
                                                    {{ $subAnggaran->akun }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-700 pl-12">
                                                    {{ $subAnggaran->kegiatan }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-700 bg-blue-100">
                                                    Rp {{ number_format($subAnggaran->anggaran_sebelum, 0, ',', '.') }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-700 bg-red-100">
                                                    Rp
                                                    {{ $subAnggaran->blokir ? number_format($subAnggaran->blokir, 0, ',', '.') : '-' }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-700 bg-yellow-100">
                                                    Rp
                                                    {{ number_format($subAnggaran->anggaran_sebelum - ($subAnggaran->blokir ?? 0), 0, ',', '.') }}
                                                </td>
                                                <td class="px-2 py-4 whitespace-nowrap text-center text-sm text-gray-700">
                                                    <div class="flex items-center justify-center space-x-2">
                                                        {{-- Tombol Edit --}}
                                                        <a href="#" onclick="tambahAnggaranModal(this.dataset)"
                                                            data-id="{{ $subAnggaran->id }}"
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
                                                            action="{{ route('super-admin.anggaran.destroy', $subAnggaran->id) }}"
                                                            method="POST" onsubmit="return confirmDeleteAnggaran(event)"
                                                            class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center px-2 py-2 bg-gradient-to-r from-red-500 to-red-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-red-600 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 transform hover:-translate-y-1">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4v4m-6 4h8" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- Removed all extra table elements that were outside the table structure -->
                    </div>
                </div>

                <!-- Pie Chart Anggaran -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Anggaran</h3>
                        <canvas id="chartAnggaranPie" width="400" height="200"></canvas>
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
                        <div class="flex items-center justify-between mb-1">
                            <h5 class="text-2xl font-bold text-black tracking-tight">Tugas Pokok Bidang Pemberantasan dan
                                Intelijen</h5>
                            <button type="button" onclick="openTugasModal()"
                                class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                Edit Tugas Pokok
                            </button>
                        </div>
                        <div class="pl-5 pr-4">
                            <div class="text-gray-700 leading-relaxed text-lg bg-white bg-opacity-50 p-4 ml-5 font-sans"
                                id="tugasContent">
                                @if (isset($tugas) && $tugas->count() > 0)
                                    @foreach ($tugas as $t)
                                        <p>
                                            <span class="font-bold">{{ $t->pasal }}</span>:<br>
                                            <span class="italic"><span class="font-bold">"</span>{{ $t->isi }}<span
                                                    class="font-bold">"</span></span>
                                        </p>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 italic">Belum ada data tugas pokok. Klik tombol "Edit Tugas
                                        Pokok" untuk menambahkan data.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Fungsi -->
                    <div
                        class="bg-gradient-to-br from-white to-green-50 rounded-base shadow-lg p-8 border-t border-l border-green-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <div class="items-center">
                                <h5 class="text-2xl font-bold text-black tracking-tight whitespace-nowrap">Fungsi Bidang
                                    Pemberantasan</h5>
                                <p class="font-bold">Sesuai Pasal 10, Peraturan Kepala BNN Nomor 6 Tahun 2020:</p>
                                <p class="italic">Dalam melaksanakan tugas sebagaimana dimaksud dalam Pasal 9, Bidang
                                    Pemberantasan dan Intelijen menyelenggarakan fungsi: </p>
                            </div>
                            <button type="button" onclick="openFungsiModal()"
                                class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-green-600 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 transform hover:-translate-y-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                Edit Fungsi
                            </button>
                        </div>
                        <div class="pl-1 pr-4">
                            <div class="bg-white bg-opacity-50 p-4 rounded-xl shadow-sm">
                                <ul class="space-y-4 list-none" id="fungsiContent">
                                    @if (isset($fungsi) && $fungsi->count() > 0)
                                        @foreach ($fungsi as $index => $f)
                                            <li
                                                class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                                <div class="flex-shrink-0 mt-1">
                                                    <span
                                                        class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-200 shadow-sm">
                                                        <span
                                                            class="text-white text-xs font-bold">{{ $index + 1 }}</span>
                                                    </span>
                                                </div>
                                                <p
                                                    class="ml-4 text-gray-700 group-hover:text-gray-900 transition-colors duration-200">
                                                    {{ $f->isi }}</p>
                                            </li>
                                        @endforeach
                                    @else
                                        <li
                                            class="flex items-start group hover:bg-blue-50 p-3 transition-colors duration-200">
                                            <div class="flex-shrink-0 mt-1">
                                                <span
                                                    class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gradient-to-r from-gray-400 to-gray-500 group-hover:from-gray-500 group-hover:to-gray-600 transition-all duration-200 shadow-sm">
                                                    <span class="text-white text-xs font-bold">?</span>
                                                </span>
                                            </div>
                                            <p class="ml-4 text-gray-500 italic">Belum ada data fungsi. Klik tombol "Edit
                                                Fungsi" untuk menambahkan data.</p>
                                        </li>
                                    @endif
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
                            class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-xl border border-blue-100 overflow-hidden relative mb-12 mt-8 p-8">
                            <div id="orgChart" class="org-chart-container">
                                <!-- Background decorative elements -->
                                <div
                                    class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full opacity-30 -mr-32 -mt-32 z-0">
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-red-100 to-red-50 rounded-full opacity-30 -ml-32 -mb-32 z-0">
                                </div>

                                <div class="org-chart relative space-y-8">

                                    <!-- Level 1: Kepala BNNP Jatim -->
                                    <div class="relative flex flex-col items-center">
                                        <div
                                            class="flex items-center bg-gradient-to-r from-red-600 to-red-700 text-white shadow-xl p-6 rounded-xl border-2 border-red-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[400px]">
                                            <div
                                                class="w-20 h-20 bg-white mr-5 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                @php $ketua = $pegawai->where('jabatan','Ketua')->first(); @endphp
                                                <div class="text-white font-bold text-xl">Kepala BNNP Jatim</div>
                                                <div class="text-white text-lg">{{ $ketua->nama ?? '-' }}</div>
                                            </div>
                                        </div>

                                        <!-- Vertical connector -->
                                        <div class="h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>

                                        <!-- Horizontal connector -->
                                        <div class="w-full h-1 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300">
                                        </div>

                                        <!-- Vertical connectors for subordinates -->
                                        <div class="flex w-full justify-between px-8">
                                            <div class="h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>
                                            <div class="h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>
                                        </div>
                                    </div>

                                    <!-- Level 2: Kabid Pemberantasan dan Kabag Umum -->
                                    <div
                                        class="relative flex flex-col lg:flex-row justify-between items-start lg:space-x-16 space-y-8 lg:space-y-0">

                                        <!-- Kabid Pemberantasan dan Intelijen -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-xl p-5 rounded-xl border-2 border-blue-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[350px]">
                                                <div
                                                    class="w-16 h-16 bg-white mr-4 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-10 h-10 text-blue-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    @php $kabidPemberantasan = $pegawai->where('jabatan','Kabid Pemberantasan')->first(); @endphp
                                                    <div class="text-white font-bold text-lg">Kabid Pemberantasan dan
                                                        Intelijen</div>
                                                    <div class="text-white text-base">
                                                        {{ $kabidPemberantasan->nama ?? '-' }}</div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to Kasi -->
                                            <div class="h-16 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-4"></div>

                                            <!-- Horizontal connector to Kasi -->
                                            <div
                                                class="w-full h-1 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300">
                                            </div>

                                            <!-- Vertical connectors for Kasi -->
                                            <div class="flex w-full justify-between px-12">
                                                <div class="h-16 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>
                                                <div class="h-16 w-1 bg-gradient-to-b from-gray-400 to-gray-300"></div>
                                            </div>
                                        </div>

                                        <!-- Kabag Umum -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-green-600 to-green-700 text-white shadow-xl p-5 rounded-xl border-2 border-green-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[350px]">
                                                <div
                                                    class="w-16 h-16 bg-white mr-4 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-10 h-10 text-green-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    @php $kabagUmum = $pegawai->where('jabatan','Kabag Umum')->first(); @endphp
                                                    <div class="text-white font-bold text-lg">Kabag Umum</div>
                                                    <div class="text-white text-base">{{ $kabagUmum->nama ?? '-' }}</div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to Koordinator -->
                                            <div class="h-16 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-4"></div>
                                        </div>
                                    </div>

                                    <!-- Level 3: Kasi Intelijen, Kasi Wastahti, dan Koordinator -->
                                    <div
                                        class="relative flex flex-col lg:flex-row justify-between items-start lg:space-x-8 space-y-8 lg:space-y-0">

                                        <!-- Kasi Intelijen -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-purple-600 to-purple-700 text-white shadow-xl p-4 rounded-xl border-2 border-purple-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[280px]">
                                                <div
                                                    class="w-14 h-14 bg-white mr-3 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-8 h-8 text-purple-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    @php $kasiIntelijen = $pegawai->where('jabatan','Kasi Intelijen')->first(); @endphp
                                                    <div class="text-white font-bold text-base">Kasi Intelijen</div>
                                                    <div class="text-white text-sm">{{ $kasiIntelijen->nama ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to staff -->
                                            <div class="h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-3"></div>
                                        </div>

                                        <!-- Kasi Wastahti -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-orange-600 to-orange-700 text-white shadow-xl p-4 rounded-xl border-2 border-orange-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[280px]">
                                                <div
                                                    class="w-14 h-14 bg-white mr-3 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-8 h-8 text-orange-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    @php $kasiWastahti = $pegawai->where('jabatan','Kasi Wastahti')->first(); @endphp
                                                    <div class="text-white font-bold text-base">Kasi Wastahti</div>
                                                    <div class="text-white text-sm">{{ $kasiWastahti->nama ?? '-' }}</div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to staff -->
                                            <div class="h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-3"></div>
                                        </div>

                                        <!-- Koordinator dan Kelompok Jabatan Fungsional -->
                                        <div class="flex flex-col items-center flex-1">
                                            <div
                                                class="flex items-center bg-gradient-to-r from-gray-600 to-gray-700 text-white shadow-xl p-4 rounded-xl border-2 border-gray-800 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 min-w-[280px]">
                                                <div
                                                    class="w-14 h-14 bg-white mr-3 overflow-hidden border-2 border-white shadow-inner flex items-center justify-center rounded-full">
                                                    <svg class="w-8 h-8 text-gray-600" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div class="text-left">
                                                    <div class="text-white font-bold text-base">Koordinator dan Kelompok
                                                        Jabatan Fungsional</div>
                                                </div>
                                            </div>

                                            <!-- Vertical connector to staff -->
                                            <div class="h-12 w-1 bg-gradient-to-b from-gray-400 to-gray-300 mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Staff Level -->
                            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">

                                <!-- Staff di bawah Kasi Intelijen -->
                                <div class="space-y-4">
                                    <h5 class="text-lg font-bold text-gray-800 text-center mb-4">Staff Sie Intelijen</h5>

                                    <!-- Analisis Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-base mb-2">Analisis Intelijen</div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan', 'Analisis Intelijen') as $analisisIntelijen)
                                                        <li>{{ $analisisIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Penyidik Sie Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-base mb-2">Penyidik Sie Intelijen
                                            </div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Penyidik Sie Intelijen') as $penyidikSieIntelijen)
                                                        <li>{{ $penyidikSieIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Petugas Pengejaran Sie Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-base mb-2">Petugas Pengejaran Sie
                                                Intelijen</div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Petugas Pengejaran') as $petugasPengejaranSieIntelijen)
                                                        <li>{{ $petugasPengejaranSieIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Petugas Penindakan Sie Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-base mb-2">Petugas Penindakan Sie
                                                Intelijen</div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Petugas Penindakan Sie Intelijen') as $petugasPenindakanSieIntelijen)
                                                        <li>{{ $petugasPenindakanSieIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pengolah Data Sie Intelijen -->
                                    <div
                                        class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg shadow-md p-4 border border-purple-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-purple-800 font-bold text-base mb-2">Pengolah Data Sie
                                                Intelijen
                                            </div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Pengolah Data Sie Intelijen') as $pengolahDataSieIntelijen)
                                                        <li>{{ $pengolahDataSieIntelijen->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Staff di bawah Kasi Wastahti -->
                                <div class="space-y-4">
                                    <h5 class="text-lg font-bold text-gray-800 text-center mb-4">Staff Sie Wastahti</h5>

                                    <!-- Penjaga Tahanan -->
                                    <div
                                        class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-4 border border-orange-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-orange-800 font-bold text-base mb-2">Penjaga Tahanan</div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Penjaga Tahanan') as $penjagaTahanan)
                                                        <li>{{ $penjagaTahanan->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pengadministrasian Umum -->
                                    <div
                                        class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-md p-4 border border-orange-200 hover:shadow-lg transition-all duration-300">
                                        <div class="text-left">
                                            <div class="text-orange-800 font-bold text-base mb-2">Pengadministrasian Umum
                                            </div>
                                            <div class="text-gray-700">
                                                <ul class="list-disc list-inside space-y-1">
                                                    @forelse ($pegawai->where('jabatan','Pengadministrasian Umum') as $pengadministrasianUmum)
                                                        <li>{{ $pengadministrasianUmum->nama }}</li>
                                                    @empty
                                                        <li class="text-gray-500 italic">Belum ada data</li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                                                <td
                                                    class="px-2 py-3 text-sm text-gray-900 bg-green-100 text-center border-r">
                                                    {{ $komposisi->jumlah_personil }}</td>
                                                <td
                                                    class="px-2 py-3 text-sm text-gray-900 bg-blue-100 text-center border-r">
                                                    {{ $komposisi->dsp_jumlah }}</td>
                                                <td
                                                    class="px-2 py-3 text-sm text-gray-900 bg-red-100 text-center border-r">
                                                    {{ $komposisi->dsp_kosong }}</td>
                                                <td
                                                    class="px-2 py-3 text-sm text-gray-900 bg-yellow-100 text-center border-r">
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
                        <div class="flex justify-center items-center">
                            @if (isset($galeri) && count($galeri) > 0)
                                <div class="relative w-full max-w-6xl">
                                    <!-- Carousel Container -->
                                    <div class="relative overflow-hidden rounded-2xl">
                                        <!-- Main Gallery Display -->
                                        <div class="flex items-center justify-center space-x-4 py-8">

                                            <!-- Previous Image (Left) -->
                                            <div class="flex-shrink-0 transform scale-75 opacity-50 blur-sm transition-all duration-500"
                                                id="prevImageContainer">
                                                <div class="w-64 h-64 bg-gray-200 rounded-xl overflow-hidden shadow-lg">
                                                    <img id="prevImage" src="" alt="Previous"
                                                        class="w-full h-full object-cover">
                                                </div>
                                            </div>

                                            <!-- Current Image (Center) -->
                                            <div class="flex-shrink-0 transform scale-100 opacity-100 transition-all duration-500"
                                                id="currentImageContainer">
                                                <div
                                                    class="relative w-96 h-96 bg-gray-200 rounded-xl overflow-hidden shadow-2xl">
                                                    <img id="galleryImage"
                                                        src="{{ asset('storage/' . $galeri[0]->image_path) }}"
                                                        alt="Current"
                                                        class="w-full h-full object-cover transition-all duration-700 ease-in-out">
                                                    <div id="imageDescription"
                                                        class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black via-black/70 to-transparent text-white p-4 text-sm">
                                                        <div class="font-semibold">
                                                            {{ $galeri[0]->description ?? 'No Description' }}</div>
                                                    </div>

                                                    <!-- Delete Button -->
                                                    <button id="deleteCurrentBtn"
                                                        class="absolute top-4 right-4 bg-red-500/80 backdrop-blur-sm text-white p-2 rounded-full hover:bg-red-600/90 transition-all duration-300 shadow-lg hover:scale-110"
                                                        onclick="deleteCurrentImage()" title="Hapus Foto">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>

                                                    <!-- Navigation Buttons -->
                                                    <button id="prevBtn"
                                                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition-all duration-300 shadow-lg">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                        </svg>
                                                    </button>
                                                    <button id="nextBtn"
                                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/30 transition-all duration-300 shadow-lg">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Next Image (Right) -->
                                            <div class="flex-shrink-0 transform scale-75 opacity-50 blur-sm transition-all duration-500"
                                                id="nextImageContainer">
                                                <div class="w-64 h-64 bg-gray-200 rounded-xl overflow-hidden shadow-lg">
                                                    <img id="nextImage" src="" alt="Next"
                                                        class="w-full h-full object-cover">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Dots Indicator -->
                                        <div class="flex justify-center space-x-2 mt-4" id="dotsContainer">
                                            @foreach ($galeri as $index => $image)
                                                <button
                                                    class="dot w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-blue-600 scale-125' : 'bg-gray-300 hover:bg-gray-400' }}"
                                                    data-index="{{ $index }}"></button>
                                            @endforeach
                                        </div>

                                        <!-- Timer Display -->
                                        <div class="text-center mt-4">
                                            <div
                                                class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-lg">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span id="timer" class="text-lg font-bold text-blue-600">10</span>
                                                <span class="text-sm text-gray-600">detik</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 text-lg">Belum ada foto galeri</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Berita Eksternal Section -->
                <div class="mt-12" id="beritaSection">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Berita Terkini</h2>
                            <p class="text-gray-600">Kumpulan berita dari berbagai sumber eksternal</p>
                        </div>
                        <button id="addNewsBtn"
                            class="bg-gradient-to-r from-green-500 to-green-700 text-white px-4 py-2 rounded-lg hover:from-green-600 hover:to-green-800 transition-all duration-200 transform hover:-translate-y-0.5 shadow-sm">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Berita
                        </button>
                    </div>

                    @if (isset($berita) && count($berita) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($berita->take(4) as $index => $news)
                                <div
                                    class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <!-- News Image -->
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ $news->image_url }}" alt="{{ $news->title }}"
                                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                            onerror="this.src='{{ asset('images/default-news.jpg') }}'">

                                        <!-- Delete Button -->
                                        <div class="absolute top-3 right-3">
                                            <button onclick="deleteNews({{ $news->id }})"
                                                class="bg-red-500/80 backdrop-blur-sm text-white p-2 rounded-full hover:bg-red-600/90 transition-all duration-300 shadow-lg hover:scale-110"
                                                title="Hapus Berita">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- News Content -->
                                    <div class="p-4">
                                        <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2">
                                            {{ $news->title }}</h3>
                                        <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                                            {{ $news->description }}</p>

                                        <!-- News Meta -->
                                        <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                            <span>{{ \Carbon\Carbon::parse($news->published_at)->format('d M Y') }}</span>
                                            <a href="{{ $news->url }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                                Baca Selengkapnya
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                    </path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada berita</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan berita pertama Anda.</p>
                        </div>
                    @endif
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

        /* Line clamp utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
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
    <div id="allKabupatenModal" class="dashboard-content hidden">
        <div class="space-y-6">
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
            class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto mt-10 transform transition-all duration-300 ease-in-out">

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

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Tipe Anggaran -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">TIPE ANGGARAN</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="tipe_anggaran" value="main" id="tipe_main" checked
                                class="mr-3 text-blue-600 focus:ring-blue-500" onchange="toggleParentSelection()">
                            <span class="text-sm font-medium text-gray-700">Kegiatan Utama (Main Activity)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="tipe_anggaran" value="sub" id="tipe_sub"
                                class="mr-3 text-blue-600 focus:ring-blue-500" onchange="toggleParentSelection()">
                            <span class="text-sm font-medium text-gray-700">Sub Kegiatan (Sub Activity)</span>
                        </label>
                    </div>
                </div>

                <!-- Parent Activity Selection (Hidden by default) -->
                <div id="parent_selection" class="hidden">
                    <label for="parent_id" class="block text-sm font-medium text-gray-700">KEGIATAN UTAMA</label>
                    <select id="parent_id" name="parent_id"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Pilih Kegiatan Utama</option>
                        @foreach ($anggaranList as $mainActivity)
                            <option value="{{ $mainActivity->id }}">{{ $mainActivity->akun }} -
                                {{ $mainActivity->kegiatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="akun" class="block text-sm font-medium text-gray-700">AKUN</label>
                    <input type="text" id="akun" name="akun"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm uppercase"
                        placeholder="Contoh: 3251 atau 3251.BKA.002.051.A">
                </div>

                <div>
                    <label for="kegiatan" class="block text-sm font-medium text-gray-700">KEGIATAN</label>
                    <textarea id="kegiatan" name="kegiatan" rows="3"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Masukkan deskripsi kegiatan"></textarea>
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
                <button type="button" class="text-gray-500 hover:text-gray-700"
                    onclick="closePegawaiModal()">✕</button>
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
                            <input type="text" id="edit_nama" name="nama"
                                class="w-full border rounded px-3 py-2" placeholder="Nama Pegawai">
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
                            <select name="filter_jabatan" class="border rounded px-2 py-1"
                                onchange="this.form.submit()">
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
                                                    data-nama="{{ $p->nama }}"
                                                    data-jabatan="{{ $p->jabatan }}">
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

    <!-- Modal Edit Anggaran -->
    <div id="anggaranModal" class="fixed inset-0 hidden items-center justify-center p-4 bg-black bg-opacity-50"
        style="z-index: 9999;">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900" id="anggaranModalTitle">Edit Anggaran</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700"
                    onclick="closeAnggaranModal()">✕</button>
            </div>

            <form id="anggaranForm" method="POST" action="{{ route('super-admin.anggaran.store') }}"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="anggaranFormMethod" value="POST" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Akun</label>
                        <input name="akun" id="anggaran_akun" type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Kegiatan</label>
                        <input name="kegiatan" id="anggaran_kegiatan" type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Anggaran Sebelum Blokir</label>
                        <input name="anggaran_sebelum" id="anggaran_sebelum" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase"
                            required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Blokir</label>
                        <input name="blokir" id="anggaran_blokir" type="number" min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 uppercase">Anggaran Setelah Blokir</label>
                        <input name="anggaran_setelah" id="anggaran_setelah" type="number" min="0" readonly
                            class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeAnggaranModal()"
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
                <form action="{{ route('super-admin.gallery.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Pilih Foto
                        </label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-200 hover:border-gray-400"
                            required>
                        <p class="mt-1 text-xs text-gray-500">Format yang didukung: JPG, PNG, GIF. Maksimal 5MB</p>
                    </div>

                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Deskripsi Foto
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-200 hover:border-gray-400 resize-none"
                            placeholder="Masukkan deskripsi foto (opsional)..."></textarea>
                        <p class="mt-1 text-xs text-gray-500">Deskripsi akan ditampilkan di bawah foto dalam galeri</p>
                    </div>

                    <!-- Preview Section -->
                    <div class="mt-4" id="imagePreview" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview Foto</label>
                        <div class="relative">
                            <img id="previewImage" src="" alt="Preview"
                                class="w-full h-48 object-cover rounded-lg border border-gray-300">
                            <div class="absolute top-2 right-2">
                                <button type="button" onclick="removePreview()"
                                    class="bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button"
                            class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors duration-200"
                            onclick="closeAddPhotoModal()">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </button>
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md hover:from-blue-600 hover:to-blue-800 transition-all duration-200 transform hover:-translate-y-0.5 shadow-sm">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Berita -->
    <div id="addNewsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Berita Eksternal</h3>

                <!-- News URL Form -->
                <form id="newsForm">
                    @csrf
                    <div class="mb-4">
                        <label for="newsUrl" class="block text-sm font-medium text-gray-700 mb-2">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                </path>
                            </svg>
                            URL Berita
                        </label>
                        <input type="url" id="newsUrl" name="url"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-colors duration-200 hover:border-gray-400"
                            placeholder="https://example.com/berita" required>
                        <p class="mt-1 text-xs text-gray-500">Masukkan URL lengkap berita yang ingin ditambahkan</p>
                    </div>

                    <!-- Preview Section -->
                    <div id="newsPreview" class="mb-4 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview Berita</label>
                        <div class="border border-gray-300 rounded-lg p-3 bg-gray-50">
                            <div class="flex space-x-3">
                                <img id="previewImage" src="" alt="Preview"
                                    class="w-16 h-16 object-cover rounded">
                                <div class="flex-1">
                                    <h4 id="previewTitle" class="font-semibold text-sm text-gray-900 line-clamp-2"></h4>
                                    <p id="previewDescription" class="text-xs text-gray-600 line-clamp-2 mt-1"></p>
                                    <p id="previewSource" class="text-xs text-gray-500 mt-1"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button"
                            class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md hover:bg-gray-300 transition-colors duration-200"
                            onclick="closeAddNewsModal()">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </button>
                        <button type="submit" id="submitNewsBtn"
                            class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-700 text-white text-sm font-medium rounded-md hover:from-green-600 hover:to-green-800 transition-all duration-200 transform hover:-translate-y-0.5 shadow-sm">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tugas Pokok -->
    <div id="tugasModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900" id="tugasModalTitle">Edit Tugas Pokok</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700"
                    onclick="closeTugasModal()">✕</button>
            </div>

            <form id="tugasForm" method="POST" action="{{ route('super-admin.tupoksi.tugas.store') }}"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="tugasFormMethod" value="POST" />

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pasal</label>
                    <input name="pasal" id="tugas_pasal" type="text"
                        class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Contoh: Pasal 9 Peraturan Kepala BNN Nomor 6 Tahun 2020" required />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Isi Tugas Pokok</label>
                    <textarea name="isi" id="tugas_isi" rows="6"
                        class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan isi tugas pokok..." required></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeTugasModal()"
                        class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
                </div>
            </form>

            <!-- Daftar Tugas Pokok -->
            <div class="px-6 pb-6">
                <h4 class="text-md font-semibold text-gray-900 mb-3">Daftar Tugas Pokok</h4>
                <div class="space-y-3" id="tugasList">
                    <!-- Data akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Fungsi -->
    <div id="fungsiModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900" id="fungsiModalTitle">Edit Fungsi</h3>
                <button type="button" class="text-gray-500 hover:text-gray-700"
                    onclick="closeFungsiModal()">✕</button>
            </div>

            <form id="fungsiForm" method="POST" action="{{ route('super-admin.tupoksi.fungsi.store') }}"
                class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="_method" id="fungsiFormMethod" value="POST" />

                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-md font-semibold text-gray-900">Daftar Fungsi</h4>
                    <button type="button" onclick="addFungsiField()"
                        class="px-3 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                        <i class="fas fa-plus mr-1"></i>Tambah Fungsi
                    </button>
                </div>

                <div id="fungsiFieldsContainer" class="space-y-3">
                    <!-- Dynamic fields will be added here -->
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeFungsiModal()"
                        class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700">Simpan Semua</button>
                </div>
            </form>

            <!-- Daftar Fungsi -->
            <div class="px-6 pb-6">
                <h4 class="text-md font-semibold text-gray-900 mb-3">Daftar Fungsi</h4>
                <div class="space-y-3" id="fungsiList">
                    <!-- Data akan diisi oleh JavaScript -->
                </div>
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
            const jenisKelaminStats = @json($jenisKelaminStats);
            const umurStats = @json($umurStats);
            const anggaranStats = @json($anggaranStats);
            const anggaranPie = @json($anggaranPie);
            const kegiatanPie = @json($kegiatanPie);
            const kasusPerKabupatenNik = @json($kasusPerKabupatenNik);
            const kasusPerKecamatanNik = @json($kasusPerKecamatanNik);

            // Gallery data
            const gallery = @json($galeri ?? []);

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

            // Pie Chart Jenis Kelamin
            const ctxJenisKelaminPie = document.getElementById('chartJenisKelaminPie').getContext('2d');
            new Chart(ctxJenisKelaminPie, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(jenisKelaminStats),
                    datasets: [{
                        data: Object.values(jenisKelaminStats),
                        backgroundColor: [
                            'rgba(147, 51, 234, 0.8)', // Laki-laki - Purple
                            'rgba(236, 72, 153, 0.8)' // Perempuan - Pink
                        ],
                        borderColor: [
                            'rgba(147, 51, 234, 1)',
                            'rgba(236, 72, 153, 1)'
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

            // Pie Chart Kategori Umur
            const ctxUmurPie = document.getElementById('chartUmurPie').getContext('2d');
            new Chart(ctxUmurPie, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(umurStats),
                    datasets: [{
                        data: Object.values(umurStats),
                        backgroundColor: [
                            'rgba(249, 115, 22, 0.8)', // Anak-anak - Orange
                            'rgba(99, 102, 241, 0.8)' // Dewasa - Indigo
                        ],
                        borderColor: [
                            'rgba(249, 115, 22, 1)',
                            'rgba(99, 102, 241, 1)'
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
                allKabupatenModal.classList.add('hidden');
                //document.body.classList.add('overflow-hidden');
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

            // Gallery Auto-Rotation JavaScript
            let activeIndex = 0;
            let autoRotateInterval;
            let countdownInterval;
            let currentCountdown = 10;

            // Initialize gallery when DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                if (gallery.length > 0) {
                    initializeGallery();
                    startAutoRotation();
                }
            });

            function initializeGallery() {
                updateGallery();
                setupGalleryControls();
            }

            function updateGallery() {
                if (gallery.length === 0) return;

                const currentImage = gallery[activeIndex];
                const prevIndex = activeIndex === 0 ? gallery.length - 1 : activeIndex - 1;
                const nextIndex = activeIndex === gallery.length - 1 ? 0 : activeIndex + 1;

                // Update main image
                const galleryImage = document.getElementById('galleryImage');
                const imageDescription = document.getElementById('imageDescription');
                if (galleryImage) {
                    galleryImage.src = `{{ asset('storage/') }}/${currentImage.image_path}`;
                }
                if (imageDescription) {
                    imageDescription.innerHTML =
                        `<div class="font-semibold">${currentImage.description || 'No Description'}</div>`;
                }

                // Update previous image
                const prevImage = document.getElementById('prevImage');
                if (prevImage) {
                    prevImage.src = `{{ asset('storage/') }}/${gallery[prevIndex].image_path}`;
                }

                // Update next image
                const nextImage = document.getElementById('nextImage');
                if (nextImage) {
                    nextImage.src = `{{ asset('storage/') }}/${gallery[nextIndex].image_path}`;
                }

                // Update dots
                updateDots();
            }

            function updateDots() {
                const dots = document.querySelectorAll('.dot');
                dots.forEach((dot, index) => {
                    if (index === activeIndex) {
                        dot.classList.add('bg-blue-600', 'scale-125');
                        dot.classList.remove('bg-gray-300');
                    } else {
                        dot.classList.remove('bg-blue-600', 'scale-125');
                        dot.classList.add('bg-gray-300');
                    }
                });
            }

            function setupGalleryControls() {
                // Previous button
                const prevBtn = document.getElementById('prevBtn');
                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        activeIndex = activeIndex === 0 ? gallery.length - 1 : activeIndex - 1;
                        updateGallery();
                        resetTimer();
                    });
                }

                // Next button
                const nextBtn = document.getElementById('nextBtn');
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        activeIndex = activeIndex === gallery.length - 1 ? 0 : activeIndex + 1;
                        updateGallery();
                        resetTimer();
                    });
                }

                // Dot navigation
                const dots = document.querySelectorAll('.dot');
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        activeIndex = index;
                        updateGallery();
                        resetTimer();
                    });
                });
            }

            function startAutoRotation() {
                if (gallery.length <= 1) return;

                resetTimer();
                autoRotateInterval = setInterval(() => {
                    activeIndex = activeIndex === gallery.length - 1 ? 0 : activeIndex + 1;
                    updateGallery();
                    resetTimer();
                }, 10000); // 10 seconds
            }

            function resetTimer() {
                clearInterval(countdownInterval);
                currentCountdown = 10;
                updateTimerDisplay();

                countdownInterval = setInterval(() => {
                    currentCountdown--;
                    updateTimerDisplay();
                    if (currentCountdown <= 0) {
                        clearInterval(countdownInterval);
                    }
                }, 1000);
            }

            function updateTimerDisplay() {
                const timerElement = document.getElementById('timer');
                if (timerElement) {
                    timerElement.textContent = currentCountdown;
                }
            }

            function stopAutoRotation() {
                clearInterval(autoRotateInterval);
                clearInterval(countdownInterval);
            }

            // Pause auto-rotation on hover
            const gallerySection = document.getElementById('gallery-section');
            if (gallerySection) {
                gallerySection.addEventListener('mouseenter', stopAutoRotation);
                gallerySection.addEventListener('mouseleave', startAutoRotation);
            }

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

                    // Pie Chart Distribusi Anggaran (3D style seperti gambar)
                    const ctxAnggaranPie = document.getElementById('chartAnggaranPie');
                    if (ctxAnggaranPie) {
                        const ctx = ctxAnggaranPie.getContext('2d');

                        // Generate colors untuk setiap akun
                        const colors = [
                            'rgba(59, 130, 246, 0.8)', // Blue
                            'rgba(239, 68, 68, 0.8)', // Red
                            'rgba(34, 197, 94, 0.8)', // Green
                            'rgba(168, 85, 247, 0.8)', // Purple
                            'rgba(245, 158, 11, 0.8)', // Yellow
                            'rgba(236, 72, 153, 0.8)', // Pink
                            'rgba(14, 165, 233, 0.8)', // Sky Blue
                            'rgba(16, 185, 129, 0.8)' // Emerald
                        ];

                        const borderColors = [
                            'rgba(59, 130, 246, 1)',
                            'rgba(239, 68, 68, 1)',
                            'rgba(34, 197, 94, 1)',
                            'rgba(168, 85, 247, 1)',
                            'rgba(245, 158, 11, 1)',
                            'rgba(236, 72, 153, 1)',
                            'rgba(14, 165, 233, 1)',
                            'rgba(16, 185, 129, 1)'
                        ];

                        new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: Object.keys(anggaranPie),
                                datasets: [{
                                    data: Object.values(anggaranPie),
                                    backgroundColor: colors.slice(0, Object.keys(anggaranPie).length),
                                    borderColor: borderColors.slice(0, Object.keys(anggaranPie).length),
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const value = context.parsed;
                                                const total = context.dataset.data.reduce((a, b) => a + b,
                                                    0);
                                                const percentage = ((value / total) * 100).toFixed(1);
                                                return context.label + ': Rp ' + value.toLocaleString(
                                                    'id-ID') + ' (' + percentage + '%)';
                                            }
                                        }
                                    }
                                },
                                // Efek 3D dengan shadow
                                elements: {
                                    arc: {
                                        borderWidth: 2,
                                        borderColor: '#fff'
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

            // Function to toggle parent selection based on anggaran type
            function toggleParentSelection() {
                const tipeMain = document.getElementById('tipe_main');
                const tipeSub = document.getElementById('tipe_sub');
                const parentSelection = document.getElementById('parent_selection');
                const parentSelect = document.getElementById('parent_id');

                if (tipeSub.checked) {
                    parentSelection.classList.remove('hidden');
                    parentSelect.required = true;
                } else {
                    parentSelection.classList.add('hidden');
                    parentSelect.required = false;
                    parentSelect.value = '';
                }
            }

            // Function to handle anggaran modal (for edit)
            function tambahAnggaranModal(data) {
                const modal = document.getElementById('tambahAnggaranModal');
                const form = modal.querySelector('form');
                const title = modal.querySelector('h3');

                // Reset form
                form.reset();
                form.action = "{{ route('super-admin.anggaran.store') }}";
                title.textContent = 'Tambah Anggaran Baru';

                // Reset radio buttons
                document.getElementById('tipe_main').checked = true;
                document.getElementById('tipe_sub').checked = false;
                toggleParentSelection();

                // If editing existing anggaran
                if (data && data.id) {
                    title.textContent = 'Edit Anggaran';
                    form.action = `/super-admin/anggaran/${data.id}`;

                    // Add method override for PUT request
                    if (!form.querySelector('input[name="_method"]')) {
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PUT';
                        form.appendChild(methodInput);
                    }

                    // Fetch anggaran data and populate form
                    fetch(`/super-admin/anggaran/${data.id}`)
                        .then(response => response.json())
                        .then(anggaran => {
                            document.getElementById('akun').value = anggaran.akun || '';
                            document.getElementById('kegiatan').value = anggaran.kegiatan || '';
                            document.getElementById('anggaran_sebelum').value = anggaran.anggaran_sebelum || '';
                            document.getElementById('blokir').value = anggaran.blokir || '';

                            // Set type based on is_main_activity
                            if (anggaran.is_main_activity) {
                                document.getElementById('tipe_main').checked = true;
                                document.getElementById('tipe_sub').checked = false;
                            } else {
                                document.getElementById('tipe_sub').checked = true;
                                document.getElementById('tipe_main').checked = false;
                                document.getElementById('parent_id').value = anggaran.parent_id || '';
                            }

                            toggleParentSelection();
                        })
                        .catch(error => {
                            console.error('Error fetching anggaran data:', error);
                        });
                }

                // Show modal
                modal.classList.remove('hidden');
            }

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

            // Function to open and populate the Anggaran modal (Edit)
            function openAnggaranModal(row = null) {
                const modal = document.getElementById('anggaranModal'); // Modal ID for Anggaran
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                const form = document.getElementById('anggaranForm'); // Form ID for Anggaran
                const methodInput = document.getElementById('anggaranFormMethod'); // Method input ID for Anggaran
                const title = document.getElementById('anggaranModalTitle'); // Modal title ID for Anggaran

                if (row && row.id) {
                    // If data exists, populate the form for editing
                    form.action =
                        `{{ url('super-admin/anggaran') }}/${row.id}`; // Update the URL for the specific Anggaran record
                    methodInput.value = 'PUT'; // Use PUT for editing existing data
                    title.textContent = 'Edit Anggaran'; // Set modal title to 'Edit Anggaran'

                    // Populate the form fields with the selected row data
                    document.getElementById('anggaran_akun').value = row.akun || '';
                    document.getElementById('anggaran_kegiatan').value = row.kegiatan || '';
                    document.getElementById('anggaran_sebelum').value = row.anggaran_sebelum ?? 0;
                    document.getElementById('anggaran_blokir').value = row.blokir ?? 0;
                    document.getElementById('anggaran_setelah').value = row.anggaran_sebelum - (row.blokir ?? 0);
                } else {
                    // If no data, prepare the form for creating a new entry
                    form.action = `{{ route('super-admin.anggaran.store') }}`; // Use POST for creating new data
                    methodInput.value = 'POST'; // Set method to POST
                    title.textContent = 'Tambah Anggaran'; // Set modal title to 'Tambah Anggaran'
                    form.reset(); // Reset the form fields
                }

                // Optionally, you can perform any calculation or adjustments here if necessary
                autoCalcAnggaran(); // Example of auto-calculation function
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

            function confirmDeleteAnggaran(event) {
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
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                }
            }

            // Close modal when clicking outside
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('addPhotoModal');
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeAddPhotoModal();
                        }
                    });
                }

                // Image preview functionality
                const imageInput = document.getElementById('image');
                const imagePreview = document.getElementById('imagePreview');
                const previewImage = document.getElementById('previewImage');

                if (imageInput && imagePreview && previewImage) {
                    imageInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImage.src = e.target.result;
                                imagePreview.style.display = 'block';
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                }
            });

            // Function to remove preview
            function removePreview() {
                const imageInput = document.getElementById('image');
                const imagePreview = document.getElementById('imagePreview');
                const previewImage = document.getElementById('previewImage');

                if (imageInput) imageInput.value = '';
                if (imagePreview) imagePreview.style.display = 'none';
                if (previewImage) previewImage.src = '';
            }

            // Function to delete current image
            function deleteCurrentImage() {
                if (gallery.length === 0) return;

                const currentImage = gallery[activeIndex];
                const imageName = currentImage.description || 'Foto ini';

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `
                        <div class="text-center">
                            <div class="mb-4">
                                <svg class="w-16 h-16 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-semibold text-gray-800 mb-2">Apakah Anda yakin ingin menghapus foto?</p>
                            <p class="text-sm text-gray-600 mb-1"><strong>Foto:</strong> ${imageName}</p>
                            <p class="text-sm text-red-600 font-medium">⚠️ Tindakan ini tidak dapat dibatalkan!</p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: `
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Ya, Hapus!
                    `,
                    cancelButtonText: `
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    `,
                    reverseButtons: true,
                    focusCancel: true,
                    customClass: {
                        popup: 'rounded-2xl',
                        confirmButton: 'px-6 py-3 rounded-lg font-semibold',
                        cancelButton: 'px-6 py-3 rounded-lg font-semibold'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        const deleteBtn = document.getElementById('deleteCurrentBtn');
                        if (deleteBtn) {
                            deleteBtn.innerHTML = `
                                <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            `;
                            deleteBtn.disabled = true;
                        }

                        // Show loading SweetAlert
                        Swal.fire({
                            title: 'Menghapus Foto...',
                            html: `
                                <div class="text-center">
                                    <div class="mb-4">
                                        <svg class="w-12 h-12 text-blue-500 mx-auto animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600">Sedang memproses penghapusan foto...</p>
                                </div>
                            `,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        });

                        // Send delete request
                        fetch(`/super-admin/gallery/${currentImage.id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Remove image from gallery array
                                    gallery.splice(activeIndex, 1);

                                    if (gallery.length === 0) {
                                        // Show success message then reload
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            html: `
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-800 mb-2">Foto berhasil dihapus!</p>
                                                <p class="text-sm text-gray-600">Halaman akan dimuat ulang...</p>
                                            </div>
                                        `,
                                            icon: 'success',
                                            timer: 2000,
                                            showConfirmButton: false,
                                            customClass: {
                                                popup: 'rounded-2xl'
                                            }
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        // Adjust active index if needed
                                        if (activeIndex >= gallery.length) {
                                            activeIndex = gallery.length - 1;
                                        }

                                        // Update gallery display
                                        updateGallery();
                                        resetTimer();

                                        // Show success message
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            html: `
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-800 mb-2">Foto berhasil dihapus!</p>
                                                <p class="text-sm text-gray-600">Galeri telah diperbarui</p>
                                            </div>
                                        `,
                                            icon: 'success',
                                            timer: 2000,
                                            showConfirmButton: false,
                                            customClass: {
                                                popup: 'rounded-2xl'
                                            }
                                        });
                                    }
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        html: `
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <svg class="w-16 h-16 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-800 mb-2">Gagal menghapus foto!</p>
                                            <p class="text-sm text-gray-600">${data.message || 'Terjadi kesalahan yang tidak diketahui'}</p>
                                        </div>
                                    `,
                                        icon: 'error',
                                        confirmButtonText: 'OK',
                                        customClass: {
                                            popup: 'rounded-2xl',
                                            confirmButton: 'px-6 py-3 rounded-lg font-semibold'
                                        }
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    html: `
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <svg class="w-16 h-16 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-lg font-semibold text-gray-800 mb-2">Terjadi Kesalahan!</p>
                                        <p class="text-sm text-gray-600">Tidak dapat menghapus foto. Silakan coba lagi.</p>
                                    </div>
                                `,
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'rounded-2xl',
                                        confirmButton: 'px-6 py-3 rounded-lg font-semibold'
                                    }
                                });
                            })
                            .finally(() => {
                                // Restore delete button
                                if (deleteBtn) {
                                    deleteBtn.innerHTML = `
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                `;
                                    deleteBtn.disabled = false;
                                }
                            });
                    }
                });
            }







            // Initialize when DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                initializeNewsModal();
            });

            // News Modal Functions
            function initializeNewsModal() {
                // Open Add News Modal
                const addNewsBtn = document.getElementById('addNewsBtn');
                if (addNewsBtn) {
                    addNewsBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const modal = document.getElementById('addNewsModal');
                        if (modal) {
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                            document.body.classList.add('overflow-hidden');
                        }
                    });
                }

                // Close modal when clicking outside
                const modal = document.getElementById('addNewsModal');
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeAddNewsModal();
                        }
                    });
                }

                // News URL preview functionality
                const newsUrlInput = document.getElementById('newsUrl');
                const newsPreview = document.getElementById('newsPreview');

                if (newsUrlInput && newsPreview) {
                    let previewTimeout;
                    newsUrlInput.addEventListener('input', function() {
                        clearTimeout(previewTimeout);
                        const url = this.value.trim();

                        if (url && isValidUrl(url)) {
                            previewTimeout = setTimeout(() => {
                                fetchNewsPreview(url);
                            }, 1000); // Wait 1 second after user stops typing
                        } else {
                            newsPreview.classList.add('hidden');
                        }
                    });
                }

                // News form submission
                const newsForm = document.getElementById('newsForm');
                if (newsForm) {
                    newsForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const url = document.getElementById('newsUrl').value;
                        const submitBtn = document.getElementById('submitNewsBtn');

                        if (!url) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'URL berita tidak boleh kosong',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }

                        // Show loading state
                        if (submitBtn) {
                            submitBtn.innerHTML = `
                                <svg class="w-4 h-4 inline mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Menyimpan...
                            `;
                            submitBtn.disabled = true;
                        }

                        // Send request to save news
                        fetch('/super-admin/news/store', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    url: url
                                })
                            })
                            .then(response => {
                                console.log('Response status:', response.status);
                                return response.json();
                            })
                            .then(data => {
                                console.log('Response data:', data);
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Berita berhasil ditambahkan',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        // Scroll to news section
                                        const newsSection = document.getElementById('beritaSection');
                                        if (newsSection) {
                                            newsSection.scrollIntoView({
                                                behavior: 'smooth',
                                                block: 'start'
                                            });
                                        }
                                        // Close modal
                                        closeAddNewsModal();
                                        // Reload page to show new news
                                        setTimeout(() => {
                                            location.reload();
                                        }, 500);
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: data.message || 'Gagal menambahkan berita',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat menyimpan berita. Periksa console untuk detail error.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            })
                            .finally(() => {
                                // Restore submit button
                                if (submitBtn) {
                                    submitBtn.innerHTML = `
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Berita
                                `;
                                    submitBtn.disabled = false;
                                }
                            });
                    });
                }
            }

            // Utility functions
            function isValidUrl(string) {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;
                }
            }

            function fetchNewsPreview(url) {
                fetch('/super-admin/news/preview', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            url: url
                        })
                    })
                    .then(response => {
                        console.log('Preview response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Preview response data:', data);
                        if (data.success) {
                            const previewImage = document.getElementById('previewImage');
                            const previewTitle = document.getElementById('previewTitle');
                            const previewDescription = document.getElementById('previewDescription');
                            const previewSource = document.getElementById('previewSource');
                            const newsPreview = document.getElementById('newsPreview');

                            if (previewImage) previewImage.src = data.image_url ||
                                '{{ asset('images/default-news.jpg') }}';
                            if (previewTitle) previewTitle.textContent = data.title || 'Judul tidak ditemukan';
                            if (previewDescription) previewDescription.textContent = data.description ||
                                'Deskripsi tidak ditemukan';
                            if (previewSource) previewSource.textContent = data.source || 'Sumber tidak diketahui';

                            if (newsPreview) newsPreview.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching preview:', error);
                    });
            }


            // News Modal Functions
            function closeAddNewsModal() {
                const modal = document.getElementById('addNewsModal');
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');
                }
            }

            // Delete news function
            function deleteNews(newsId) {
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `
                        <div class="text-center">
                            <div class="mb-4">
                                <svg class="w-16 h-16 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-semibold text-gray-800 mb-2">Apakah Anda yakin ingin menghapus berita ini?</p>
                            <p class="text-sm text-red-600 font-medium">⚠️ Tindakan ini tidak dapat dibatalkan!</p>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/super-admin/news/${newsId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Berita berhasil dihapus',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        // Scroll to news section
                                        const newsSection = document.getElementById('beritaSection');
                                        if (newsSection) {
                                            newsSection.scrollIntoView({
                                                behavior: 'smooth',
                                                block: 'start'
                                            });
                                        }
                                        // Reload page to update news list
                                        setTimeout(() => {
                                            location.reload();
                                        }, 500);
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: data.message || 'Gagal menghapus berita',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat menghapus berita',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                    }
                });
            }


            // Open "Add Photo" Modal
            document.addEventListener('DOMContentLoaded', function() {
                const addPhotoBtn = document.getElementById('addPhotoBtn');
                if (addPhotoBtn) {
                    addPhotoBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const modal = document.getElementById('addPhotoModal');
                        if (modal) {
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                            document.body.classList.add('overflow-hidden');
                        }
                    });
                }
            });

            // Tupoksi Modal Functions
            function openTugasModal(tugasData = null) {
                const modal = document.getElementById('tugasModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                const form = document.getElementById('tugasForm');
                const methodInput = document.getElementById('tugasFormMethod');
                const title = document.getElementById('tugasModalTitle');

                if (tugasData && tugasData.id) {
                    // Edit mode
                    form.action = `{{ url('super-admin/tupoksi/tugas') }}/${tugasData.id}`;
                    methodInput.value = 'PUT';
                    title.textContent = 'Edit Tugas Pokok';
                    document.getElementById('tugas_pasal').value = tugasData.pasal || '';
                    document.getElementById('tugas_isi').value = tugasData.isi || '';
                } else {
                    // Add mode
                    form.action = `{{ route('super-admin.tupoksi.tugas.store') }}`;
                    methodInput.value = 'POST';
                    title.textContent = 'Tambah Tugas Pokok';
                    form.reset();
                }

                loadTugasList();
            }

            function closeTugasModal() {
                const modal = document.getElementById('tugasModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            function openFungsiModal(fungsiData = null) {
                const modal = document.getElementById('fungsiModal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.classList.add('overflow-hidden');

                const form = document.getElementById('fungsiForm');
                const methodInput = document.getElementById('fungsiFormMethod');
                const title = document.getElementById('fungsiModalTitle');

                if (fungsiData && fungsiData.id) {
                    // Edit mode
                    form.action = `{{ url('super-admin/tupoksi/fungsi') }}/${fungsiData.id}`;
                    methodInput.value = 'PUT';
                    title.textContent = 'Edit Fungsi';
                    loadFungsiForEdit(fungsiData.id);
                } else {
                    // Add mode
                    form.action = `{{ route('super-admin.tupoksi.fungsi.store') }}`;
                    methodInput.value = 'POST';
                    title.textContent = 'Kelola Fungsi';
                    loadAllFungsiForEdit();
                }

                loadFungsiList();
            }

            function closeFungsiModal() {
                const modal = document.getElementById('fungsiModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }

            // Load Tugas List
            function loadTugasList() {
                fetch('{{ route('super-admin.tupoksi.tugas.get', ':id') }}'.replace(':id', ''))
                    .then(response => response.json())
                    .then(data => {
                        const tugasList = document.getElementById('tugasList');
                        tugasList.innerHTML = '';

                        if (data.success && data.data) {
                            data.data.forEach(tugas => {
                                const tugasItem = document.createElement('div');
                                tugasItem.className = 'bg-gray-50 p-4 rounded-lg border';
                                tugasItem.innerHTML = `
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h5 class="font-semibold text-gray-800">${tugas.pasal}</h5>
                                            <p class="text-gray-600 mt-2">${tugas.isi}</p>
                                        </div>
                                        <div class="flex gap-2 ml-4">
                                            <button onclick="editTugas(${tugas.id})"
                                                class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                                                Edit
                                            </button>
                                            <button onclick="deleteTugas(${tugas.id})"
                                                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                `;
                                tugasList.appendChild(tugasItem);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error loading tugas list:', error);
                    });
            }

            // Load Fungsi List
            function loadFungsiList() {
                fetch('{{ route('super-admin.tupoksi.fungsi.get', ':id') }}'.replace(':id', ''))
                    .then(response => response.json())
                    .then(data => {
                        const fungsiList = document.getElementById('fungsiList');
                        fungsiList.innerHTML = '';

                        if (data.success && data.data) {
                            data.data.forEach(fungsi => {
                                const fungsiItem = document.createElement('div');
                                fungsiItem.className = 'bg-gray-50 p-4 rounded-lg border';
                                fungsiItem.innerHTML = `
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="text-gray-600">${fungsi.isi}</p>
                                        </div>
                                        <div class="flex gap-2 ml-4">
                                            <button onclick="editFungsi(${fungsi.id})"
                                                class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                                Edit
                                            </button>
                                            <button onclick="deleteFungsi(${fungsi.id})"
                                                class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                `;
                                fungsiList.appendChild(fungsiItem);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error loading fungsi list:', error);
                    });
            }

            // Load all functions for editing
            function loadAllFungsiForEdit() {
                fetch('{{ route('super-admin.tupoksi.fungsi.get', ':id') }}'.replace(':id', ''))
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('fungsiFieldsContainer');
                        container.innerHTML = '';

                        if (data.success && data.data && data.data.length > 0) {
                            data.data.forEach((fungsi, index) => {
                                addFungsiField(fungsi.isi, fungsi.id, index + 1);
                            });
                        } else {
                            // Add one empty field if no data
                            addFungsiField('', '', 1);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading functions for edit:', error);
                        // Add one empty field on error
                        addFungsiField('', '', 1);
                    });
            }

            // Load single function for editing
            function loadFungsiForEdit(id) {
                fetch(`{{ url('super-admin/tupoksi/fungsi') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('fungsiFieldsContainer');
                        container.innerHTML = '';

                        if (data.success && data.data) {
                            addFungsiField(data.data.isi, data.data.id, 1);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading function for edit:', error);
                    });
            }

            // Add function field
            function addFungsiField(value = '', id = '', number = null) {
                const container = document.getElementById('fungsiFieldsContainer');
                const fieldCount = container.children.length;
                const fieldNumber = number || fieldCount + 1;

                const fieldDiv = document.createElement('div');
                fieldDiv.className = 'flex items-start gap-3 p-3 bg-gray-50 rounded-lg border';
                fieldDiv.innerHTML = `
                    <div class="flex-shrink-0 mt-2">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-500 text-white text-xs font-bold">
                            ${fieldNumber}
                        </span>
                    </div>
                    <div class="flex-1">
                        <textarea name="fungsi_isi[]" rows="3"
                            class="w-full rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500"
                            placeholder="Masukkan isi fungsi ${fieldNumber}..." required>${value}</textarea>
                        ${id ? `<input type="hidden" name="fungsi_id[]" value="${id}">` : ''}
                    </div>
                    <div class="flex-shrink-0 mt-2">
                        <button type="button" onclick="removeFungsiField(this)"
                            class="px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                container.appendChild(fieldDiv);
                updateFungsiNumbers();
            }

            // Remove function field
            function removeFungsiField(button) {
                const fieldDiv = button.closest('.flex.items-start.gap-3');
                fieldDiv.remove();
                updateFungsiNumbers();
            }

            // Update function numbers
            function updateFungsiNumbers() {
                const container = document.getElementById('fungsiFieldsContainer');
                const fields = container.children;

                Array.from(fields).forEach((field, index) => {
                    const numberSpan = field.querySelector('.bg-green-500');
                    if (numberSpan) {
                        numberSpan.textContent = index + 1;
                    }

                    const textarea = field.querySelector('textarea');
                    if (textarea) {
                        textarea.placeholder = `Masukkan isi fungsi ${index + 1}...`;
                    }
                });
            }

            // Edit Functions
            function editTugas(id) {
                fetch(`{{ url('super-admin/tupoksi/tugas') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            openTugasModal(data.data);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading tugas:', error);
                    });
            }

            function editFungsi(id) {
                fetch(`{{ url('super-admin/tupoksi/fungsi') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            openFungsiModal(data.data);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading fungsi:', error);
                    });
            }

            // Delete Functions
            function deleteTugas(id) {
                if (confirm('Apakah Anda yakin ingin menghapus tugas pokok ini?')) {
                    fetch(`{{ url('super-admin/tupoksi/tugas') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                loadTugasList();
                                // Refresh dashboard content
                                location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting tugas:', error);
                            alert('Terjadi kesalahan saat menghapus data');
                        });
                }
            }

            function deleteFungsi(id) {
                if (confirm('Apakah Anda yakin ingin menghapus fungsi ini?')) {
                    fetch(`{{ url('super-admin/tupoksi/fungsi') }}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                loadFungsiList();
                                // Refresh dashboard content
                                location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting fungsi:', error);
                            alert('Terjadi kesalahan saat menghapus data');
                        });
                }
            }

            // Handle form submission with success callback
            document.addEventListener('DOMContentLoaded', function() {
                // Handle tugas form submission
                const tugasForm = document.getElementById('tugasForm');
                if (tugasForm) {
                    tugasForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);
                        const url = this.action;
                        const method = document.getElementById('tugasFormMethod').value;

                        fetch(url, {
                                method: method,
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    closeTugasModal();
                                    location.reload();
                                } else {
                                    alert('Error: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menyimpan data');
                            });
                    });
                }

                // Handle fungsi form submission
                const fungsiForm = document.getElementById('fungsiForm');
                if (fungsiForm) {
                    fungsiForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);
                        const url = this.action;

                        fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    closeFungsiModal();
                                    location.reload();
                                } else {
                                    alert('Error: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menyimpan data');
                            });
                    });
                }
            });
        </script>
    @endpush
@endsection
