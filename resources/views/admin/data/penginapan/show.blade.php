@extends('layouts.admin-master')

@section('title', 'Detail Penginapan')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Detail Data Penginapan</h2>
        <div class="flex gap-2">
            <a href="{{ route('admin.data.penginapan.edit', $penginapan->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('admin.data.penginapan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>
    </div>
    <div class="bg-white rounded shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4">Informasi Penginapan</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Penginapan</label>
                        <p class="mt-1 text-gray-900">{{ $penginapan->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis</label>
                        <p class="mt-1 text-gray-900">{{ $penginapan->jenis }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pengelola</label>
                        <p class="mt-1 text-gray-900">{{ $penginapan->nama_pengelola }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No. HP</label>
                        <p class="mt-1 text-gray-900">{{ $penginapan->no_hp }}</p>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Lokasi</h3>
                <div class="bg-gray-50 p-4 rounded">
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $penginapan->lokasi }}</p>
                </div>
            </div>
        </div>
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-semibold mb-4">Informasi Sistem</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Dibuat Pada</label>
                    <p class="mt-1 text-gray-900">{{ $penginapan->created_at->format('d F Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                    <p class="mt-1 text-gray-900">{{ $penginapan->updated_at->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="mt-8 flex justify-end">
            <form action="{{ route('admin.data.penginapan.destroy', $penginapan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus Data</button>
            </form>
        </div>
    </div>
</div>
@endsection
