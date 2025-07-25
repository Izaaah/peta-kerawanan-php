@extends('layouts.operator')

@section('content')
<div class="max-w-2xl mx-auto py-8">
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
        <div class="flex gap-2 mt-6">
            <a href="{{ route('operator.data.objekvital.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection
