@extends('layouts.superadmin-master')
@section('title', 'Data Perusahaan Farmasi/Prekursor')
@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Daftar Perusahaan Farmasi/Prekursor</h2>
        <a href="{{ route('super-admin.data.farmasi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Data</a>
    </div>
    <div class="bg-white rounded shadow p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Manager</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($farmasiList as $farmasi)
                <tr>
                    <td class="px-4 py-2">{{ $farmasi->jenis }}</td>
                    <td class="px-4 py-2">{{ $farmasi->nama }}</td>
                    <td class="px-4 py-2">{{ $farmasi->manager }}</td>
                    <td class="px-4 py-2">{{ $farmasi->no_hp }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('super-admin.data.farmasi.show', $farmasi->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                        <a href="{{ route('super-admin.data.farmasi.edit', $farmasi->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                        <form action="{{ route('super-admin.data.farmasi.destroy', $farmasi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $farmasiList->links() }}
        </div>
    </div>
</div>
@endsection
