@extends('layouts.superadmin-master')

@section('title', 'Data LSM Narkotika')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Daftar LSM Narkotika</h1>
            <p class="text-sm text-gray-500">Informasi lengkap mengenai LSM</p>
        </div>
        <a href="{{ route('super-admin.data.lsm.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Tambah LSM
        </a>
    </div>

    <form method="GET" action="{{ route('super-admin.data.lsm.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama LSM, ketua, alamat..." class="border rounded px-3 py-2 w-full" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
    </form>

    <div class="bg-white shadow rounded p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama LSM</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ketua</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP Ketua</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created By</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($lsmList as $lsm)
                <tr>
                    <td class="px-4 py-2">{{ $lsm->nama_lsm }}</td>
                    <td class="px-4 py-2">{{ $lsm->ketua_lsm }}</td>
                    <td class="px-4 py-2">{{ $lsm->no_hp_ketua }}</td>
                    <td class="px-4 py-2">{{ $lsm->alamat }}</td>
                    <td class="px-4 py-2">{{ $lsm->user->name ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('super-admin.data.lsm.show', $lsm->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                        <a href="{{ route('super-admin.data.lsm.edit', $lsm->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                        <form action="{{ route('super-admin.data.lsm.destroy', $lsm->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada data LSM.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $lsmList->links() }}
        </div>
    </div>
</div>
@endsection
