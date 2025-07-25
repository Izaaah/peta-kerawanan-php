@extends('layouts.operator')

@section('title', 'Data THM')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Tempat Hiburan Malam (THM)</h1>
            <p class="text-sm text-gray-500">Informasi lengkap mengenai THM</p>
        </div>
    </div>
    <form method="GET" action="{{ route('super-admin.data.thm.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama THM, ketua..." class="border rounded px-3 py-2 w-full" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
    </form>
    <div class="bg-white shadow rounded p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama THM</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ketua THM</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No HP Ketua</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created By</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($thmList as $thm)
                <tr>
                    <td class="px-4 py-2">{{ $thm->nama_thm }}</td>
                    <td class="px-4 py-2">{{ $thm->ketua_thm }}</td>
                    <td class="px-4 py-2">{{ $thm->no_hp_ketua }}</td>
                    <td class="px-4 py-2">{{ $thm->user->name ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('super-admin.data.thm.show', $thm->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
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
@endsection
