@extends('layouts.superadmin-master')

@section('title', 'Data Desa Geojson')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4 py-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Data Desa Geojson</h1>
            <p class="text-muted mb-0">Kelola data desa dan tingkat kerawanan</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary" onclick="refreshData()">
                <i class="fas fa-sync-alt me-2"></i>Refresh
            </button>
            <a href="{{ route('super-admin.api.desa.export') }}" class="btn btn-success">
                <i class="fas fa-download me-2"></i>Export
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Desa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_desa'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Desa dengan Kasus</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['desa_dengan_kasus'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Kasus</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_kasus'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Kabupaten</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['kabupaten_count'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter & Pencarian</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="searchDesa" class="form-label">Cari Desa</label>
                    <input type="text" class="form-control" id="searchDesa" placeholder="Nama desa...">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="filterKabupaten" class="form-label">Kabupaten</label>
                    <select class="form-select" id="filterKabupaten">
                        <option value="">Semua Kabupaten</option>
                        @foreach($kabupatenList as $kabupaten)
                            <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="filterKerawanan" class="form-label">Tingkat Kerawanan</label>
                    <select class="form-select" id="filterKerawanan">
                        <option value="">Semua Level</option>
                        <option value="Rendah">Rendah</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sangat Tinggi">Sangat Tinggi</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-primary w-100" onclick="applyFilters()">
                        <i class="fas fa-search me-2"></i>Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Desa</h6>
            <div class="d-flex gap-2">
                <span class="badge bg-primary" id="totalRecords">0</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="desaTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Desa</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten</th>
                            <th>Jumlah Kasus</th>
                            <th>Tingkat Kerawanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="desaTableBody">
                        @foreach($sampleDesa as $index => $desa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $desa->nama_desa }}</td>
                            <td>{{ $desa->kecamatan }}</td>
                            <td>{{ $desa->kabupaten }}</td>
                            <td>
                                <span class="badge bg-{{ $desa->kasus_narkoba_count > 0 ? 'danger' : 'success' }}">
                                    {{ $desa->kasus_narkoba_count }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $desa->kerawanan_level === 'Rendah' ? 'success' : ($desa->kerawanan_level === 'Sedang' ? 'warning' : ($desa->kerawanan_level === 'Tinggi' ? 'danger' : 'dark')) }}">
                                    {{ $desa->kerawanan_level }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick="showDetail({{ $desa->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-primary" onclick="viewOnMap({{ $desa->id }})">
                                    <i class="fas fa-map-marker-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Menampilkan {{ $sampleDesa->count() }} dari {{ $stats['total_desa'] ?? 0 }} data
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item active">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link">Next</span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="desaDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Desa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="desaDetailContent">
                <!-- Detail content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
// Load data from API
function loadData() {
    const searchTerm = document.getElementById('searchDesa').value;
    const kabupaten = document.getElementById('filterKabupaten').value;
    const kerawanan = document.getElementById('filterKerawanan').value;

    const params = new URLSearchParams();
    if (searchTerm) params.append('search', searchTerm);
    if (kabupaten) params.append('kabupaten', kabupaten);
    if (kerawanan) params.append('kerawanan', kerawanan);

    fetch(`/super-admin/api/desa-data?${params}`)
        .then(response => response.json())
        .then(data => {
            renderTable(data.data);
            // updatePagination(data); // Disabled for now
        })
        .catch(error => {
            console.error('Error loading data:', error);
        });
}

// Render table
function renderTable(data) {
    const tbody = document.getElementById('desaTableBody');
    tbody.innerHTML = '';

    data.forEach((desa, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${desa.nama_desa}</td>
            <td>${desa.kecamatan}</td>
            <td>${desa.kabupaten}</td>
            <td>
                <span class="badge bg-${desa.kasus_narkoba_count > 0 ? 'danger' : 'success'}">
                    ${desa.kasus_narkoba_count}
                </span>
            </td>
            <td>
                <span class="badge bg-${getKerawananColor(desa.kerawanan_level)}">
                    ${desa.kerawanan_level}
                </span>
            </td>
            <td>
                <button class="btn btn-sm btn-info" onclick="showDetail(${desa.id})">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn btn-sm btn-primary" onclick="viewOnMap(${desa.id})">
                    <i class="fas fa-map-marker-alt"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });

    document.getElementById('totalRecords').textContent = data.length;
}

// Get kerawanan color
function getKerawananColor(level) {
    switch(level) {
        case 'Rendah': return 'success';
        case 'Sedang': return 'warning';
        case 'Tinggi': return 'danger';
        case 'Sangat Tinggi': return 'dark';
        default: return 'secondary';
    }
}

// Apply filters
function applyFilters() {
    loadData();
}

// Show detail
function showDetail(id) {
    fetch(`/super-admin/api/desa-detail/${id}`)
        .then(response => response.json())
        .then(data => {
            const modal = new bootstrap.Modal(document.getElementById('desaDetailModal'));
            document.getElementById('desaDetailContent').innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Desa</h6>
                        <p><strong>Nama Desa:</strong> ${data.desa.nama_desa}</p>
                        <p><strong>Kecamatan:</strong> ${data.desa.kecamatan}</p>
                        <p><strong>Kabupaten:</strong> ${data.desa.kabupaten}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Statistik Kasus</h6>
                        <p><strong>Jumlah Kasus:</strong> ${data.stats.total_kasus}</p>
                        <p><strong>Tingkat Kerawanan:</strong>
                            <span class="badge bg-${getKerawananColor(data.stats.kerawanan_level)}">
                                ${data.stats.kerawanan_level}
                            </span>
                        </p>
                    </div>
                </div>
            `;
            modal.show();
        })
        .catch(error => {
            console.error('Error loading detail:', error);
        });
}

// View on map
function viewOnMap(id) {
    window.open(`{{ route('peta-penyalahgunaan.domisili') }}?desa=${id}`, '_blank');
}

// Refresh data
function refreshData() {
    location.reload();
}
</script>
@endsection
