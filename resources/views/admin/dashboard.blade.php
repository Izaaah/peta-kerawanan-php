@php
    use App\Models\Komposisi;

    // $komposisiList = Komposisi::all();

@endphp

@extends('layouts.admin-master')

@section('content')
    @include('components.admin-navbar')

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

        <!-- Konten Statistik (Default) -->
        <div id="statistikContent" class="dashboard-content">
            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6 flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-red-500">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500 font-medium">Total Kasus</div>
                        <div class="text-2xl font-bold text-gray-900">{{ number_format($totalKasus) }}</div>
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

            <!-- Grafik Section TKP (Berdasarkan Tempat Kejadian Perkara) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Grafik Kasus per Kecamatan TKP -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Kasus per Kecamatan <br> Berdasarkan TKP</h3>
                                </div>
                        <canvas id="chartKecamatanTkp" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Grafik Kasus per Desa TKP (Top 10) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Kasus per Desa (Top 10) <br> Berdasarkan TKP
                            </h3>
                                </div>
                        <canvas id="chartDesaTkp" width="400" height="200"></canvas>
                        </div>
                    </div>
            </div>

            <!-- Grafik Section NIK (Berdasarkan Domisili NIK) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Grafik Kasus per Kecamatan NIK -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Kasus per Kecamatan <br> Berdasarkan NIK</h3>
                        </div>
                        <canvas id="chartKecamatanNik" width="400" height="200"></canvas>
                </div>
            </div>

                <!-- Grafik Kasus per Desa NIK (Top 10) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Kasus per Desa (Top 10) <br> Berdasarkan NIK
                            </h3>
                        </div>
                        <canvas id="chartDesaNik" width="400" height="200"></canvas>
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
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Desa</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kecamatan</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kabupaten</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lokasi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($kasusTerbaru as $kasus)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                            {{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $kasus->desa }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $kasus->kecamatan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $kasus->kabupaten }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $kasus->lokasi ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $kasus->created_at ? $kasus->created_at->format('d/m/Y') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada
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
                <div class="flex items-center justify-center mb-8">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo BNN" class="h-16 mr-3">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">BADAN NARKOTIKA NASIONAL</h2>
                        <h3 class="text-base text-gray-600">PROVINSI JAWA TIMUR</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8">
                    <!-- Konten lainnya akan ditampilkan di sini -->
                </div>

                <!-- Tugas Pokok dan Fungsi -->
                <div class="mt-5 space-y-12 mx-auto px-4">
                    <div class="relative pb-6">
                        <h4
                            class="text-3xl font-extrabold text-center bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-red-600 pb-3">
                            Tugas Pokok dan Fungsi (Tupoksi) Bidang Pemberantasan</h4>
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
                            <div class="text-gray-700 leading-relaxed text-lg bg-white bg-opacity-50 p-4 ml-5 font-sans">
                                @if (isset($tugas) && $tugas->count() > 0)
                                    @foreach ($tugas as $t)
                                        <p class="mb-3">
                                            <span class="font-bold">{{ $t->pasal }}</span>:<br>
                                            <span class="italic"><span class="font-bold">"</span>{{ $t->isi }}<span
                                                    class="font-bold">"</span></span>
                                        </p>
                                    @endforeach
                                @else
                                    <p class="text-gray-500 italic">Belum ada data tugas pokok.</p>
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
                        </div>
                        <div class="pl-1 pr-4">
                            <div class="bg-white bg-opacity-50 p-4 rounded-xl shadow-sm">
                                <ul class="space-y-4 list-none">
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
                                            <p class="ml-4 text-gray-500 italic">Belum ada data fungsi.</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>
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
                        {{-- <div class="absolute right-0 top-0">
            <a href="{{ route('admin.data.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-medium rounded-md shadow-sm hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
                Edit Struktur
            </a>
        </div> --}}
                    </div>

                    <div class="overflow-hidden relative mb-12">
                        <!-- Decorative elements -->
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full opacity-50 -mr-32 -mt-32 z-0">
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-red-100 to-red-50 rounded-full opacity-50 -ml-32 -mb-32 z-0">
                        </div>

                        <div class="org-chart relative space-y-12">

                            <!-- Kepala BNNP Jatim -->
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
                                <div class="w-full h-1 bg-gradient-to-r from-gray-300 via-gray-400 to-gray-300"></div>

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
                                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
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
                                        <div class="relative flex flex-col items-center">
                                            <!-- garis vertikal dari garis horizontal ke box -->
                                            <span class="absolute -top-6 h-20 w-px bg-gray-500 z-10"></span>
                                            <div
                                                class="w-full flex flex-col bg-gradient-to-r from-green-500 to-green-700 rounded-xl shadow-lg p-5 border-2 border-green-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                                <div class="flex items-center mb-3">
                                                    <div
                                                        class="w-16 h-16 rounded-full bg-white mr-4 overflow-hidden border-2 border-green-300 shadow-inner flex items-center justify-center">
                                                        <svg class="w-10 h-10 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="text-left">
                                                        <div class="text-white font-bold text-md">Direktorat Pencegahan
                                                        </div>
                                                        <div class="text-white text-sm">Kompol Dra. Suparti</div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-auto text-xs text-white bg-green-800/30 rounded-lg p-2 border border-green-400/30">
                                                    <ul class="list-disc list-inside space-y-1">
                                                        <li>Sosialisasi P4GN</li>
                                                        <li>Edukasi Masyarakat</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Direktorat Pemberantasan -->
                                        <div class="relative flex flex-col items-center">
                                            <span class="absolute -top-6 h-20 w-px bg-gray-500 z-10"></span>
                                            <div
                                                class="w-full flex flex-col bg-gradient-to-r from-green-500 to-green-700 rounded-xl shadow-lg p-5 border-2 border-green-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                                <div class="flex items-center mb-3">
                                                    <div
                                                        class="w-16 h-16 rounded-full bg-white mr-4 overflow-hidden border-2 border-green-300 shadow-inner flex items-center justify-center">
                                                        <svg class="w-10 h-10 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="text-left">
                                                        <div class="text-white font-bold text-md">Direktorat Pemberantasan
                                                        </div>
                                                        <div class="text-white text-sm">AKBP Wisnu Pradana, S.H.</div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-auto text-xs text-white bg-green-800/30 rounded-lg p-2 border border-green-400/30">
                                                    <ul class="list-disc list-inside space-y-1">
                                                        <li>Penyelidikan</li>
                                                        <li>Penyidikan</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Direktorat Rehabilitasi -->
                                        <div class="relative flex flex-col items-center">
                                            <span class="absolute -top-6 h-20 w-px bg-gray-500 z-10"></span>
                                            <div
                                                class="w-full flex flex-col bg-gradient-to-r from-green-500 to-green-700 rounded-xl shadow-lg p-5 border-2 border-green-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                                <div class="flex items-center mb-3">
                                                    <div
                                                        class="w-16 h-16 rounded-full bg-white mr-4 overflow-hidden border-2 border-green-300 shadow-inner flex items-center justify-center">
                                                        <svg class="w-10 h-10 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="text-left">
                                                        <div class="text-white font-bold text-md">Direktorat Rehabilitasi
                                                        </div>
                                                        <div class="text-white text-sm">dr. Ratna Dewi, M.Kes</div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-auto text-xs text-white bg-green-800/30 rounded-lg p-2 border border-green-400/30">
                                                    <ul class="list-disc list-inside space-y-1">
                                                        <li>Rehabilitasi Medis</li>
                                                        <li>Rehabilitasi Sosial</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Direktorat Intelijen -->
                                        <div class="relative flex flex-col items-center">
                                            <span class="absolute -top-6 h-20 w-px bg-gray-500 z-10"></span>
                                            <div
                                                class="w-full flex flex-col bg-gradient-to-r from-green-500 to-green-700 rounded-xl shadow-lg p-5 border-2 border-green-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                                <div class="flex items-center mb-3">
                                                    <div
                                                        class="w-16 h-16 rounded-full bg-white mr-4 overflow-hidden border-2 border-green-300 shadow-inner flex items-center justify-center">
                                                        <svg class="w-10 h-10 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="text-left">
                                                        <div class="text-white font-bold text-md">Direktorat Intelijen
                                                        </div>
                                                        <div class="text-white text-sm">AKBP Hendra Suhartiyono, S.I.K.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-auto text-xs text-white bg-green-800/30 rounded-lg p-2 border border-green-400/30">
                                                    <ul class="list-disc list-inside space-y-1">
                                                        <li>Pengumpulan Informasi</li>
                                                        <li>Analisis Jaringan</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- Kepala -->
                                            <div class="relative flex flex-col items-center">
                                                <div
                                                    class="flex items-center bg-gradient-to-r from-red-500 to-red-700 rounded-xl shadow-lg p-5 border-2 border-red-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                                    <div
                                                        class="w-24 h-24 rounded-full bg-white mr-5 overflow-hidden border-2 border-red-300 shadow-inner flex items-center justify-center">
                                                        <svg class="w-14 h-14 text-red-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="text-left">
                                                        <div class="text-white font-bold text-xl mb-1">Kepala BNNP Jatim
                                                        </div>
                                                        <div class="text-white text-md">Brigjen Pol. Dr. H. Slamet Hadi
                                                            Tjahjanto</div>
                                                    </div>
                                                </div>
                                                <!-- garis vertikal ke Sekretaris -->
                                                <div class="h-8 w-px bg-gray-300 mx-auto"></div>
                                            </div>

                                            <!-- Sekretaris -->
                                            <div class="relative flex flex-col items-center">
                                                <div
                                                    class="flex items-center bg-gradient-to-r from-blue-500 to-blue-700 rounded-xl shadow-lg p-5 border-2 border-blue-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                                    <div
                                                        class="w-20 h-20 rounded-full bg-white mr-5 overflow-hidden border-2 border-blue-300 shadow-inner flex items-center justify-center">
                                                        <svg class="w-12 h-12 text-blue-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div class="text-left">
                                                        <div class="text-white font-bold text-lg mb-1">Sekretaris</div>
                                                        <div class="text-white text-md">AKBP Drs. Heru Pranoto, M.Si</div>
                                                    </div>
                                                </div>

                                                <!-- konektor vertikal ke level Direktorat -->
                                                <div class="h-10 w-px bg-gray-300 mx-auto"></div>

                                                <!-- Level Direktorat -->
                                                <div class="relative w-full">
                                                    <!-- garis horizontal (penghubung direktorat) -->
                                                    <div class="absolute inset-x-12 top-0 h-px bg-gray-300 z-0"></div>

                                                    <!-- grid direktorat -->
                                                    <div
                                                        class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 px-4 relative z-10">

                                                        <!-- Direktorat Pencegahan -->
                                                        <div class="relative flex flex-col items-center">
                                                            <!-- garis vertikal dari garis horizontal ke box -->
                                                            <span class="absolute -top-6 h-6 w-px bg-gray-300 z-0"></span>
                                                            <div
                                                                class="w-full flex flex-col bg-gradient-to-r from-green-500 to-green-700 rounded-xl shadow-lg p-5 border-2 border-green-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                                                <div class="flex items-center mb-3">
                                                                    <div
                                                                        class="w-16 h-16 rounded-full bg-white mr-4 overflow-hidden border-2 border-green-300 shadow-inner flex items-center justify-center">
                                                                        <svg class="w-10 h-10 text-green-500"
                                                                            fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="1.5"
                                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="text-left">
                                                                        <div class="text-white font-bold text-md">
                                                                            Direktorat Pencegahan</div>
                                                                        <div class="text-white text-sm">Kompol Dra. Suparti
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="mt-auto text-xs text-white bg-green-800/30 rounded-lg p-2 border border-green-400/30">
                                                                    <ul class="list-disc list-inside space-y-1">
                                                                        <li>Sosialisasi P4GN</li>
                                                                        <li>Edukasi Masyarakat</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Direktorat Pemberantasan -->
                                                        <div class="relative flex flex-col items-center">
                                                            <span class="absolute -top-6 h-6 w-px bg-gray-300 z-0"></span>
                                                            <div
                                                                class="w-full flex flex-col bg-gradient-to-r from-green-500 to-green-700 rounded-xl shadow-lg p-5 border-2 border-green-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                                                <div class="flex items-center mb-3">
                                                                    <div
                                                                        class="w-16 h-16 rounded-full bg-white mr-4 overflow-hidden border-2 border-green-300 shadow-inner flex items-center justify-center">
                                                                        <svg class="w-10 h-10 text-green-500"
                                                                            fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="1.5"
                                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="text-left">
                                                                        <div class="text-white font-bold text-md">
                                                                            Direktorat Pemberantasan</div>
                                                                        <div class="text-white text-sm">AKBP Wisnu Pradana,
                                                                            S.H.</div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="mt-auto text-xs text-white bg-green-800/30 rounded-lg p-2 border border-green-400/30">
                                                                    <ul class="list-disc list-inside space-y-1">
                                                                        <li>Penyelidikan</li>
                                                                        <li>Penyidikan</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Direktorat Rehabilitasi -->
                                                        <div class="relative flex flex-col items-center">
                                                            <span class="absolute -top-6 h-6 w-px bg-gray-300 z-0"></span>
                                                            <div
                                                                class="w-full flex flex-col bg-gradient-to-r from-green-500 to-green-700 rounded-xl shadow-lg p-5 border-2 border-green-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                                                <div class="flex items-center mb-3">
                                                                    <div
                                                                        class="w-16 h-16 rounded-full bg-white mr-4 overflow-hidden border-2 border-green-300 shadow-inner flex items-center justify-center">
                                                                        <svg class="w-10 h-10 text-green-500"
                                                                            fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="1.5"
                                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="text-left">
                                                                        <div class="text-white font-bold text-md">
                                                                            Direktorat Rehabilitasi</div>
                                                                        <div class="text-white text-sm">dr. Ratna Dewi,
                                                                            M.Kes</div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="mt-auto text-xs text-white bg-green-800/30 rounded-lg p-2 border border-green-400/30">
                                                                    <ul class="list-disc list-inside space-y-1">
                                                                        <li>Rehabilitasi Medis</li>
                                                                        <li>Rehabilitasi Sosial</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Direktorat Intelijen -->
                                                        <div class="relative flex flex-col items-center">
                                                            <span class="absolute -top-6 h-6 w-px bg-gray-300 z-0"></span>
                                                            <div
                                                                class="w-full flex flex-col bg-gradient-to-r from-green-500 to-green-700 rounded-xl shadow-lg p-5 border-2 border-green-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                                                <div class="flex items-center mb-3">
                                                                    <div
                                                                        class="w-16 h-16 rounded-full bg-white mr-4 overflow-hidden border-2 border-green-300 shadow-inner flex items-center justify-center">
                                                                        <svg class="w-10 h-10 text-green-500"
                                                                            fill="none" stroke="currentColor"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="1.5"
                                                                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                            </path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="text-left">
                                                                        <div class="text-white font-bold text-md">
                                                                            Direktorat Intelijen</div>
                                                                        <div class="text-white text-sm">AKBP Hendra
                                                                            Suhartiyono, S.I.K.</div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="mt-auto text-xs text-white bg-green-800/30 rounded-lg p-2 border border-green-400/30">
                                                                    <ul class="list-disc list-inside space-y-1">
                                                                        <li>Pengumpulan Informasi</li>
                                                                        <li>Analisis Jaringan</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div {{-- class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-xl p-8 border border-blue-100 overflow-hidden relative mb-12"> --}} </div>
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
                                                        <td
                                                            class="px-6 py-3 text-sm text-gray-900 bg-white text-left border-r">
                                                            {{ $komposisi->keterangan }}</td>
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

                        <!-- Modal Semua Desa -->
                        <div id="allDesaModal"
                            class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
                            <div
                                class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
                                <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                                    <h3 class="text-lg font-semibold text-gray-900">Daftar Semua Desa/Kelurahan Berdasarkan
                                        Jumlah
                                        Kasus</h3>
                                    <button id="closeDesaModal" class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
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
                                                        Desa/Kelurahan</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Kecamatan</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Jumlah Kasus</th>
                                                </tr>
                                            </thead>
                                            <tbody id="allDesaTableBody" class="bg-white divide-y divide-gray-200">
                                                <!-- Data akan diisi oleh JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Semua Kecamatan -->
                        <div id="allKecamatanModal"
                            class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
                            <div
                                class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">
                                <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                                    <h3 class="text-lg font-semibold text-gray-900">Daftar Semua Kecamatan Berdasarkan
                                        Jumlah Kasus
                                    </h3>
                                    <button id="closeKecamatanModal" class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
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
                                                        Jumlah Kasus</th>
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

                    </div>

                    <!-- Galeri Foto Section -->
                    <div
                        class="bg-gradient-to-br from-white to-blue-50 w-full shadow-xl p-8 border border-blue-100 overflow-hidden relative mb-12">
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

                    <!-- Berita Terkini Section -->
                    <div class="mt-12" id="beritaSection">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">Berita Terkini</h2>
                                <p class="text-gray-600">Kumpulan berita dari berbagai sumber eksternal</p>
                            </div>
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
                                <p class="mt-1 text-sm text-gray-500">Belum ada berita tersedia.</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

        </div>

                        </div>

                        @push('scripts')
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                // Data dari controller
                                const kasusPerDesa = @json($kasusPerDesa);
                            const kasusPerKecamatanTkp = @json($kasusPerKecamatanTkp);
                            const kasusPerDesaTkp = @json($kasusPerDesaTkp);
                            const kasusPerKecamatanNik = @json($kasusPerKecamatanNik);
                            const kasusPerDesaNik = @json($kasusPerDesaNik);
                                const statusPie = @json($statusPie);
                                const residivisPie = @json($residivisPie);
                                const trendBulanan = @json($trendBulanan);
                            const jenisKelaminStats = @json($jenisKelaminStats);
                            const umurStats = @json($umurStats);

                            // Grafik Kasus per Kecamatan TKP
                            const ctxKecamatanTkp = document.getElementById('chartKecamatanTkp').getContext('2d');
                            new Chart(ctxKecamatanTkp, {
                                    type: 'bar',
                                    data: {
                                    labels: kasusPerKecamatanTkp.map(item => item.kecamatan),
                                        datasets: [{
                                            label: 'Jumlah Kasus',
                                        data: kasusPerKecamatanTkp.map(item => item.total),
                                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                            borderColor: 'rgba(59, 130, 246, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                            // Grafik Kasus per Desa TKP (Top 10)
                            const ctxDesaTkp = document.getElementById('chartDesaTkp').getContext('2d');
                            new Chart(ctxDesaTkp, {
                                type: 'bar',
                                data: {
                                    labels: kasusPerDesaTkp.map(item => item.desa),
                                    datasets: [{
                                        label: 'Jumlah Kasus',
                                        data: kasusPerDesaTkp.map(item => item.total),
                                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                        borderColor: 'rgba(16, 185, 129, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            tooltip: {
                                                callbacks: {
                                                    title: function(context) {
                                                        const idx = context[0].dataIndex;
                                                    const desa = kasusPerDesaTkp[idx].desa;
                                                    const kecamatan = kasusPerDesaTkp[idx].kecamatan;
                                                        return desa + ' (Kec. ' + kecamatan + ')';
                                                    }
                                                }
                                            },
                                            legend: {
                                                display: false
                                            }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });

                            // Grafik Kasus per Kecamatan NIK
                            const ctxKecamatanNik = document.getElementById('chartKecamatanNik').getContext('2d');
                            new Chart(ctxKecamatanNik, {
                                    type: 'bar',
                                    data: {
                                    labels: kasusPerKecamatanNik.map(item => item.kecamatan),
                                        datasets: [{
                                            label: 'Jumlah Kasus',
                                        data: kasusPerKecamatanNik.map(item => item.total),
                                        backgroundColor: 'rgba(99, 102, 241, 0.8)',
                                        borderColor: 'rgba(99, 102, 241, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    },
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });

                            // Grafik Kasus per Desa NIK (Top 10)
                            const ctxDesaNik = document.getElementById('chartDesaNik').getContext('2d');
                            new Chart(ctxDesaNik, {
                                type: 'bar',
                                data: {
                                    labels: kasusPerDesaNik.map(item => item.kelurahan),
                                    datasets: [{
                                        label: 'Jumlah Kasus',
                                        data: kasusPerDesaNik.map(item => item.total),
                                        backgroundColor: 'rgba(168, 85, 247, 0.8)',
                                        borderColor: 'rgba(168, 85, 247, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        tooltip: {
                                            callbacks: {
                                                title: function(context) {
                                                    const idx = context[0].dataIndex;
                                                    const kelurahan = kasusPerDesaNik[idx].kelurahan;
                                                    const kecamatan = kasusPerDesaNik[idx].kecamatan;
                                                    return kelurahan + ' (Kec. ' + kecamatan + ')';
                                                }
                                            }
                                        },
                                        legend: {
                                            display: false
                                        }
                                    },
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

                            // Gallery data
                            const gallery = @json($galeri ?? []);

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
                                    }
                                });
                            </script>
                        @endpush
                    @endsection
