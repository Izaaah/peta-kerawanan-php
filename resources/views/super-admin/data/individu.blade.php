@extends('layouts.superadmin-master')

@section('title', 'Data Individu TSK')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4 py-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 mb-1 text-gray-800 fw-bold">Data Individu TSK</h1>
            <p class="text-muted mb-0 fs-6">Kelola data individu TSK dengan korelasi kasus narkotika</p>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('super-admin.data.individu.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                <span>Tambah Data</span>
            </a>
            <a href="{{ route('super-admin.api.individu.export') }}" class="btn btn-success d-flex align-items-center gap-2">
                <i class="fas fa-download"></i>
                <span>Export</span>
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 fw-semibold">Total Individu</h6>
                            <h3 class="mb-0 fw-bold text-gray-800">{{ number_format($stats['total_individu'] ?? 0) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-clipboard-list fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 fw-semibold">Total Kasus</h6>
                            <h3 class="mb-0 fw-bold text-gray-800">{{ number_format($stats['total_kasus'] ?? 0) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 fw-semibold">Residivis</h6>
                            <h3 class="mb-0 fw-bold text-gray-800">{{ number_format($stats['residivis_count'] ?? 0) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-user-check fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 fw-semibold">Non Residivis</h6>
                            <h3 class="mb-0 fw-bold text-gray-800">{{ number_format($stats['non_residivis_count'] ?? 0) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 py-3">
            <h6 class="mb-0 fw-bold text-gray-800">
                <i class="fas fa-filter me-2 text-primary"></i>
                Filter & Pencarian
            </h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-3 col-md-6">
                    <label for="searchIndividu" class="form-label fw-semibold">Cari Individu</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0" id="searchIndividu" placeholder="Nama atau NIK...">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label for="filterKabupaten" class="form-label fw-semibold">Kabupaten</label>
                    <select class="form-select" id="filterKabupaten">
                        <option value="">Semua Kabupaten</option>
                        @foreach($kabupatenList as $kabupaten)
                            <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label for="filterStatus" class="form-label fw-semibold">Status</label>
                    <select class="form-select" id="filterStatus">
                        <option value="">Semua Status</option>
                        <option value="Napi">Napi</option>
                        <option value="Non napi">Non napi</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label for="filterPeran" class="form-label fw-semibold">Peran</label>
                    <select class="form-select" id="filterPeran">
                        <option value="">Semua Peran</option>
                        <option value="koordinator informan">Koordinator Informan</option>
                        <option value="informan">Informan</option>
                        <option value="kurir">Kurir</option>
                        <option value="gudang">Gudang</option>
                        <option value="broker">Broker</option>
                        <option value="bandar">Bandar</option>
                        <option value="beking">Beking</option>
                        <option value="tidak tahu">Tidak Tahu</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <label for="filterResidivis" class="form-label fw-semibold">Residivis</label>
                    <select class="form-select" id="filterResidivis">
                        <option value="">Semua</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="col-lg-1 col-md-6">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-center" onclick="applyFilters()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table Section -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-gray-800">
                    <i class="fas fa-table me-2 text-primary"></i>
                    Data Individu TSK
                </h6>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary rounded-pill px-3 py-2" id="totalRecords">
                        {{ $sampleData->count() }} Data
                    </span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="individuTable">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 px-4 py-3 fw-semibold text-gray-700">No</th>
                            <th class="border-0 px-4 py-3 fw-semibold text-gray-700">Nama & NIK</th>
                            <th class="border-0 px-4 py-3 fw-semibold text-gray-700">Alamat</th>
                            <th class="border-0 px-4 py-3 fw-semibold text-gray-700">Status</th>
                            <th class="border-0 px-4 py-3 fw-semibold text-gray-700">Peran</th>
                            <th class="border-0 px-4 py-3 fw-semibold text-gray-700">Residivis</th>
                            <th class="border-0 px-4 py-3 fw-semibold text-gray-700">Kasus Terkait</th>
                            <th class="border-0 px-4 py-3 fw-semibold text-gray-700 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="individuTableBody">
                        @foreach($sampleData as $index => $individu)
                        <tr class="border-bottom">
                            <td class="px-4 py-3 text-gray-600">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-gray-800">{{ $individu->nama }}</div>
                                        <small class="text-muted">{{ $individu->nik }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-gray-800">{{ $individu->kelurahan }}, {{ $individu->kecamatan }}</div>
                                <small class="text-muted">{{ $individu->kabupaten }}</small>
                            </td>
                            <td class="px-4 py-3">
                                <span class="badge rounded-pill px-3 py-2 {{ $individu->status === 'Napi' ? 'bg-danger bg-opacity-10 text-danger' : 'bg-success bg-opacity-10 text-success' }}">
                                    <i class="fas fa-circle me-1"></i>
                                    {{ $individu->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                                    {{ $individu->peran_jaringan }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if($individu->residivis)
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        Ya
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">
                                        <i class="fas fa-check me-1"></i>
                                        Tidak
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($individu->status === 'Napi')
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                                        <i class="fas fa-file-alt me-1"></i>
                                        1 Kasus
                                    </span>
                                @else
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i>
                                        0 Kasus
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('super-admin.data.individu.show', $individu->id) }}"
                                       class="btn btn-sm btn-outline-info border-0" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('super-admin.data.individu.edit', $individu->id) }}"
                                       class="btn btn-sm btn-outline-warning border-0" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger border-0"
                                            onclick="deleteIndividu({{ $individu->id }})" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center p-4 border-top">
                <div class="text-muted">
                    Menampilkan {{ $sampleData->count() }} dari {{ $stats['total_individu'] ?? 0 }} data
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <span class="page-link border-0">Previous</span>
                        </li>
                        <li class="page-item active">
                            <span class="page-link border-0 bg-primary">1</span>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link border-0">Next</span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 bg-danger text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                        <i class="fas fa-trash fa-2x text-danger"></i>
                    </div>
                    <h6 class="fw-bold text-gray-800">Hapus Data Individu TSK?</h6>
                    <p class="text-muted mb-0">Data yang dihapus tidak dapat dikembalikan!</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Load data from API
function loadData() {
    const searchTerm = document.getElementById('searchIndividu').value;
    const kabupaten = document.getElementById('filterKabupaten').value;
    const status = document.getElementById('filterStatus').value;
    const peran = document.getElementById('filterPeran').value;
    const residivis = document.getElementById('filterResidivis').value;

    const params = new URLSearchParams();
    if (searchTerm) params.append('search', searchTerm);
    if (kabupaten) params.append('kabupaten', kabupaten);
    if (status) params.append('status', status);
    if (peran) params.append('peran_jaringan', peran);
    if (residivis) params.append('residivis', residivis);

    fetch(`/super-admin/api/individu-data?${params}`)
        .then(response => response.json())
        .then(data => {
            renderTable(data.data);
        })
        .catch(error => {
            console.error('Error loading data:', error);
        });
}

// Render table
function renderTable(data) {
    const tbody = document.getElementById('individuTableBody');
    tbody.innerHTML = '';

    data.forEach((individu, index) => {
        const row = document.createElement('tr');
        row.className = 'border-bottom';
        row.innerHTML = `
            <td class="px-4 py-3 text-gray-600">${index + 1}</td>
            <td class="px-4 py-3">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <div>
                        <div class="fw-semibold text-gray-800">${individu.nama}</div>
                        <small class="text-muted">${individu.nik}</small>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3">
                <div class="text-gray-800">${individu.kelurahan}, ${individu.kecamatan}</div>
                <small class="text-muted">${individu.kabupaten}</small>
            </td>
            <td class="px-4 py-3">
                <span class="badge rounded-pill px-3 py-2 ${individu.status === 'Napi' ? 'bg-danger bg-opacity-10 text-danger' : 'bg-success bg-opacity-10 text-success'}">
                    <i class="fas fa-circle me-1"></i>
                    ${individu.status}
                </span>
            </td>
            <td class="px-4 py-3">
                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">
                    ${individu.peran_jaringan}
                </span>
            </td>
            <td class="px-4 py-3">
                ${individu.residivis ?
                    '<span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2"><i class="fas fa-exclamation-triangle me-1"></i>Ya</span>' :
                    '<span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2"><i class="fas fa-check me-1"></i>Tidak</span>'
                }
            </td>
            <td class="px-4 py-3">
                ${individu.status === 'Napi' ?
                    '<span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2"><i class="fas fa-file-alt me-1"></i>1 Kasus</span>' :
                    '<span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2"><i class="fas fa-check-circle me-1"></i>0 Kasus</span>'
                }
            </td>
            <td class="px-4 py-3 text-center">
                <div class="btn-group" role="group">
                    <a href="/super-admin/data-individu/${individu.id}" class="btn btn-sm btn-outline-info border-0" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="/super-admin/data-individu/${individu.id}/edit" class="btn btn-sm btn-outline-warning border-0" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger border-0" onclick="deleteIndividu(${individu.id})" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });

    document.getElementById('totalRecords').textContent = `${data.length} Data`;
}

// Apply filters
function applyFilters() {
    loadData();
}

// Delete individu
function deleteIndividu(id) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const form = document.getElementById('deleteForm');
    form.action = `/super-admin/data-individu/${id}`;
    modal.show();
}
</script>
@endsection
