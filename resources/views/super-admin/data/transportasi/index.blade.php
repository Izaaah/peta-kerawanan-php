@extends('layouts.superadmin-master')

@section('title', 'Data Tempat Transportasi')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Daftar Tempat Transportasi</h2>
        <a href="{{ route('super-admin.data.transportasi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Transportasi</a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded shadow p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis Transportasi</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Pihak</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Posisi</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($transportasiList as $transportasi)
                <tr>
                    <td class="px-4 py-2">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            @if($transportasi->jenis_transportasi == 'Darat') bg-blue-100 text-blue-800
                            @elseif($transportasi->jenis_transportasi == 'Laut') bg-green-100 text-green-800
                            @else bg-purple-100 text-purple-800
                            @endif">
                            {{ $transportasi->jenis_transportasi }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $transportasi->nama_pihak }}</td>
                    <td class="px-4 py-2">{{ $transportasi->posisi ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $transportasi->no_hp }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('super-admin.data.transportasi.show', $transportasi->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                        <a href="{{ route('super-admin.data.transportasi.edit', $transportasi->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                        <form action="{{ route('super-admin.data.transportasi.destroy', $transportasi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">Belum ada data transportasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $transportasiList->links() }}
        </div>
    </div>
</div>
@endsection