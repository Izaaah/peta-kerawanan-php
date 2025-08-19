@extends('layouts.superadmin-master')

@section('title', 'Data Penginapan')

@section('content')
<div class="max-w-7xl mx-auto px-1 pt-1 pb-2">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Daftar Penginapan</h2>
        <a href="{{ route('super-admin.data.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-1"></i>Kembali
        </a>
        {{-- <a href="{{ route('super-admin.data.penginapan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Penginapan</a> --}}
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <form method="GET" action="{{ route('super-admin.data.penginapan.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, jenis, pengelola..." class="border rounded px-3 py-2 w-full" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
    </form>
    <div class="bg-white rounded shadow p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Pengelola</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Dibuat Oleh</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($penginapanList as $index => $penginapan)
                <tr>
                    <td class="px-4 py-2 text-center">{{ ($penginapanList->currentPage() - 1) * $penginapanList->perPage() + $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $penginapan->nama }}</td>
                    <td class="px-4 py-2">{{ $penginapan->jenis }}</td>
                    <td class="px-4 py-2">{{ $penginapan->nama_pengelola }}</td>
                    <td class="px-4 py-2">{{ $penginapan->lokasi }}</td>
                    <td class="px-4 py-2">{{ $penginapan->no_hp }}</td>
                    <td class="px-4 py-2">{{ $penginapan->user->name ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('super-admin.data.penginapan.show', $penginapan->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                        <a href="{{ route('super-admin.data.penginapan.edit', $penginapan->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                        <form action="{{ route('super-admin.data.penginapan.destroy', $penginapan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-2 text-center text-gray-500">Belum ada data penginapan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $penginapanList->links() }}
        </div>
    </div>
</div>
@endsection
