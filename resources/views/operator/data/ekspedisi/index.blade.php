@extends('layouts.operator')

@section('title', 'Data Ekspedisi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Ekspedisi</h1>
            <p class="text-sm text-gray-500">Informasi lengkap mengenai Ekspedisi</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('operator.data.ekspedisi.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, manager, alamat..." class="border rounded px-3 py-2 w-full" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
    </form>

    <div class="bg-white shadow rounded p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Manager</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Created By</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($ekspedisiList as $i => $ekspedisi)
                <tr>
                    <td class="px-4 py-2">{{ $ekspedisiList->firstItem() + $i }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->nama }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->manager }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->alamat }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->no_hp }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->jenis }}</td>
                    <td class="px-4 py-2">{{ $ekspedisi->user->name ?? '-' }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('operator.data.ekspedisi.show', $ekspedisi->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-xs">Lihat</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-2 text-center text-gray-500">Belum ada data ekspedisi.</td>
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
