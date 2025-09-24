@extends('layouts.admin-master')

@section('content')
<div class="mx-auto px-4 py-3">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Jaringan Rutan/Lapas</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="mb-4">
                    <strong>Nama Napi:</strong>
                    <div class="text-gray-700">{{ $rutanlapas->nama_napi }}</div>
                </div>
                <div class="mb-4">
                    <strong>Jenis Napi:</strong>
                    <div class="text-gray-700">{{ $rutanlapas->jenis_napi }}</div>
                </div>
                <div class="mb-4">
                    <strong>Lapas:</strong>
                    <div class="text-gray-700">{{ $rutanlapas->lapas }}</div>
                </div>
                <div class="mb-4">
                    <strong>Lokasi Lapas:</strong>
                    <div class="text-gray-700">{{ $rutanlapas->lokasi_lapas }}</div>
                </div>
            </div>
            <div class="space-y-4">
                <div class="mb-4">
                    <strong>Peran dalam Jaringan:</strong>
                    <div class="text-gray-700">{{ $rutanlapas->peran_dalam_jaringan }}</div>
                </div>
                <div class="mb-4">
                    <strong>Status Proses:</strong>
                    <div class="text-gray-700">{{ $rutanlapas->status_proses }}</div>
                </div>
                <div class="mb-4">
                    <strong>Keterangan:</strong>
                    <div class="text-gray-700">{{ $rutanlapas->keterangan }}</div>
                </div>
            </div>
        </div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('admin.data.rutanlapas.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
            <a href="{{ route('admin.data.rutanlapas.edit', $rutanlapas->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
        </div>
    </div>
</div>
@endsection
