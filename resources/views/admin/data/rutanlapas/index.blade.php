@extends('layouts.superadmin-master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Jaringan Rutan/Lapas</h1>
            <p class="text-sm text-gray-500">Informasi lengkap mengenai Jaringan Rutan/Lapas</p>
        </div>
        <a href="{{ route('super-admin.data.rutanlapas.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Tambah Jaringan Rutan/Lapas
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('super-admin.data.rutanlapas.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama napi, lapas, status..." class="border rounded px-3 py-2 w-full" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
    </form>

    <div class="bg-white shadow rounded p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Napi</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis Napi</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Lapas</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status Proses</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($rutanlapasList as $i => $rutanlapas)
                <tr>
                    <td class="px-4 py-2">{{ $rutanlapasList->firstItem() + $i }}</td>
                    <td class="px-4 py-2">{{ $rutanlapas->nama_napi }}</td>
                    <td class="px-4 py-2">{{ $rutanlapas->jenis_napi }}</td>
                    <td class="px-4 py-2">{{ $rutanlapas->lapas }}</td>
                    <td class="px-4 py-2">{{ $rutanlapas->status_proses }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('super-admin.data.rutanlapas.show', $rutanlapas->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                        <a href="{{ route('super-admin.data.rutanlapas.edit', $rutanlapas->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                        <form action="{{ route('super-admin.data.rutanlapas.destroy', $rutanlapas->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">Belum ada data Jaringan Rutan/Lapas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $rutanlapasList->links() }}
        </div>
    </div>
</div>
@endsection 