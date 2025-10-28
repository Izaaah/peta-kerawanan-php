@extends('layouts.superadmin-master')

@section('title', 'Data THM')

@section('content')
    <!-- Include responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-data-responsive.css') }}">
    @include('components.superadmin-navbar')

    <div class="mx-auto px-2 lg:px-4 py-3">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 lg:mb-6 gap-3">
            <div>
                <h1 class="text-xl lg:text-2xl font-semibold text-gray-800">Daftar Tempat Hiburan Malam (THM)</h1>
                <p class="text-xs lg:text-sm text-gray-500">Informasi lengkap mengenai THM</p>
            </div>
            <a href="{{ route('super-admin.data.index') }}"
                class="inline-flex items-center px-3 lg:px-4 py-2 text-xs lg:text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700 whitespace-nowrap">
                <i class="fas fa-arrow-left mr-1"></i><span class="hidden sm:inline">Kembali</span><span
                    class="sm:hidden">←</span>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('super-admin.data.thm.index') }}"
            class="mb-4 flex flex-col sm:flex-row gap-2 form-responsive">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama THM, ketua..."
                class="border rounded px-3 py-2 w-full text-sm lg:text-base" />
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm lg:text-base whitespace-nowrap">Search</button>
        </form>
        <div class="bg-white shadow rounded p-3 lg:p-6 card-responsive">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-2 lg:px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-2 lg:px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama THM
                            </th>
                            <th class="px-2 lg:px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                            <th class="px-2 lg:px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                Ketua/Kepala THM
                            </th>
                            <th class="px-2 lg:px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No HP
                                Ketua/Kepala THM
                            </th>
                            <th class="px-2 lg:px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Dibuat Oleh
                            </th>
                            <th class="px-2 lg:px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($thmList as $index => $thm)
                            <tr>
                                <td class="px-2 lg:px-4 py-2 text-center text-xs lg:text-sm">
                                    {{ ($thmList->currentPage() - 1) * $thmList->perPage() + $loop->iteration }}</td>
                                <td class="px-2 lg:px-4 py-2 text-xs lg:text-sm">{{ $thm->nama_thm }}</td>
                                <td class="px-2 lg:px-4 py-2 text-xs lg:text-sm">{{ $thm->alamat }}</td>
                                <td class="px-2 lg:px-4 py-2 text-xs lg:text-sm">{{ $thm->ketua_thm }}</td>
                                <td class="px-2 lg:px-4 py-2 text-xs lg:text-sm">{{ $thm->no_hp_ketua }}</td>
                                <td class="px-2 lg:px-4 py-2 text-xs lg:text-sm">{{ $thm->user->name ?? 'N/A' }}</td>
                                <td class="px-2 lg:px-4 py-2">
                                    <div class="flex flex-wrap gap-1 lg:gap-2 justify-center">
                                        <a href="{{ route('super-admin.data.thm.show', $thm->id) }}"
                                            class="text-blue-600 hover:text-blue-900 flex items-center border border-blue-600 rounded-md px-2 py-1 text-xs lg:text-sm whitespace-nowrap">
                                            <svg class="w-3 h-3 lg:w-4 lg:h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            <span class="hidden sm:inline">Lihat</span>
                                            <span class="sm:hidden">👁</span>
                                        </a>
                                        <a href="{{ route('super-admin.data.thm.edit', $thm->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 flex items-center border border-indigo-600 rounded-md px-2 py-1 text-xs lg:text-sm whitespace-nowrap">
                                            <svg class="w-3 h-3 lg:w-4 lg:h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            <span class="hidden sm:inline">Edit</span>
                                            <span class="sm:hidden">✏</span>
                                        </a>
                                        <form action="{{ route('super-admin.data.thm.destroy', $thm->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 flex items-center border border-red-600 rounded-md px-2 py-1 text-xs lg:text-sm whitespace-nowrap">
                                                <svg class="w-3 h-3 lg:w-4 lg:h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                <span class="hidden sm:inline">Hapus</span>
                                                <span class="sm:hidden">🗑</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center text-gray-500 text-sm lg:text-base">Belum
                                    ada data THM.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $thmList->links() }}
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
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
    @endpush
@endsection
