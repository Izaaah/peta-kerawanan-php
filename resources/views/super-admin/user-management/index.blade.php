@extends('layouts.superadmin-master')

@section('content')
@include('components.superadmin-navbar')

<div class="container-fluid px-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('super-admin.user-management.create') }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah User
                    </a>
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export Data
                    </button>
                </div>
            </div>

            <!-- Search Section -->
            <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-200">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari User</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text"
                                   id="searchUser"
                                   placeholder="Masukkan nama atau email user..."
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button id="searchBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        <button id="clearSearchBtn" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="roleFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Role</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="statusFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                        <select id="sortFilter" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="name">Nama A-Z</option>
                            <option value="name_desc">Nama Z-A</option>
                            <option value="created_at">Terbaru</option>
                            <option value="created_at_desc">Terlama</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- User Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                    <h3 class="font-semibold text-blue-800">Total Users</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $users->count() ?? 0 }}</p>
                    <p class="text-sm text-blue-600">Semua user</p>
                </div>
                <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                    <h3 class="font-semibold text-green-800">Active Users</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $users->where('status', 'active')->count() ?? 0 }}</p>
                    <p class="text-sm text-green-600">User aktif</p>
                </div>
                <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                    <h3 class="font-semibold text-orange-800">Admin Users</h3>
                    <p class="text-2xl font-bold text-orange-600">{{ $users->where('role', 'admin')->count() ?? 0 }}</p>
                    <p class="text-sm text-orange-600">Admin & Super Admin</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                    <h3 class="font-semibold text-purple-800">Operator Users</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ $users->where('role', 'operator')->count() ?? 0 }}</p>
                    <p class="text-sm text-purple-600">Operator</p>
                </div>
            </div>

            <!-- Tabel User -->
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Terdaftar
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users ?? [] as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-sm font-medium text-blue-600">{{ substr($user->name, 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $roleColors = [
                                            'superadmin' => 'bg-red-100 text-red-800',
                                            'admin' => 'bg-blue-100 text-blue-800',
                                            'operator' => 'bg-green-100 text-green-800',
                                            'user' => 'bg-gray-100 text-gray-800'
                                        ];
                                        $roleColor = $roleColors[$user->role ?? 'user'] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleColor }}">
                                        {{ ucfirst($user->role ?? 'User') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'active' => 'bg-green-100 text-green-800',
                                            'inactive' => 'bg-red-100 text-red-800',
                                            'pending' => 'bg-yellow-100 text-yellow-800'
                                        ];
                                        $statusColor = $statusColors[$user->status ?? 'active'] ?? 'bg-green-100 text-green-800';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                        {{ ucfirst($user->status ?? 'Active') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('super-admin.user-management.show', $user->id) }}"
                                           class="text-blue-600 hover:text-blue-900 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>
                                        <a href="{{ route('super-admin.user-management.edit', $user->id) }}"
                                           class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <button class="text-red-600 hover:text-red-900 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada user</h3>
                                        <p class="text-gray-500 mb-4">Belum ada user yang terdaftar dalam sistem.</p>
                                                                                <a href="{{ route('super-admin.user-management.create') }}"
                                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Tambah User Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if(($users ?? collect())->hasPages())
            <div class="mt-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Menampilkan {{ ($users ?? collect())->firstItem() ?? 0 }} sampai {{ ($users ?? collect())->lastItem() ?? 0 }} dari {{ ($users ?? collect())->total() ?? 0 }} user
                    </div>
                    <div class="flex space-x-2">
                        @if(($users ?? collect())->onFirstPage())
                            <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ ($users ?? collect())->previousPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Previous</a>
                        @endif

                        @if(($users ?? collect())->hasMorePages())
                            <a href="{{ ($users ?? collect())->nextPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Next</a>
                        @else
                            <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Search functionality
    const searchInput = document.getElementById('searchUser');
    const searchBtn = document.getElementById('searchBtn');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const roleFilter = document.getElementById('roleFilter');
    const statusFilter = document.getElementById('statusFilter');
    const sortFilter = document.getElementById('sortFilter');

    // Search function
    function performSearch() {
        const searchQuery = searchInput.value.trim();
        const role = roleFilter.value;
        const status = statusFilter.value;
        const sort = sortFilter.value;

        // Build query parameters
        const params = new URLSearchParams();
        if (searchQuery) params.append('search', searchQuery);
        if (role) params.append('role', role);
        if (status) params.append('status', status);
        if (sort) params.append('sort', sort);

        // Redirect with filters
        window.location.href = `${window.location.pathname}?${params.toString()}`;
    }

    // Event listeners
    searchBtn.addEventListener('click', performSearch);
    clearSearchBtn.addEventListener('click', () => {
        searchInput.value = '';
        roleFilter.value = '';
        statusFilter.value = '';
        sortFilter.value = 'name';
        performSearch();
    });

    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    // Auto-submit filters
    [roleFilter, statusFilter, sortFilter].forEach(filter => {
        filter.addEventListener('change', performSearch);
    });
</script>
@endpush
@endsection
