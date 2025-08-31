@extends('layouts.admin-master')

@section('title', 'Data Titik Masuk')

@section('content')
    <div class="container mx-auto max-w-7xl px-1 pt-1 pb-2">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Daftar Tempat Titik Masuk</h1>
                <p class="text-sm text-gray-500">Informasi lengkap mengenai Titik Masuk</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.data.titik-masuk.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Tambah Data
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

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.data.titik-masuk.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari jenis, nama pihak, posisi..."
                class="border rounded px-3 py-2 w-full" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>

        <div class="bg-white rounded shadow p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis Transportasi</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Tempat</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Provinsi</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kabupaten</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kecamatan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Kelurahan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($titikMasukList as $i => $titikMasuk)
                        <tr>
                            <td class="px-4 py-2">{{ $titikMasukList->firstItem() + $i }}</td>
                            <td class="px-4 py-2">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            @if ($titikMasuk->jenis_transportasi == 'Darat') bg-blue-100 text-blue-800
                            @elseif($titikMasuk->jenis_transportasi == 'Laut') bg-green-100 text-green-800
                            @else bg-purple-100 text-purple-800 @endif">
                                    {{ $titikMasuk->jenis_transportasi }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $titikMasuk->nama_tempat }}</td>
                            <td class="px-4 py-2">{{ $titikMasuk->provinsi }}</td>
                            <td class="px-4 py-2">{{ $titikMasuk->kabupaten }}</td>
                            <td class="px-4 py-2">{{ $titikMasuk->kecamatan }}</td>
                            <td class="px-4 py-2">{{ $titikMasuk->kelurahan }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.data.titik-masuk.show', $titikMasuk->id) }}"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                                <a href="{{ route('admin.data.titik-masuk.edit', $titikMasuk->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                                <form action="{{ route('admin.data.titik-masuk.destroy', $titikMasuk->id) }}"
                                    method="POST" onsubmit="return confirmDelete(event)" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-center text-gray-500">Belum ada data titik masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $titikMasukList->links() }}
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
