@extends('layouts.superadmin-master')

@section('content')
<div class="max-w-7xl mx-auto px-1 pt-1 pb-2">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Lembaga Rehabilitasi</h2>
        <div class="mb-4">
            <strong>Nama:</strong>
            <div class="text-gray-700">{{ $lrehab->nama }}</div>
        </div>
        <div class="mb-4">
            <strong>Jenis:</strong>
            <div class="text-gray-700">{{ $lrehab->jenis }}</div>
        </div>
        <div class="mb-4">
            <strong>Created By:</strong>
            <div class="text-gray-700">{{ $lrehab->user->name ?? '-' }}</div>
        </div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('super-admin.data.lrehab.edit', $lrehab->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('super-admin.data.lrehab.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection
