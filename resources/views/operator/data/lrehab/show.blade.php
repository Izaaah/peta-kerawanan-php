@extends('layouts.operator')

@section('content')
<div class="max-w-2xl mx-auto py-8">
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
        <div class="flex gap-2 mt-6">
            <a href="{{ route('operator.data.lrehab.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection
