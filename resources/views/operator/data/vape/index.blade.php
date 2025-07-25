@extends('layouts.operator')

@section('title', 'Data Penjual Vape')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Daftar Penjual Vape</h2>
    </div>
    <form method="GET" action="{{ route('operator.data.vape.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama toko, pemilik..." class="border rounded px-3 py-2 w-full" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
    </form>
    <div class="bg-white rounded shadow p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Toko</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Pemilik</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Liquid Dicurigai</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Distributor</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($vapeList as $vape)
                <tr>
                    <td class="px-4 py-2">{{ $vape->nama_toko }}</td>
                    <td class="px-4 py-2">{{ $vape->pemilik }}</td>
                    <td class="px-4 py-2">{{ $vape->lokasi }}</td>
                    <td class="px-4 py-2">{{ $vape->no_hp }}</td>
                    <td class="px-4 py-2">{{ $vape->liquid_dicurigai }}</td>
                    <td class="px-4 py-2">{{ $vape->distributor }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('operator.data.vape.show', $vape->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-2 text-center text-gray-500">Belum ada data penjual vape.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $vapeList->links() }}
        </div>
    </div>
</div>
@endsection
