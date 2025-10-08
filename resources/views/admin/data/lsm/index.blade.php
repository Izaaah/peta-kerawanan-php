@extends('layouts.admin-master')

@section('title', 'Data LSM Narkotika')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Daftar LSM Narkotika</h1>
                <p class="text-sm text-gray-500">Informasi lengkap mengenai LSM</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.data.lsm.create') }}"
                    class="inline-flex items-center px-8 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-1"></i>Tambah LSM
                </a>
                <a href="{{ route('admin.data.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.data.lsm.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama LSM, ketua, alamat..."
                class="border rounded px-3 py-2 w-full" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>

        <div class="bg-white shadow rounded p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-7 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama LSM</th>
                        <th class="px-7 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                        {{-- <th class="px-7 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th> --}}
                        <th class="px-7 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. Telp</th>
                        <th class="px-7 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ketua</th>
                        <th class="px-7 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP Ketua</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($lsmList as $index => $lsm)
                        <tr>
                            <td class="px-4 py-2 text-center">
                                {{ ($lsmList->currentPage() - 1) * $lsmList->perPage() + $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $lsm->nama_lsm }}</td>
                            <td class="px-4 py-2">
                                {{ trim(($lsm->kabupaten ? $lsm->kabupaten : '') . ($lsm->kecamatan ? ', ' . $lsm->kecamatan : '') . ($lsm->kelurahan ? ', ' . $lsm->kelurahan : '')) ?: '-' }}
                            </td>
                            {{-- <td class="px-4 py-2">{{ $lsm->alamat }}</td> --}}
                            <td class="px-4 py-2">{{ $lsm->no_telp ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $lsm->ketua_lsm }}</td>
                            <td class="px-4 py-2">{{ $lsm->no_hp_ketua }}</td>
                            <td class="px-4 py-2 flex gap-2 justify-end">
                                <a href="{{ route('admin.data.lsm.show', $lsm->id) }}"
                                    class="text-blue-600 hover:text-blue-900 flex items-center border border-blue-600 rounded-md px-1 py-1 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    Lihat
                                </a>
                                <a href="{{ route('admin.data.lsm.edit', $lsm->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 flex items-center border border-indigo-600 rounded-md px-1 py-1 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('admin.data.lsm.destroy', $lsm->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 flex items-center border border-red-600 rounded-md px-1 py-1 text-sm"
                                        onclick="return confirmDelete(event)">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-center text-gray-500">Belum ada data LSM.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $lsmList->links() }}
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
