@extends('layouts.admin-master')

@section('title', 'Data THM')

@section('content')
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Daftar Tempat Hiburan Malam (THM)</h1>
                <p class="text-sm text-gray-500">Informasi lengkap mengenai THM</p>
            </div>
            <a href="{{ route('admin.data.thm.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i>Tambah THM
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.data.thm.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama THM, ketua..."
                class="border rounded px-3 py-2 w-full" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>
        <div class="bg-white shadow rounded p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama THM</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ketua THM</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No HP Ketua</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($thmList as $thm)
                        <tr>
                            <td class="px-4 py-2">{{ $thm->nama_thm }}</td>
                            <td class="px-4 py-2">{{ $thm->ketua_thm }}</td>
                            <td class="px-4 py-2">{{ $thm->no_hp_ketua }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.data.thm.show', $thm->id) }}"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                                <a href="{{ route('admin.data.thm.edit', $thm->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                                <form action="{{ route('admin.data.thm.destroy', $thm->id) }}" method="POST"
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
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada data THM.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
