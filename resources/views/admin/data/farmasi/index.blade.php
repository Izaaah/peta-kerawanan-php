@extends('layouts.admin-master')
@section('title', 'Data Perusahaan Farmasi/Prekursor')
@section('content')
    <div class="container mx-auto px-1 pt-1 pb-2 max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Daftar Perusahaan Farmasi/Prekursor</h1>
                <p class="text-sm text-gray-500">Informasi lengkap mengenai Perusahaan Farmasi/Prekursor</p>
            </div>
            <div class="gap-2">
                <a href="{{ route('admin.data.farmasi.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Tambah Data
                </a>
                <a href="{{ route('admin.data.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.data.farmasi.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, manager, jenis..."
                class="border rounded px-3 py-2 w-full" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>

        <div class="bg-white shadow rounded p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Manager</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($farmasiList as $i => $farmasi)
                        <tr>
                            <td class="px-4 py-2">{{ $farmasiList->firstItem() + $i }}</td>
                            <td class="px-4 py-2">{{ $farmasi->jenis }}</td>
                            <td class="px-4 py-2">{{ $farmasi->nama }}</td>
                            <td class="px-4 py-2">{{ $farmasi->manager }}</td>
                            <td class="px-4 py-2">{{ $farmasi->no_hp }}</td>
                            <td class="px-4 py-2">{{ $farmasi->lokasi }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.data.farmasi.show', $farmasi->id) }}"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                                <a href="{{ route('admin.data.farmasi.edit', $farmasi->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                                <form action="{{ route('admin.data.farmasi.destroy', $farmasi->id) }}" method="POST"
                                    onsubmit="return confirmDelete(event)" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center text-gray-500">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $farmasiList->links() }}
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
