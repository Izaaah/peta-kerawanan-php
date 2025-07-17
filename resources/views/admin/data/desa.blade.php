@extends('layouts.superadmin-master')

@section('title', 'Data Desa Geojson')

@section('content')
@include('components.superadmin-navbar')

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl font-semibold text-gray-800">Data Desa/Kelurahan</h1>
            <p class="text-sm text-gray-500">Kelola data desa dan tingkat kerawanan</p>
        </div>
        <div class="flex gap-2">
            <button class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 border border-blue-600 rounded hover:bg-blue-50" onclick="refreshData()">
                <i class="fas fa-sync-alt mr-2"></i>Refresh
            </button>
            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
                <i class="fas fa-download mr-2"></i>Export
            </a>
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white shadow rounded-lg p-4">
            <p class="text-sm font-medium text-blue-600">Total Desa/Kelurahan</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_desa'] ?? 0 }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <p class="text-sm font-medium text-green-600">Desa/Kelurahan dengan Kasus</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['desa_dengan_kasus'] ?? 0 }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <p class="text-sm font-medium text-indigo-600">Total Kasus</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_kasus'] ?? 0 }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <p class="text-sm font-medium text-yellow-600">Kabupaten/Kota</p>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['kabupaten_count'] ?? 0 }}</p>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Filter & Pencarian</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Cari Desa/Kelurahan</label>
                <input type="text" id="searchDesa" placeholder="Nama desa..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                <select id="filterKabupaten" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua Kabupaten/Kota</option>
                    @foreach($kabupatenList as $kabupaten)
                        <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tingkat Kerawanan</label>
                <select id="filterKerawanan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua Level</option>
                    <option value="Rendah">Rendah</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Tinggi">Tinggi</option>
                    <option value="Sangat Tinggi">Sangat Tinggi</option>
                </select>
            </div>
            <div class="flex items-end">
                <button onclick="applyFilters()" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Tabel -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-700">Data Desa/Kelurahan</h2>
            <span class="text-sm text-gray-600">Total: <span id="totalRecords">{{ $desaList->count() }}</span></span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama Desa/Kelurahan</th>
                        <th class="px-4 py-2">Kecamatan</th>
                        <th class="px-4 py-2">Kabupaten/Kota</th>
                        <th class="px-4 py-2">Jumlah Kasus</th>
                    </tr>
                </thead>
                <tbody id="desaTableBody" class="bg-white divide-y divide-gray-200">
                    <!-- Tabel akan diisi oleh JS -->
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mt-4 gap-2">
            <button id="prevPageBtn" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300" disabled>Previous</button>
            <button id="nextPageBtn" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Next</button>
        </div>
    </div>
</div>

<script>
const desaList = @json($desaList);
const perPage = 20;
let currentPage = 1;

function renderDesaTable() {
    const tbody = document.getElementById('desaTableBody');
    tbody.innerHTML = '';
    const start = (currentPage - 1) * perPage;
    const end = start + perPage;
    const pageData = desaList.slice(start, end);
    pageData.forEach((desa, index) => {
        const kasusCount = desa.kasus_narkoba_count ?? 0;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="px-4 py-2">${start + index + 1}</td>
            <td class="px-4 py-2">${desa.nama_desa}</td>
            <td class="px-4 py-2">${desa.kecamatan}</td>
            <td class="px-4 py-2">${desa.kabupaten}</td>
            <td class="px-4 py-2">
                <span class="px-2 py-1 rounded text-white text-xs bg-${kasusCount > 0 ? 'red-600' : 'green-600'}">
                    ${kasusCount}
                </span>
            </td>
        `;
        tbody.appendChild(row);
    });
    document.getElementById('prevPageBtn').disabled = currentPage === 1;
    document.getElementById('nextPageBtn').disabled = end >= desaList.length;
}

document.getElementById('prevPageBtn').addEventListener('click', function() {
    if (currentPage > 1) {
        currentPage--;
        renderDesaTable();
    }
});
document.getElementById('nextPageBtn').addEventListener('click', function() {
    if ((currentPage * perPage) < desaList.length) {
        currentPage++;
        renderDesaTable();
    }
});

// Preprocess kasus count (karena $desa->kasusNarkoba()->count() tidak bisa diakses di JS)
desaList.forEach(desa => {
    desa.kasus_narkoba_count = desa.kasus_narkoba_count ?? (desa.kasus_narkoba_count = desa.kasusNarkoba_count || 0);
});

renderDesaTable();
</script>
@endsection
