@extends('layouts.admin-master')

@section('content')
@include('components.admin-navbar')

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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
            <!-- Grafik Kasus per Desa (Top 10) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Kasus per Desa (Top 10)</h3>
                    <canvas id="chartDesa" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Grafik Kasus per Kecamatan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Kasus per Kecamatan</h3>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($kasusTerbaru as $kasus)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $kasus->desa }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kasus->kecamatan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kasus->kabupaten }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kasus->lokasi ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kasus->created_at ? $kasus->created_at->format('d/m/Y') : '-' }}</td>
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

    <!-- Konten Profil Organisasi -->
    <div id="profilContent" class="dashboard-content hidden">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <img src="{{ asset('storage/img/logo.png') }}" alt="Logo BNN" class="w-24 h-24 mx-auto mb-4">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Badan Narkotika Nasional</h2>
                <h3 class="text-xl text-gray-600">Provinsi Jawa Timur</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Visi & Misi -->
                <div class="space-y-6">
                    <div class="bg-blue-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-blue-900 mb-3">Visi</h4>
                        <p class="text-blue-800">"Terwujudnya Indonesia yang bebas dari penyalahgunaan dan peredaran gelap narkotika dan prekursor narkotika"</p>
                    </div>

                    <div class="bg-green-50 rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-green-900 mb-3">Misi</h4>
                        <ul class="text-green-800 space-y-2">
                            <li>• Melaksanakan pencegahan dan pemberantasan penyalahgunaan dan peredaran gelap narkotika</li>
                            <li>• Melaksanakan rehabilitasi medis dan sosial bagi penyalahguna narkotika</li>
                            <li>• Melaksanakan kerjasama internasional dalam pencegahan dan pemberantasan narkotika</li>
                        </ul>
                    </div>
                </div>

                <!-- Struktur Organisasi -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Struktur Organisasi</h4>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-gray-700">Kepala BNNP Jatim</span>
                        </div>
                        <div class="flex items-center space-x-3 ml-4">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-600">Sekretaris</span>
                        </div>
                        <div class="flex items-center space-x-3 ml-4">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-600">Direktorat Pencegahan</span>
                        </div>
                        <div class="flex items-center space-x-3 ml-4">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-600">Direktorat Pemberantasan</span>
                        </div>
                        <div class="flex items-center space-x-3 ml-4">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-600">Direktorat Rehabilitasi</span>
                        </div>
                        <div class="flex items-center space-x-3 ml-4">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-gray-600">Direktorat Intelijen</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Kontak -->
            <div class="mt-8 bg-gradient-to-r from-red-600 to-red-700 rounded-lg p-6 text-white">
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
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data dari controller
const kasusPerDesa = @json($kasusPerDesa);
const kasusPerKecamatan = @json($kasusPerKecamatan);
const statusPie = @json($statusPie);
const residivisPie = @json($residivisPie);
const trendBulanan = @json($trendBulanan);

// Grafik Kasus per Desa (Top 10)
const ctxDesa = document.getElementById('chartDesa').getContext('2d');
new Chart(ctxDesa, {
    type: 'bar',
    data: {
        labels: kasusPerDesa.map(item => item.desa),
        datasets: [{
            label: 'Jumlah Kasus',
            data: kasusPerDesa.map(item => item.total),
            backgroundColor: 'rgba(59, 130, 246, 0.8)',
            borderColor: 'rgba(59, 130, 246, 1)',
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
                        const desa = kasusPerDesa[idx].desa;
                        const kecamatan = kasusPerDesa[idx].kecamatan;
                        return desa + ' (Kec. ' + kecamatan + ')';
                    }
                }
            },
            legend: { display: false }
        },
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

// JavaScript untuk toggle konten dashboard
document.addEventListener('DOMContentLoaded', function() {
    const statistikTab = document.getElementById('statistikTab');
    const profilTab = document.getElementById('profilTab');
    const statistikContent = document.getElementById('statistikContent');
    const profilContent = document.getElementById('profilContent');

    // Default tampilkan statistik
    statistikContent.classList.remove('hidden');
    profilContent.classList.add('hidden');

    // Event listener untuk pilihan Statistik
    statistikTab.addEventListener('click', function() {
        statistikContent.classList.remove('hidden');
        profilContent.classList.add('hidden');

        // Update active state
        statistikTab.classList.remove('inactive');
        statistikTab.classList.add('active');
        profilTab.classList.remove('active');
        profilTab.classList.add('inactive');

        // Update icons and text colors
        statistikTab.querySelector('svg').classList.remove('text-gray-500');
        statistikTab.querySelector('svg').classList.add('text-blue-600');
        statistikTab.querySelector('span').classList.remove('text-gray-700');
        statistikTab.querySelector('span').classList.add('text-blue-600');

        profilTab.querySelector('svg').classList.remove('text-blue-600');
        profilTab.querySelector('svg').classList.add('text-gray-500');
        profilTab.querySelector('span').classList.remove('text-blue-600');
        profilTab.querySelector('span').classList.add('text-gray-700');
    });

    // Event listener untuk pilihan Profil Organisasi
    profilTab.addEventListener('click', function() {
        profilContent.classList.remove('hidden');
        statistikContent.classList.add('hidden');

        // Update active state
        profilTab.classList.remove('inactive');
        profilTab.classList.add('active');
        statistikTab.classList.remove('active');
        statistikTab.classList.add('inactive');

        // Update icons and text colors
        profilTab.querySelector('svg').classList.remove('text-gray-500');
        profilTab.querySelector('svg').classList.add('text-blue-600');
        profilTab.querySelector('span').classList.remove('text-gray-700');
        profilTab.querySelector('span').classList.add('text-blue-600');

        statistikTab.querySelector('svg').classList.remove('text-blue-600');
        statistikTab.querySelector('svg').classList.add('text-gray-500');
        statistikTab.querySelector('span').classList.remove('text-blue-600');
        statistikTab.querySelector('span').classList.add('text-gray-700');
    });
});
</script>
@endpush
@endsection
