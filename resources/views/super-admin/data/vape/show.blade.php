@extends('layouts.superadmin-master')

@section('title', 'Detail Penjual Vape')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-xl font-bold mb-4">Detail Penjual Vape</h2>
        <div class="mb-4">
            <strong>Nama Toko:</strong>
            <div class="text-gray-700">{{ $vape->nama_toko }}</div>
        </div>
        <div class="mb-4">
            <strong>Pemilik:</strong>
            <div class="text-gray-700">{{ $vape->pemilik }}</div>
        </div>
        <div class="mb-4">
            <strong>Lokasi:</strong>
            <div class="text-gray-700">{{ $vape->lokasi }}</div>
        </div>
        <div class="mb-4">
            <strong>No. HP:</strong>
            <div class="text-gray-700">{{ $vape->no_hp }}</div>
        </div>
        <div class="mb-4">
            <strong>Liquid Dicurigai:</strong>
            <div class="text-gray-700">{{ $vape->liquid_dicurigai }}</div>
        </div>
        <div class="mb-4">
            <strong>Distributor:</strong>
            <div class="text-gray-700">{{ $vape->distributor }}</div>
        </div>
        <div class="flex gap-2 mt-6">
            <a href="{{ route('super-admin.data.vape.edit', $vape->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
            <a href="{{ route('super-admin.data.vape.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Kembali</a>
        </div>
    </div>
</div>
@endsection