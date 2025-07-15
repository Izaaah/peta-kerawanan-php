@extends('layouts.superadmin-master')

@section('title', 'Data Ekspedisi')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Daftar Ekspedisi</h2>
        <a href="{{ route('super-admin.data.ekspedisi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Ekspedisi</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white rounded shadow p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Manager</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($ekspedisiList as $ekspedisi)
                <tr>
                    <td class="px-4 py-2">{{ $ekspedisi->nama }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->manager }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->alamat }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->no_hp }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->jenis }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('super-admin.data.ekspedisi.show', $ekspedisi->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                        <a href="{{ route('super-admin.data.ekspedisi.edit', $ekspedisi->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                        <form action="{{ route('super-admin.data.ekspedisi.destroy', $ekspedisi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">Belum ada data ekspedisi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $ekspedisiList->links() }}
        </div>
    </div>
</div>
@endsection 