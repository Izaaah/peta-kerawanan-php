@extends('layouts.operator')

@section('title', 'Data LSM Narkotika')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Daftar LSM Narkotika</h1>
                <p class="text-sm text-gray-500">Informasi lengkap mengenai LSM</p>
            </div>
            <a href="{{ route('operator.data.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                <i class="fas fa-arrow-left mr-1"></i>Kembali
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('operator.data.lsm.index') }}" class="mb-4 flex gap-2">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama LSM, ketua, alamat..."
                class="border rounded px-3 py-2 w-full" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
        </form>

        <div class="bg-white shadow rounded p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama LSM</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ketua</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No. HP Ketua</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Dibuat Oleh</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($lsmList as $index => $lsm)
                        <tr>
                            <td class="px-4 py-2">{{ $lsmList->firstItem() + $index }}</td>
                            <td class="px-4 py-2">{{ $lsm->nama_lsm }}</td>
                            <td class="px-4 py-2">{{ $lsm->ketua_lsm }}</td>
                            <td class="px-4 py-2">{{ $lsm->no_hp_ketua }}</td>
                            <td class="px-4 py-2">{{ $lsm->alamat }}</td>
                            <td class="px-4 py-2">{{ $lsm->user->name ?? '-' }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">Belum ada data LSM.</td>
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
