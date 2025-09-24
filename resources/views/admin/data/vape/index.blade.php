@extends('layouts.admin-master')

@section('title', 'Data Penjual Vape')

@section('content')
    <div class="mx-auto px-4 py-3">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Daftar Penjual Vape</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.data.vape.create') }}"
                    class="bg-blue-600 text-white px-8 py-2 rounded hover:bg-blue-700">+ Tambah Data</a>
                <a href="{{ route('admin.data.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                </a>
            </div>
        </div>
        <form method="GET" action="{{ route('admin.data.vape.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama toko, pemilik..."
                class="border rounded px-3 py-2 w-full" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>
        <div class="bg-white rounded shadow p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Toko</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Pemilik</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Liquid Dicurigai</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Distributor</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($vapeList as $index => $vape)
                        <tr>
                            <td class="px-4 py-2 text-center">
                                {{ ($vapeList->currentPage() - 1) * $vapeList->perPage() + $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $vape->nama_toko }}</td>
                            <td class="px-4 py-2">{{ $vape->pemilik }}</td>
                            <td class="px-4 py-2">{{ $vape->no_hp }}</td>
                            <td class="px-4 py-2">{{ $vape->liquid_dicurigai }}</td>
                            <td class="px-4 py-2">{{ $vape->distributor }}</td>
                            <td class="px-4 py-2">{{ $vape->lokasi }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.data.vape.show', $vape->id) }}"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                                <a href="{{ route('admin.data.vape.edit', $vape->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                                <form action="{{ route('admin.data.vape.destroy', $vape->id) }}" method="POST"
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
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada data penjual vape.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $vapeList->links() }}
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
