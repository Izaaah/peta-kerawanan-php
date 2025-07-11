@extends('layouts.superadmin-master')

@section('title', 'Data Individu TSK')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4 py-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Data Individu TSK</h1>
            <p class="text-muted mb-0">Kelola data individu TSK dengan korelasi kasus</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('super-admin.data.individu.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Data
            </a>
            <a href="{{ route('super-admin.api.individu.export') }}" class="btn btn-success">
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
                                Total Individu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_individu'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                Residivis</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['residivis_count'] ?? 0 }}</div>
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
                                Non Residivis</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['non_residivis_count'] ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
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
                <div class="col-md-3 mb-3">
                    <label for="searchIndividu" class="form-label">Cari Individu</label>
                    <input type="text" class="form-control" id="searchIndividu" placeholder="Nama atau NIK...">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="filterKabupaten" class="form-label">Kabupaten</label>
                    <select class="form-select" id="filterKabupaten">
                        <option value="">Semua</option>
                        @foreach($kabupatenList as $kabupaten)
                            <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="filterStatus" class="form-label">Status</label>
                    <select class="form-select" id="filterStatus">
                        <option value="">Semua</option>
                        <option value="Napi">Napi</option>
                        <option value="Non napi">Non napi</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="filterPeran" class="form-label">Peran</label>
                    <select class="form-select" id="filterPeran">
                        <option value="">Semua</option>
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
                <div class="col-md-2 mb-3">
                    <label for="filterResidivis" class="form-label">Residivis</label>
                    <select class="form-select" id="filterResidivis">
                        <option value="">Semua</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="col-md-1 mb-3">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-primary w-100" onclick="applyFilters()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Individu TSK</h6>
            <div class="d-flex gap-2">
                <span class="badge bg-primary" id="totalRecords">{{ $sampleData->count() }}</span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="individuTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Peran</th>
                            <th>Residivis</th>
                            <th>Kasus Terkait</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="individuTableBody">
                        @foreach($sampleData as $index => $individu)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold">{{ $individu->nama }}</div>
                                <small class="text-muted">{{ $individu->nik }}</small>
                            </td>
                            <td>{{ $individu->nik }}</td>
                            <td>
                                <div>{{ $individu->kelurahan }}, {{ $individu->kecamatan }}</div>
                                <small class="text-muted">{{ $individu->kabupaten }}</small>
                            </td>
                            <td>
                                <span class="badge bg-{{ $individu->status === 'Napi' ? 'danger' : 'success' }}">
                                    {{ $individu->status }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $individu->peran_jaringan }}</span>
                            </td>
                            <td>
                                @if($individu->residivis)
                                    <span class="badge bg-warning">Ya</span>
                                @else
                                    <span class="badge bg-secondary">Tidak</span>
                                @endif
                            </td>
                            <td>
                                @if($individu->status === 'Napi')
                                    <span class="badge bg-danger">1 Kasus</span>
                                @else
                                    <span class="badge bg-success">0 Kasus</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('super-admin.data.individu.show', $individu->id) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('super-admin.data.individu.edit', $individu->id) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger"
                                            onclick="deleteIndividu({{ $individu->id }})">
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
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Menampilkan {{ $sampleData->count() }} dari {{ $stats['total_individu'] ?? 0 }} data
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data individu TSK ini?</p>
                <p class="text-danger">Data yang dihapus tidak dapat dikembalikan!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
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
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>
                <div class="fw-bold">${individu.nama}</div>
                <small class="text-muted">${individu.nik}</small>
            </td>
            <td>${individu.nik}</td>
            <td>
                <div>${individu.kelurahan}, ${individu.kecamatan}</div>
                <small class="text-muted">${individu.kabupaten}</small>
            </td>
            <td>
                <span class="badge bg-${individu.status === 'Napi' ? 'danger' : 'success'}">
                    ${individu.status}
                </span>
            </td>
            <td>
                <span class="badge bg-info">${individu.peran_jaringan}</span>
            </td>
            <td>
                ${individu.residivis ?
                    '<span class="badge bg-warning">Ya</span>' :
                    '<span class="badge bg-secondary">Tidak</span>'
                }
            </td>
            <td>
                ${individu.status === 'Napi' ?
                    '<span class="badge bg-danger">1 Kasus</span>' :
                    '<span class="badge bg-success">0 Kasus</span>'
                }
            </td>
            <td>
                <div class="btn-group" role="group">
                    <a href="/super-admin/data-individu/${individu.id}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="/super-admin/data-individu/${individu.id}/edit" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger" onclick="deleteIndividu(${individu.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });

    document.getElementById('totalRecords').textContent = data.length;
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
