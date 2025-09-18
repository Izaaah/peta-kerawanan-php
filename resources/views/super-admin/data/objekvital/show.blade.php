@extends('layouts.superadmin-master')

@section('content')
<div class="mx-auto px-4 py-3">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Objek Vital</h2>
        <div class="mb-4">
            <strong>Nama Objek:</strong>
            <div class="text-gray-700">{{ $objekVital->nama_objek }}</div>
        </div>
        <div class="mb-4">
            <strong>Nama Manager:</strong>
            <div class="text-gray-700">{{ $objekVital->nama_manager }}</div>
        </div>
        <div class="mb-4">
            <strong>Lokasi:</strong>
            <div class="text-gray-700">{{ $objekVital->lokasi }}</div>
        </div>
        <div class="mb-4">
            <strong>No HP:</strong>
            <div class="text-gray-700">{{ $objekVital->no_hp }}</div>
        </div>
        <div class="mb-4">
            <strong>Created By:</strong>
            <div class="text-gray-700">{{ $objekVital->user->name ?? '-' }}</div>
        </div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('super-admin.data.objekvital.edit', $objekVital->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <form action="{{ route('super-admin.data.objekvital.destroy', $objekVital->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
            </form>
            <a href="{{ route('super-admin.data.objekvital.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection
