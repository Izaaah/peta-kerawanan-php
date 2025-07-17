@extends('layouts.admin-master')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Penggiat Narkotika</h2>
        <div class="mb-4">
            <strong>Nama:</strong>
            <div class="text-gray-700">{{ $penggiat->nama }}</div>
        </div>
        <div class="mb-4">
            <strong>Alamat:</strong>
            <div class="text-gray-700">{{ $penggiat->alamat }}</div>
        </div>
        <div class="mb-4">
            <strong>No HP:</strong>
            <div class="text-gray-700">{{ $penggiat->no_hp }}</div>
        </div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('admin.data.penggiat.edit', $penggiat->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('admin.data.penggiat.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection
