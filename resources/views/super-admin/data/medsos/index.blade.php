@extends('layouts.superadmin-master')

@section('title', 'Data Akun Media Sosial')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Daftar Akun Media Sosial Transaksi Narkotika</h2>
        <a href="{{ route('super-admin.data.medsos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Akun</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <form method="GET" action="{{ route('super-admin.data.medsos.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari media sosial, nama akun..." class="border rounded px-3 py-2 w-full" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
    </form>
    <div class="bg-white rounded shadow p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Media Sosial</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Akun</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Link Akun</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created By</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($medsosList as $medsos)
                <tr>
                    <td class="px-4 py-2">{{ $medsos->nama_media_sosial }}</td>
                    <td class="px-4 py-2">{{ $medsos->nama_akun }}</td>
                    <td class="px-4 py-2"><a href="{{ $medsos->link_akun }}" class="text-blue-600 underline" target="_blank">{{ $medsos->link_akun }}</a></td>
                    <td class="px-4 py-2">{{ $medsos->user->name ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('super-admin.data.medsos.show', $medsos->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                        <a href="{{ route('super-admin.data.medsos.edit', $medsos->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                        <form action="{{ route('super-admin.data.medsos.destroy', $medsos->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada data akun medsos.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $medsosList->links() }}
        </div>
    </div>
</div>
@endsection
