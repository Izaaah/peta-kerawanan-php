@extends('layouts.operator')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Jaringan Rutan/Lapas</h2>
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
        <div class="flex gap-2 mt-6">
            <a href="{{ route('operator.data.rutanlapas.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
<<<<<<< HEAD
=======
    <div class="mb-3">
        <label class="form-label">Jenis Napi</label>
        <div class="form-control">{{ $rutanlapas->jenis_napi }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Lapas</label>
        <div class="form-control">{{ $rutanlapas->lapas }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Lokasi Lapas</label>
        <div class="form-control">{{ $rutanlapas->lokasi_lapas }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Peran dalam Jaringan</label>
        <div class="form-control">{{ $rutanlapas->peran_dalam_jaringan }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Status Proses</label>
        <div class="form-control">{{ $rutanlapas->status_proses }}</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <div class="form-control">{{ $rutanlapas->keterangan }}</div>
    </div>
    <a href="{{ route('operator.data.rutanlapas.index') }}" class="btn btn-secondary">Kembali</a>
>>>>>>> 20a8640e7362ff0668ee415d4109947857f5756e
</div>
@endsection
