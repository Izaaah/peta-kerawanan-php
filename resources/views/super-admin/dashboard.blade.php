@extends('layouts.superadmin-master')

@section('content')
@include('components.superadmin-navbar')

<div class="container mx-auto pt-1 pb-4 py-6 max-w-7xl">
    <!-- Tab Navigation -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <!-- Tab Statistik (Active) -->
                <button class="tab-button active" id="statistikTab">
                    <div class="flex items-center space-x-2 py-2 px-1">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="text-blue-600 font-medium">Statistik</span>
                    </div>
                </button>

                <!-- Tab Profil Organisasi (Inactive) -->
                <button class="tab-button inactive" id="profilTab">
                    <div class="flex items-center space-x-2 py-2 px-1">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="text-gray-700 font-medium">Profil Organisasi</span>
                    </div>
                </button>

                <!-- Tab Anggaran (Inactive) -->
                <button class="tab-button inactive" id="anggaranTab">
                    <div class="flex items-center space-x-2 py-2 px-1">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
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
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
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
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
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
                        <h3 class="text-lg font-semibold text-gray-900">Kasus per Kabupaten/Kota (Top 10)</h3>
                        <button id="showAllKabupatenBtn" class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">
                            <div class="flex items-center space-x-1">
                                <span>Lihat Semua</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
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
                        <h3 class="text-lg font-semibold text-gray-900">Kasus per Kecamatan</h3>
                        <button id="showAllKecamatanBtn" class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors">
                            <div class="flex items-center space-x-1">
                                <span>Lihat Semua</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </button>
                    </div>
                    {{-- <h3 class="text-lg font-semibold text-gray-900 mb-4">Kasus per Kecamatan</h3> --}}
                    <canvas id="chartKecamatan" width="400" height="200"></canvas>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Desa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kabupaten</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($kasusTerbaru as $kasus)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kasus->nama_desa }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kasus->kecamatan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kasus->kabupaten }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kasus->keterangan ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kasus->created_at->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data kasus</td>
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
                        <a href="#" id="openModalBtn" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            Tambah Anggaran
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">AKUN</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">KEGIATAN</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ANGGARAN SEBELUM BLOKIR</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">BLOKIR</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ANGGARAN SETELAH BLOKIR</th>
                                <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($anggaranList as $anggaran)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $anggaran->akun }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $anggaran->kegiatan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 bg-blue-100">Rp {{ number_format($anggaran->anggaran_sebelum, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 bg-red-100">Rp {{ $anggaran->blokir ? number_format($anggaran->blokir, 0, ',', '.') : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-900 bg-yellow-100">Rp {{ number_format(($anggaran->anggaran_sebelum - ($anggaran->blokir ?? 0)), 0, ',', '.') }}</td>
                                <td class="px-2 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                    <div class="flex items-center justify-center space-x-2">
                                        {{-- Aksi seperti edit/hapus dapat ditambahkan di sini --}}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data anggaran</td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-center text-sm font-bold text-gray-900">TOTAL</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-blue-100">Rp {{ number_format($totalAnggaranSebelum, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-red-100">Rp {{ number_format($totalBlokir, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900 bg-yellow-100">Rp {{ number_format($totalSetelah, 0, ',', '.') }}</td>
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
            <img src="{{ asset('storage/img/logo.png') }}" alt="Logo BNN" class="h-16 mb-2 mx-auto">
            <div>
                <h2 class="text-lg font-bold text-gray-900">BADAN NARKOTIKA NASIONAL</h2>
                <h3 class="text-lg font-bold text-gray-900">PROVINSI JAWA TIMUR</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8">
            <!-- Konten lainnya akan ditampilkan di sini -->
        </div>

        <!-- Tugas Pokok dan Fungsi -->
<div class="mt-5 space-y-12 max-w-5xl mx-auto px-4">
<div class="relative pb-6">
    <h4 class="text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-red-600 pb-3">Tugas Pokok dan Fungsi (Tupoksi) Bidang Pemberantasan dan Intelijen</h4>
    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full"></div>
</div>

<!-- Tugas Pokok -->
<div class="bg-gradient-to-br from-white to-blue-50 rounded-base shadow-lg p-8 border-t border-l border-blue-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
    <div class="flex items-center mb-1">
        <h5 class="text-2xl font-bold text-black tracking-tight">Tugas Pokok Bidang Pemberantasan dan Intelijen</h5>
    </div>
    <div class="pl-5 pr-4">
        <p class="text-gray-700 leading-relaxed text-lg bg-white bg-opacity-50 p-4 ml-5 font-sans">
            <span class="font-bold">Pasal 9 Peraturan Kepala BNN Nomor 6 Tahun 2020</span>:<br>
            <span class="italic"><span class="font-bold">"</span>Pemberantasan dan Intelijen mempunyai tugas melaksanakan kebijakan teknis P4GN di bidang Pemberantasan dan Intelijen dalam wilayah Provinsi.<span class="font-bold">"</span></span>
        </p>
    </div>
</div>

<!-- Fungsi -->
<div class="relative overflow-hidden rounded-2xl border border-emerald-100 bg-gradient-to-br from-white to-emerald-50/60 shadow-xl mb-8">
    <div class="absolute -top-16 -right-16 h-48 w-48 rounded-full bg-emerald-200/30 blur-2xl"></div>
    <div class="absolute -bottom-16 -left-16 h-48 w-48 rounded-full bg-emerald-100/30 blur-2xl"></div>

    <div class="relative p-8">
      <div class="flex items-center gap-3 mb-6">
        <div class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-500 text-white shadow-md">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M7 13V9a5 5 0 0110 0v4"></path>
          </svg>
        </div>
        <h5 class="text-2xl font-bold tracking-tight text-gray-900">Fungsi</h5>
      </div>

      <div class="bg-white/60 backdrop-blur rounded-xl p-4 border border-emerald-100">
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <!-- 1 -->
          <li class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white/70 p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold ring-2 ring-white shadow">
              1
            </span>
            <p class="text-gray-700 leading-relaxed">
              Penyiapan pelaksanaan koordinasi penyusunan rencana strategis dan rencana kerja tahunan P4GN di bidang pemberantasan dalam wilayah Provinsi;
            </p>
          </li>

          <!-- 2 -->
          <li class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white/70 p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold ring-2 ring-white shadow">
              2
            </span>
            <p class="text-gray-700 leading-relaxed">
              Penyiapan pelaksanaan pemberantasan dan pemutusan jaringan kejahatan terorganisasi penyalahgunaan peredaran gelap narkotika dalam wilayah Provinsi;
            </p>
          </li>

          <!-- 3 -->
          <li class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white/70 p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold ring-2 ring-white shadow">
              3
            </span>
            <p class="text-gray-700 leading-relaxed">
              Penyiapan pelaksanaan pembangunan dan pemanfaatan intelijen teknologi dan kegiatan intelijen taktis, operasional dan produk dalam rangka P4GN di bidang pemberantasan dalam wilayah Provinsi;
            </p>
          </li>

          <!-- 4 -->
          <li class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white/70 p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold ring-2 ring-white shadow">
              4
            </span>
            <p class="text-gray-700 leading-relaxed">
              Penyiapan pelaksanaan administrasi penyelidikan dan penyidikan terhadap tindak pidana narkotika, psikotropika, prekursor, dan bahan adiktif lainnya kecuali bahan adiktif untuk tembakau dan alkohol dalam wilayah Provinsi;
            </p>
          </li>

          <!-- 5 -->
          <li class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white/70 p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold ring-2 ring-white shadow">
              5
            </span>
            <p class="text-gray-700 leading-relaxed">
              Penyiapan pelaksanaan administrasi penyidikan tindak pidana pencucian uang yang berasal dari tindak pidana narkotika dalam wilayah Provinsi;
            </p>
          </li>

          <!-- 6 -->
          <li class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white/70 p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold ring-2 ring-white shadow">
              6
            </span>
            <p class="text-gray-700 leading-relaxed">
              Penyiapan pelaksanaan pengawasan distribusi prekursor sampai pada pengguna akhir dalam wilayah Provinsi;
            </p>
          </li>

          <!-- 7 -->
          <li class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white/70 p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold ring-2 ring-white shadow">
              7
            </span>
            <p class="text-gray-700 leading-relaxed">
              Penyiapan pelaksanaan pengawasan tahanan dan barang bukti dalam wilayah Provinsi;
            </p>
          </li>

          <!-- 8 -->
          <li class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white/70 p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md">
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold ring-2 ring-white shadow">
              8
            </span>
            <p class="text-gray-700 leading-relaxed">
              Penyiapan pelaksanaan pembinaan teknis dan supervisi P4GN di bidang pemberantasan kepada BNNK/Kota dalam wilayah Provinsi; dan
            </p>
          </li>

          <!-- 9 -->
          <li class="flex items-start gap-4 rounded-xl border border-gray-100 bg-white/70 p-4 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md md:col-span-2">
            <span class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-bold ring-2 ring-white shadow">
              9
            </span>
            <p class="text-gray-700 leading-relaxed">
              Penyiapan pelaksanaan evaluasi dan pelaporan P4GN di bidang pemberantasan dalam wilayah Provinsi.
            </p>
          </li>
        </ul>
      </div>
    </div>
  </div>

<!-- Struktur Organisasi -->
<div class="mt-12 max-w-6xl mx-auto px-4">
    <div class="relative pb-6 mb-8">
      <h4 class="text-3xl font-extrabold text-center text-black pb-3">Struktur Organisasi</h4>
      <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-black rounded-full"></div>
    </div>
  
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-300 overflow-hidden relative mb-12">
      <div class="org-chart relative space-y-12">
        <!-- Kepala -->
        <div class="relative flex flex-col items-center">
          <div class="flex items-center bg-gray-800 text-white rounded-xl shadow-lg p-5 border-2 border-gray-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-24 h-24 rounded-none bg-white mr-5 overflow-hidden border-2 border-gray-300 shadow-inner flex items-center justify-center">
              <img class="w-14 h-14 object-cover" src="/path/to/photo1.jpg" alt="Kepala BNNP Jatim">
            </div>
            <div class="text-left">
              <div class="font-bold text-xl mb-1">Kepala BNNP Jatim</div>
              <div class="text-md">Brigjen Pol. Dr. H. Slamet Hadi Tjahjanto</div>
            </div>
          </div>
          <div class="h-8 w-0.5 bg-white"></div>
        </div>
  
        <!-- Kabid Pemberantasan dan Intelijen -->
        <div class="relative flex flex-col items-center">
          <div class="flex items-center bg-gray-600 text-white rounded-xl shadow-lg p-5 border-2 border-gray-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-20 h-20 rounded-none bg-white mr-5 overflow-hidden border-2 border-gray-300 shadow-inner flex items-center justify-center">
              <img class="w-12 h-12 object-cover" src="/path/to/photo2.jpg" alt="Kabid Pemberantasan dan Intelijen">
            </div>
            <div class="text-left">
              <div class="font-bold text-lg mb-1">Kabid Pemberantasan dan Intelijen</div>
              <div class="text-md">Kompol Dra. Suparti</div>
            </div>
          </div>
          <div class="h-10 w-0.5 bg-white"></div>
        </div>
  
        <!-- Kasubag Pemberantasan dan Kasubag Wastahi -->
        <div class="relative w-full">
          <div class="absolute left-[8%] right-[8%] top-0 h-0.5 bg-white"></div>
  
          <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 px-4">
            <!-- Kasi Intelijen -->
            <div class="relative flex flex-col items-center">
              <span class="absolute -top-8 h-8 w-0.5 bg-white"></span>
              <div class="flex flex-col bg-gray-500 text-white rounded-xl shadow-lg p-5 border-2 border-gray-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 w-full">
                <div class="flex items-center mb-3">
                  <div class="w-16 h-16 rounded-none bg-white mr-4 overflow-hidden border-2 border-gray-300 shadow-inner flex items-center justify-center">
                    <img class="w-10 h-10 object-cover" src="/path/to/photo3.jpg" alt="Kasi Intelijen">
                  </div>
                  <div class="text-left">
                    <div class="font-bold text-md">Kasi Intelijen</div>
                    <div class="text-sm">Analis Intelijen</div>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Kasi Wastahi -->
            <div class="relative flex flex-col items-center">
              <span class="absolute -top-8 h-8 w-0.5 bg-white"></span>
              <div class="flex flex-col bg-gray-500 text-white rounded-xl shadow-lg p-5 border-2 border-gray-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 w-full">
                <div class="flex items-center mb-3">
                  <div class="w-16 h-16 rounded-none bg-white mr-4 overflow-hidden border-2 border-gray-300 shadow-inner flex items-center justify-center">
                    <img class="w-10 h-10 object-cover" src="/path/to/photo4.jpg" alt="Kasi Wastahi">
                  </div>
                  <div class="text-left">
                    <div class="font-bold text-md">Kasi Wastahi</div>
                    <div class="text-sm">Pengolah Data Wastahi</div>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Additional positions such as Pengawal Tahanan, Penindak, etc -->
            <!-- You can follow the same structure for the next positions -->
          </div>
        </div>
      </div>
    </div>
  </div>
  
<div class="mt-12 max-w-6xl mx-auto px-4">
<div class="relative pb-6 mb-8">
    <h4 class="text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-red-600 pb-3">Komposisi Personil Pemberantasan</h4>
    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-32 h-1.5 bg-gradient-to-r from-blue-500 to-red-500 rounded-full"></div>
    </div>
</div>
<div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-xl p-8 border border-blue-100 overflow-hidden relative mb-12">
    <div class="space-y-6">
        <!-- Tabel Komposisi -->
        <div class="bg-white rounded-lg shadow">
            <div class="relative px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Rincian Komposisi</h3>
                <div class="absolute right-0 top-0 mt-3 mr-4">
                    <a href="#" onclick="openKomposisiModal()" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        Edit Komposisi
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th rowspan="2" class="px-6 py-3 text-center text-lg font-medium text-gray-500 uppercase tracking-wider border-r">
                                BIDANG/SEKSI
                            </th>
                            <th rowspan="2" class="px-2 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider border-r">
                                JUMLAH <br>PERSONIL
                            </th>
                            <th colspan="3" class="px-4 py-3 text-center text-base font-medium text-gray-500 uppercase tracking-wider border-b border-r">
                                DSP
                            </th>
                            <th rowspan="2" class="px-6 py-3 text-center text-base font-medium text-gray-500 uppercase tracking-wider border-r">
                                KETERANGAN
                            </th>
                            <th rowspan="2" class="px-2 py-3 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">
                                AKSI
                            </th>
                        </tr>
                        <tr>
                            <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">JUMLAH</th>
                            <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">TERISI</th>
                            <th class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-r">KOSONG</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($komposisiList as $komposisi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 whitespace-nowrap text-left text-sm font-medium text-gray-900 border-r uppercase">{{ $komposisi->bidang }}</td>
                            <td class="px-2 py-3 text-sm text-gray-900 bg-green-100 text-center border-r">{{ $komposisi->jumlah_personil }}</td>
                            <td class="px-2 py-3 text-sm text-gray-900 bg-blue-100 text-center border-r">{{ $komposisi->dsp_jumlah }}</td>
                            <td class="px-2 py-3 text-sm text-gray-900 bg-red-100 text-center border-r">{{ $komposisi->dsp_kosong }}</td>
                            <td class="px-2 py-3 text-sm text-gray-900 bg-yellow-100 text-center border-r">{{ $komposisi->dsp_terisi }}</td>
                            <td class="px-6 py-3 text-sm text-gray-900 bg-white text-left border-r">{{ $komposisi->keterangan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm font-medium text-gray-900">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="1" class="px-6 py-4 text-center text-sm font-bold border-r text-gray-900">TOTAL</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-green-100 border-r">{{ $totalPersonil }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-blue-100 border-r">{{ $totalDspJumlah }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-red-100 border-r">{{ $totalDspTerisi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900 bg-yellow-100 border-r">{{ $totalDspKosong }}</td>
                        </tr>
                    </tfoot>
                </table>
                <!-- Removed all extra table elements that were outside the table structure -->
             </div>
        </div>
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
<div id="allKabupatenModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4 mt-12">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Semua Kabupaten/Kota Berdasarkan Jumlah Kasus</h3>
            <button id="closeKabupatenModal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-4 overflow-auto flex-grow">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kabupaten/Kota</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Kasus</th>
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
<div id="allKecamatanModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4 mt-12">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Semua Kecamatan Berdasarkan Jumlah Kasus</h3>
            <button id="closeKecamatanModal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="p-4 overflow-auto flex-grow">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kecamatan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kabupaten/Kota</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Kasus</th>
                        </tr>
                    </thead>
                    <tbody id="allKecamatanTableBody" class="bg-white divide-y divide-gray-200">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Anggaran -->
<div id="tambahAnggaranModal"
     class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4 mt-12">

    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto transform transition-all duration-300 ease-in-out">

        <div class="relative px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Tambah Anggaran Baru</h3>
            <button id="closeModalBtn" class="absolute top-[20px] right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        {{-- <form action="#" method="POST" class="p-6 space-y-4"> --}}
        <form action="{{ route('super-admin.anggaran.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
            <div>
                <label for="akun" class="block text-sm font-medium text-gray-700">AKUN</label>
                <input type="text" id="akun" name="akun" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm uppercase">
            </div>

            <div>
                <label for="kegiatan" class="block text-sm font-medium text-gray-700">KEGIATAN</label>
                <textarea id="kegiatan" name="kegiatan" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="anggaran_sebelum" class="block text-sm font-medium text-gray-700">ANGGARAN SEBELUM BLOKIR</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            Rp
                        </span>
                        <input type="number" id="anggaran_sebelum" name="anggaran_sebelum" step="0.01" min="0"
                            class="block w-full rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="blokir" class="block text-sm font-medium text-gray-700">BLOKIR</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            Rp
                        </span>
                        <input type="number" id="blokir" name="blokir" step="0.01" min="0"
                            class="block w-full rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" id="cancelModalBtn" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-md shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition">
                    Batal
                </button>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Anggaran
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Komposisi -->
<div id="komposisiModal"
     class="fixed inset-0 hidden items-center justify-center p-4 bg-black bg-opacity-50"
     style="z-index: 9999;">
  <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-auto">
    <div class="flex items-center justify-between px-6 py-4 border-b">
      <h3 class="text-lg font-semibold text-gray-900" id="komposisiModalTitle">Edit Komposisi</h3>
      <button type="button" class="text-gray-500 hover:text-gray-700" onclick="closeKomposisiModal()">✕</button>
    </div>

    <form id="komposisiForm" method="POST" action="{{ route('super-admin.komposisi.store') }}" class="p-6 space-y-4">
      @csrf
      <input type="hidden" name="_method" id="komposisiFormMethod" value="POST" />

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 uppercase">Bidang/Seksi</label>
          <input name="bidang" id="komposisi_bidang" type="text"
                 class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 uppercase">Jumlah Personil</label>
          <input name="jumlah_personil" id="komposisi_jumlah_personil" type="number" min="0"
                 class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase" required />
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 uppercase">DSP Jumlah</label>
          <input name="dsp_jumlah" id="komposisi_dsp_jumlah" type="number" min="0"
                 class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 uppercase">DSP Terisi</label>
          <input name="dsp_terisi" id="komposisi_dsp_terisi" type="number" min="0"
                 class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 uppercase" required />
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
        <button type="submit" class="px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">Simpan</button>
      </div>
    </form>
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
                'rgba(16, 185, 129, 0.8)'  // Non napi
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

// Modal dan Tabel Desa/Kecamatan
const showAllKabupatenBtn = document.getElementById('showAllKabupatenBtn');
const showAllKecamatanBtn = document.getElementById('showAllKecamatanBtn');
const allKabupatenModal = document.getElementById('allKabupatenModal');
const allKecamatanModal = document.getElementById('allKecamatanModal');
const closeKabupatenModal = document.getElementById('closeKabupatenModal');
const closeKecamatanModal = document.getElementById('closeKecamatanModal');
const allKabupatenTableBody = document.getElementById('allKabupatenTableBody');
const allKecamatanTableBody = document.getElementById('allKecamatanTableBody');

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
                    labels: ['Pencegahan', 'Pemberantasan', 'Rehabilitasi', 'Diklat', 'Kerjasama', 'Operasional'],
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
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
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

document.addEventListener('DOMContentLoaded', function () {
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
  j.removeEventListener?.('__calc', j.__calc); t.removeEventListener?.('__calc', t.__calc);
  j.__calc = calc; t.__calc = calc;
  j.addEventListener('input', calc); t.addEventListener('input', calc);
  calc();
}

    function openKomposisiModal(row = null) {
  const modal = document.getElementById('komposisiModal');
  modal.classList.remove('hidden');
  modal.classList.add('flex');
  document.body.classList.add('overflow-hidden'); // kunci scroll body

  const form = document.getElementById('komposisiForm');
  const methodInput = document.getElementById('komposisiFormMethod');
  const title = document.getElementById('komposisiModalTitle');

  if (row) {
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

</script>
@endpush
@endsection
