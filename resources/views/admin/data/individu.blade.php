@extends('layouts.admin-master')

@section('title', 'Data Individu TSK')

@section('content')
    @include('components.admin-navbar')

    <div class="container-fluid mx-auto px-4 py-3">
        <!-- Header Section -->
        <div class="mb-5">
            <h1 class="text-2xl font-semibold text-gray-800 mb-1">Data Individu TSK</h1>
            <p class="text-sm text-gray-500 mb-4">Kelola data individu TSK dengan korelasi kasus narkotika</p>
            <div class="flex flex-col md:flex-row gap-2 md:gap-3 items-start md:items-center">
                <a href="{{ route('admin.data.individu.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Tambah Data
                </a>
                <a href="{{ route('admin.api.individu.export') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
                    <i class="fas fa-download mr-2"></i>Export
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-sm font-medium text-blue-600">Total Individu</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_individu'] ?? 0) }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-sm font-medium text-green-600">Total Kasus</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_kasus'] ?? 0) }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-sm font-medium text-yellow-600">Residivis</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['residivis_count'] ?? 0) }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-sm font-medium text-indigo-600">Non Residivis</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['non_residivis_count'] ?? 0) }}</p>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Filter & Pencarian</h2>
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div>
                    <label for="searchIndividu" class="block text-sm font-medium text-gray-700">Cari Individu</label>
                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="searchIndividu"
                        placeholder="Nama atau NIK...">
                </div>
                <div>
                    <label for="filterKabupaten" class="block text-sm font-medium text-gray-700">Kabupaten</label>
                    <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="filterKabupaten">
                        <option value="">Semua Kabupaten</option>
                        @foreach ($kabupatenList as $kabupaten)
                            <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="filterStatus" class="block text-sm font-medium text-gray-700">Status</label>
                    <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="filterStatus">
                        <option value="">Semua Status</option>
                        <option value="Voluntary">Voluntary (Sukarela)</option>
                        <option value="Compulsory">Compulsory (Upaya Paksa)</option>
                    </select>
                </div>
                <div>
                    <label for="filterPeran" class="block text-sm font-medium text-gray-700">Peran</label>
                    <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="filterPeran">
                        <option value="">Semua Peran</option>
                        <option value="koordinator informan">Koordinator Informan</option>
                        <option value="informan">Informan</option>
                        <option value="kurir">Kurir</option>
                        <option value="gudang">Gudang</option>
                        <option value="bandar">Bandar</option>
                        <option value="Penyalahguna">Penyalahguna</option>
                        <option value="Korban Penyalahguna">Korban Penyalahguna</option>
                        <option value="Pecandu">Pecandu</option>
                        <option value="tidak tahu">Tidak Tahu</option>
                    </select>
                </div>
                <div>
                    <label for="filterResidivis" class="block text-sm font-medium text-gray-700">Residivis</label>
                    <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" id="filterResidivis">
                        <option value="">Semua</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        onclick="applyFilters()">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Data Individu TSK</h2>
                <span class="text-sm text-gray-600">Total: <span id="totalRecords">{{ $sampleData->count() }}</span></span>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama & NIK</th>
                            <th class="px-4 py-2">Alamat</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Peran</th>
                            <th class="px-4 py-2">Residivis</th>
                            <th class="px-4 py-2">Kasus Terkait</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="individuTableBody" class="bg-white divide-y divide-gray-200">
                        @foreach ($sampleData as $index => $individu)
                            <tr>
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">
                                    <div class="font-semibold text-gray-800 uppercase">{{ $individu->nama }}</div>
                                    <div class="text-xs text-gray-500">{{ $individu->nik }}</div>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="text-gray-800">{{ $individu->kelurahan }}, {{ $individu->kecamatan }}
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $individu->kabupaten }}</div>
                                </td>
                                <td class="px-4 py-2">
                                    <span
                                        class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $individu->status === 'Napi' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                        {{ $individu->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <span
                                        class="inline-block px-2 py-1 rounded text-xs font-semibold bg-blue-100 text-blue-700">
                                        {{ $individu->peran_jaringan }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    @if ($individu->residivis)
                                        <span
                                            class="inline-block px-2 py-1 rounded text-xs font-semibold bg-yellow-100 text-yellow-700">Ya</span>
                                    @else
                                        <span
                                            class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-700">Tidak</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if ($individu->status === 'Napi')
                                        <span
                                            class="inline-block px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-700">1
                                            Kasus</span>
                                    @else
                                        <span
                                            class="inline-block px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-700">0
                                            Kasus</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex gap-1 justify-center">
                                        <a href="{{ route('admin.data.individu.show', $individu->id) }}"
                                            class="inline-flex items-center px-2 py-1 text-xs text-blue-600 border border-blue-600 rounded hover:bg-blue-50"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.data.individu.edit', $individu->id) }}"
                                            class="inline-flex items-center px-2 py-1 text-xs text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-50"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.data.individu.destroy', $individu->id) }}"
                                            method="POST" onsubmit="return confirmDelete(event)" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex justify-between items-center mt-4">
                <div class="text-sm text-gray-500">
                    Menampilkan {{ $sampleData->count() }} dari {{ $stats['total_individu'] ?? 0 }} data
                </div>
                <nav aria-label="Page navigation">
                    <ul class="inline-flex -space-x-px">
                        <li><span class="px-3 py-1 rounded-l bg-gray-200 text-gray-500">Previous</span></li>
                        <li><span class="px-3 py-1 bg-blue-600 text-white">1</span></li>
                        <li><span class="px-3 py-1 rounded-r bg-gray-200 text-gray-500">Next</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    {{-- <div class="modal fade" id="deleteModal" tabindex="-1">
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
    </div> --}}

    <script>
        // Data individu dari server
        const individuList = @json($sampleData);
        const perPage = 20;
        let currentPage = 1;

        function renderTable(data) {
            const tbody = document.getElementById('individuTableBody');
            tbody.innerHTML = '';
            const start = (currentPage - 1) * perPage;
            const end = start + perPage;
            const pageData = data.slice(start, end);
            pageData.forEach((individu, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td class="px-4 py-2">${start + index + 1}</td>
            <td class="px-4 py-2">
                <div class="font-semibold text-gray-800">${individu.nama}</div>
                <div class="text-xs text-gray-500">${individu.nik}</div>
            </td>
            <td class="px-4 py-2">
                <div class="text-gray-800">${individu.kelurahan}, ${individu.kecamatan}</div>
                <div class="text-xs text-gray-500">${individu.kabupaten}</div>
            </td>
            <td class="px-4 py-2">
                <span class="inline-block px-2 py-1 rounded text-xs font-semibold ${individu.status === 'Napi' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}">
                    ${individu.status}
                </span>
            </td>
            <td class="px-4 py-2">
                <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-blue-100 text-blue-700">
                    ${individu.peran_jaringan}
                </span>
            </td>
            <td class="px-4 py-2">
                ${individu.residivis ?
                    '<span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-yellow-100 text-yellow-700">Ya</span>' :
                    '<span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-700">Tidak</span>'
                }
            </td>
            <td class="px-4 py-2">
                ${individu.status === 'Napi' ?
                    '<span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-700">1 Kasus</span>' :
                    '<span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-700">0 Kasus</span>'
                }
            </td>
            <td class="px-4 py-2 text-center">
                <div class="flex gap-1 justify-center">
                    <a href="{{ route('admin.data.individu.show', $individu->id) }}"
                        class="inline-flex items-center px-2 py-1 text-xs text-blue-600 border border-blue-600 rounded hover:bg-blue-50"
                        title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.data.individu.edit', $individu->id) }}"
                        class="inline-flex items-center px-2 py-1 text-xs text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-50"
                        title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
            </td>
        `;
                tbody.appendChild(row);
            });
            document.getElementById('totalRecords').textContent = `${data.length}`;
            document.getElementById('prevPageBtn').disabled = currentPage === 1;
            document.getElementById('nextPageBtn').disabled = end >= data.length;
        }

        document.getElementById('prevPageBtn').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderTable(individuList);
            }
        });
        document.getElementById('nextPageBtn').addEventListener('click', function() {
            if ((currentPage * perPage) < individuList.length) {
                currentPage++;
                renderTable(individuList);
            }
        });

        // Inisialisasi tombol pagination di bawah tabel
        document.querySelector('.flex.justify-between.items-center.mt-4').insertAdjacentHTML('beforeend', `
    <div class="flex gap-2 ml-4">
        <button id="prevPageBtn" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300" disabled>Previous</button>
        <button id="nextPageBtn" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Next</button>
    </div>
`);

        renderTable(individuList);

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

            fetch(`/admin/api/individu-data?${params}`)
                .then(response => response.json())
                .then(data => {
                    renderTable(data.data);
                })
                .catch(error => {
                    console.error('Error loading data:', error);
                });
        }

        // Apply filters
        function applyFilters() {
            loadData();
        }

        // Delete individu
        function deleteIndividu(id) {
            console.log('deleteIndividu called', id);
            const modalEl = document.getElementById('deleteModal');
            if (!modalEl) {
                alert('Modal not found!');
                return;
            }
            const modal = new bootstrap.Modal(modalEl);
            const form = document.getElementById('deleteForm');
            form.action = "{{ route('admin.data.individu.destroy', ':id') }}".replace(':id', id);
            modal.show();
            $('#deleteModal').modal('show');
        }

        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form untuk langsung submit

            // SweetAlert2 Confirmation Popup
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "User ini akan dihapus secara permanen!",
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
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch kabupaten list from API
            fetch('/api/kabupaten-list')
                .then(response => response.json())
                .then(data => {
                    const kabupatenSelect = document.getElementById('filterKabupaten');
                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                    data.forEach(kab => {
                        const option = document.createElement('option');
                        option.value = kab;
                        option.textContent = kab;
                        kabupatenSelect.appendChild(option);
                    });
                });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
