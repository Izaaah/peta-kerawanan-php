@extends('layouts.superadmin-master')

@section('title', 'Detail Ekspedisi')

@section('content')
<div class="max-w-7xl mx-auto px-1 pt-1 pb-2">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Detail Data Ekspedisi</h2>
        <div class="flex gap-2">
            <a href="{{ route('super-admin.data.ekspedisi.edit', $ekspedisi->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('super-admin.data.ekspedisi.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>
    </div>
    <div class="bg-white rounded shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Informasi Ekspedisi</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Ekspedisi</label>
                        <p class="mt-1 text-gray-900">{{ $ekspedisi->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Manager</label>
                        <p class="mt-1 text-gray-900">{{ $ekspedisi->manager }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No. HP</label>
                        <p class="mt-1 text-gray-900">{{ $ekspedisi->no_hp }}</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Jenis</label>
                    <p class="mt-1 text-gray-900">{{ $ekspedisi->jenis }}</p>
                </div>
                <h3 class="text-lg font-semibold mb-4">Alamat</h3>
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $ekspedisi->alamat }}</p>
                </div>
            </div>
        </div>
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Informasi Sistem</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Dibuat Pada</label>
                    <p class="mt-1 text-gray-900">{{ $ekspedisi->created_at->format('d F Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                    <p class="mt-1 text-gray-900">{{ $ekspedisi->updated_at->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="mt-8 flex justify-end">
            <form action="{{ route('super-admin.data.ekspedisi.destroy', $ekspedisi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus Data</button>
            </form>
        </div>
    </div>
</div>
@endsection
