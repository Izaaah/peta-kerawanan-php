@extends('layouts.superadmin-master')

@section('content')
@include('components.superadmin-navbar')

<div class="container mx-auto">
    <!-- Statistik Cards -->
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
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kasus per Kabupaten</h3>
                <canvas id="chartKabupaten" width="400" height="200"></canvas>
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

        <!-- Status Kasus -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Kasus</h3>
                <canvas id="chartStatus" width="400" height="200"></canvas>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data dari controller
const kasusPerKabupaten = @json($kasusPerKabupaten);
const kasusPerKecamatan = @json($kasusPerKecamatan);
const trendBulanan = @json($trendBulanan);
const statusKasus = @json($statusKasus);

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

// Grafik Status Kasus
const ctxStatus = document.getElementById('chartStatus').getContext('2d');
new Chart(ctxStatus, {
    type: 'doughnut',
    data: {
        labels: Object.keys(statusKasus),
        datasets: [{
            data: Object.values(statusKasus),
            backgroundColor: [
                'rgba(239, 68, 68, 0.8)',
                'rgba(34, 197, 94, 0.8)',
                'rgba(59, 130, 246, 0.8)'
            ],
            borderColor: [
                'rgba(239, 68, 68, 1)',
                'rgba(34, 197, 94, 1)',
                'rgba(59, 130, 246, 1)'
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
</script>
@endpush
@endsection
