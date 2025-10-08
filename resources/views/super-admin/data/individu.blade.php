@extends('layouts.superadmin-master')

@section('title', 'Data Individu Tersangka')

@section('content')
    @include('components.superadmin-navbar')

    <div class="container-fluid px-4 py-3">
        <!-- Header Section -->
        <div class="mb-5">
            <h1 class="text-2xl font-semibold text-gray-800 mb-1">Data Individu Tersangka</h1>
            <p class="text-sm text-gray-500 mb-4">Kelola data individu Tersangka dengan korelasi kasus narkotika</p>
            <div class="flex flex-col md:flex-row gap-2 md:gap-3 items-start md:items-center">
                {{-- <a href="{{ route('super-admin.data.individu.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Tambah Data
                </a> --}}
                <a href="{{ route('super-admin.api.individu.export') }}"
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
                        <option value="Proses Hukum Lanjut">Proses Hukum Lanjut</option>
                        <option value="Narapidana">Narapidana</option>
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
                <h2 class="text-lg font-semibold text-gray-700">Profil Individu</h2>
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
                            <th class="px-4 py-2">Nomor Telepon</th>
                            <th class="px-4 py-2">Dibuat Oleh</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="individuTableBody" class="bg-white divide-y divide-gray-200">
                        @foreach ($sampleData as $i => $individu)
                            <tr>
                                <td class="px-4 py-2">{{ $sampleData->firstItem() + $i }}</td>
                                <td class="px-4 py-2">
                                    <div class="font-semibold text-gray-800">{{ $individu->nama }}</div>
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
                                    @if ($individu->telepon && $individu->telepon->count() > 0)
                                        @foreach ($individu->telepon as $telepon)
                                            <span
                                                class="inline-block px-2 py-1 rounded text-xs font-semibold bg-blue-100 text-blue-700">
                                                {{ $telepon->nomor_telepon }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span
                                            class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-500">
                                            -
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if ($individu->createdBy)
                                        <span
                                            class="inline-block px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-700">
                                            {{ $individu->createdBy->name }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-500">
                                            -
                                        </span>
                                    @endif
                                </td>
                                <td class="px-1 py-2 flex gap-2 justify-center my-auto">
                                    <a href="{{ route('super-admin.data.individu.show', $individu->id) }}"
                                        class="text-blue-600 hover:text-blue-900 flex items-center border border-blue-600 rounded-md px-1 py-1 text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Lihat
                                    </a>
                                    <a href="{{ route('super-admin.data.individu.edit', $individu->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 flex items-center border border-indigo-600 rounded-md px-1 py-1 text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('super-admin.data.individu.destroy', $individu->id) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 flex items-center border border-red-600 rounded-md px-1 py-1 text-sm">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4">
                <!-- Previous and Next buttons will appear automatically with pagination -->
                {{ $sampleData->links() }}
            </div>
        </div>
    </div>

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
                ${individu.telepon && individu.telepon.length > 0 ?
                    individu.telepon.map(telepon => 
                        `<span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-blue-100 text-blue-700">${telepon.nomor_telepon}</span>`
                    ).join('') :
                    '<span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-500">-</span>'
                }
            </td>
            <td class="px-4 py-2">
                ${individu.created_by ?
                    `<span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-700">${individu.created_by.name}</span>` :
                    '<span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-500">-</span>'
                }
            </td>
            <td class="px-4 py-2 text-center">
                <div class="flex gap-1 justify-center">
                    <a href="/super-admin/data-individu/${individu.id}" class="inline-flex items-center px-2 py-1 text-xs text-blue-600 border border-blue-600 rounded hover:bg-blue-50" title="Lihat Detail">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="/super-admin/data-individu/${individu.id}/edit" class="inline-flex items-center px-2 py-1 text-xs text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-50" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="inline-flex items-center px-2 py-1 text-xs text-red-600 border border-red-600 rounded hover:bg-red-50" onclick="deleteIndividu(${individu.id})" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
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

            fetch(`/super-admin/api/individu-data?${params}`)
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
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const form = document.getElementById('deleteForm');
            form.action = `/super-admin/data-individu/${id}`;
            modal.show();
        }
    </script>
@endsection
